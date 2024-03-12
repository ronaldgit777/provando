<?php

namespace App\Http\Controllers;

use App\Models\adelantosecre;
use App\Models\secretaria;
use App\Models\sueldosecre;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SueldosecreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function  obtenerfechainiciosecresureporte(Request $request)
    {   
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $secretariaid2 = $request->input('secretariaid');
       $sueldomin2 = $request->input('sueldomin');
       $sueldomax2 = $request->input('sueldomax');
       $todesmin2 = $request->input('todesmin');
       $todesmax2 = $request->input('todesmax');
       $topamin2 = $request->input('topamin');
       $topamax2 = $request->input('topamax');
       $ordenarsusecre2 = $request->input('ordenarsusecre');
       $mayorymenorsusecre2 = $request->input('mayorymenorsusecre');
       $resultadoconsulta = sueldosecre::obtenersusecredesdefechainiciore($fechaini,$fechafin,$secretariaid2,
       $sueldomin2,$sueldomax2,$todesmin2,$todesmax2,$topamin2,$topamax2,$ordenarsusecre2,$mayorymenorsusecre2);   
       return response()->json($resultadoconsulta);        
    }
    public function  obtenerfechainiciosusecre(Request $request)
    {   
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $buscarpro2 = $request->input('buscarpro');
       $resultadoconsulta = sueldosecre::obtenersueldoprodesdefechainicio($fechaini,$fechafin,$buscarpro2);
           
       return response()->json($resultadoconsulta);        
    }
    public function reporsusecre()
    {
        $sueldosecres=sueldosecre::obtenernombresecretaria();
        $secretarias=secretaria::all();
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);
         /*return view('sueldosecre.reporsusecre',compact('sueldosecres','secretarias'));*/
         return response()->view('sueldosecre.reporsusecre',compact('sueldosecres','secretarias'))->header('Cache-Control', 'no-cache, no-store, must-revalidate'); 
    }
    public function index()
    {
        /*$sueldosecres=sueldosecre::paginate(5);
        $secretarias=secretaria::all();*/
       // return profesor::with('sueldopro')->get(); 
        //$datos['sueldopros']=sueldopro::paginate(7);
        //return view('sueldosecre.index',compact('sueldosecres','secretarias'));

       $sueldosecres=sueldosecre::paginate(5);
        $secretarias=secretaria::all();   
          $response = response()->view('sueldosecre.index',compact('sueldosecres','secretarias'))
          ->header('Cache-Control', 'no-cache, no-store, must-revalidate') // HTTP 1.1.
          ->header('Pragma', 'no-cache') // HTTP 1.0.
          ->header('Expires', '0'); // Proxies.
          return $response;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('sueldosecre.create',['secretarias'=>secretaria::all()],['adelantosecres'=>adelantosecre::all()]);

        $adelantosecres=adelantosecre::all();  
        $secretarias=secretaria::all(); 
        $response = response()->view('sueldosecre.create',compact('adelantosecres','secretarias'))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate') // HTTP 1.1.
        ->header('Pragma', 'no-cache') // HTTP 1.0.
        ->header('Expires', '0'); // Proxies.
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datossueldosecre=request()->except('_token');
        sueldosecre::insert($datossueldosecre);
         //return response()->json($datosprofesor);
        $secretariaId = $request->input('secretaria_id');
        adelantosecre::where('secretaria_id', $secretariaId)->update(['estadoade' => 'pagado']);
        return redirect('sueldosecre');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sueldosecre  $sueldosecre
     * @return \Illuminate\Http\Response
     */
    public function show(sueldosecre $sueldosecre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sueldosecre  $sueldosecre
     * @return \Illuminate\Http\Response
     */
    public function edit(sueldosecre $sueldosecre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sueldosecre  $sueldosecre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sueldosecre $sueldosecre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sueldosecre  $sueldosecre
     * @return \Illuminate\Http\Response
     */
    public function destroy(sueldosecre $sueldosecre)
    {
        //
    }
    public function obtenerSueldosecretaria(Request $request)
    {
        $secretariaId = $request->input('secretaria_id');
        $sueldo = secretaria::obtenersueldo($secretariaId);
            
        return response()->json($sueldo);
            
    }
    public function obtenerlistasecreid(Request $request)
    {
        $secretariaId = $request->input('secretaria_id');
        $listasecre = adelantosecre::obtenerlistasecreid2($secretariaId);
            
        return response()->json($listasecre);
            
    }
    public function mesessaldosecre(Request $request)
    {
        $secretariaId = $request->input('secretaria_id');

        $cantidadRegistros = sueldosecre::where('secretaria_id', $secretariaId)->count();  

        // Obtén el profesor utilizando el profesor_id
        $secretaria= secretaria::findOrFail($secretariaId);
        // Obtén la fecha de ingreso del profesor
        $fechaIngreso = Carbon::parse($secretaria->fechadeingreso); 

        // Establecer la configuración local a español
         Carbon::setLocale('es');
        // Obtén la fecha actual
        $fechaActual = Carbon::now();  

        //sumar los meses pagados
        $fechaIngreso->addMonths($cantidadRegistros); 

        // Calcula la diferencia en meses
        $mesesTranscurridos = $fechaIngreso->diffInMonths($fechaActual); 
        // Genera los nombres de los meses para cada mes transcurrido
        $mesesTexto = [];

        for ($i = 0; $i < $mesesTranscurridos; $i++) {

            $fechaMes = $fechaIngreso->copy()->addMonths($i);
           // $mesesTexto[] = $fechaMes->IsoformatLocalized('%B');
            $mesesTexto[] = $fechaMes->isoFormat('MMMM');
        }

            
        return response()->json($mesesTexto);
            
    }
}
