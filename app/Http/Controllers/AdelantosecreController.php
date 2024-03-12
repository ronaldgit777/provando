<?php

namespace App\Http\Controllers;

use App\Models\adelantosecre;
use App\Models\secretaria;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdelantosecreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  adelantodisposecre(Request $request)
    {   
        $secretariaid2 = $request->input('secretaria_id');
       // $monto2 = $request->input('monto');
        $resultado = 0;
        $sueldosecre =secretaria::obtenerSueldo($secretariaid2);
        $fechaActual = Carbon::now();
        $diastrabajados = $fechaActual->day;
        $maxadelantomes= ($sueldosecre/30)*$diastrabajados;
        $totaladelanto = adelantosecre::obteneradelantosecre($secretariaid2);
        $resultado = $maxadelantomes-$totaladelanto ;
        $resultado1 = round($resultado, 1);
        // return  $resultado; 
         return response()->json($resultado1);        
    }
    public function  obtenerfechainiciosecreadere(Request $request)
    {   
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $secretariaid2 = $request->input('secretariaid');
       $monto11 = $request->input('monto1');
       $monto22 = $request->input('monto2');
       $estadosecre2 = $request->input('estadosecre');
       $ordenaradepro2 = $request->input('ordenaradepro');
       $mayorymenoradepro2 = $request->input('mayorymenoradepro');
       $resultadoconsulta = adelantosecre::obteneradesecredesdefechainiciore($fechaini,$fechafin,$secretariaid2,$monto11,$monto22,$estadosecre2,$ordenaradepro2,$mayorymenoradepro2);   
       return response()->json($resultadoconsulta);        
    }
    
    public function  obtenerfechainiciosecreade(Request $request)
    {   
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $buscarpro2 = $request->input('buscarpro');
       $estadopro2 = $request->input('estadopro');
       $resultadoconsulta = adelantosecre::obteneradesecredesdefechainicio($fechaini,$fechafin,$buscarpro2,$estadopro2);
           
       return response()->json($resultadoconsulta);        
    }
    public function validaradelantosecre(Request $request)
    {
        $secretariaid2 = $request->input('secretariaid');
        $monto2 = $request->input('monto');
        $resultado = false;
        $sueldosecre =secretaria::obtenerSueldo($secretariaid2);
        $fechaActual = Carbon::now();
        $diastrabajados = $fechaActual->day;
        $maxadelantomes= ($sueldosecre/30)*$diastrabajados;
        if($maxadelantomes >= $monto2){
            $totaladelanto = adelantosecre::obteneradelantosecre($secretariaid2);
            $totaladelanto = $totaladelanto+$monto2;
            if($maxadelantomes >= $totaladelanto){
                $resultado = true;
            }
        }
       // return  $resultado; 
        return response()->json($resultado);
    }
    public function reporadesecre()
    {
        $adelantosecres=adelantosecre::obtenernombresecretaria();
        $secretarias=secretaria::all();
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);
        /* return view('adelantosecre.reporadesecre',compact('adelantosecres','secretarias'));*/

         return response()->view('adelantosecre.reporadesecre',compact('adelantosecres','secretarias'))->header('Cache-Control', 'no-cache, no-store, must-revalidate');  
    }
    public function index()
    {
       // $adelantosecres=adelantosecre::paginate(10);
       // $secretarias=secretaria::all();
                // return profesor::with('sueldopro')->get(); 
                //$datos['sueldopros']=sueldopro::paginate(7);
      // return view('adelantosecre.index',compact('adelantosecres','secretarias'));

          $adelantosecres=adelantosecre::paginate(5);   
          $secretarias=secretaria::all(); 
          $response = response()->view('adelantosecre.index',compact('adelantosecres','secretarias'))
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
        //return view('adelantosecre.create',['secretarias'=>secretaria::all()],['adelantosecres'=>adelantosecre::all()]);
        
        $adelantosecres=adelantosecre::all();  
        $secretarias=secretaria::all(); 
        $response = response()->view('adelantosecre.create',compact('adelantosecres','secretarias'))
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
        $datosadelantosecre=request()->except('_token');
        adelantosecre::insert($datosadelantosecre);
        //return response()->json($datosprofesor);
        return redirect('adelantosecre');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\adelantosecre  $adelantosecre
     * @return \Illuminate\Http\Response
     */
    public function show(adelantosecre $adelantosecre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\adelantosecre  $adelantosecre
     * @return \Illuminate\Http\Response
     */
    public function edit(adelantosecre $adelantosecre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\adelantosecre  $adelantosecre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adelantosecre $adelantosecre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\adelantosecre  $adelantosecre
     * @return \Illuminate\Http\Response
     */
    public function destroy(adelantosecre $adelantosecre)
    {
        //
    }
    public function obtenersumatoriaadelantossecretaria(Request $request)
    {
        $secretariaId = $request->input('secretaria_id');
        $totaladelanto = adelantosecre::obteneradelantosecre($secretariaId);//obteneradelanto es la funcion del adelantopro el modelo
        return response()->json($totaladelanto);
    }
}
