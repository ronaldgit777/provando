<?php

namespace App\Http\Controllers;

use App\Models\inscripcion;
use App\Models\turno;
use App\Models\User;
use App\Models\asignarproma;
use App\Models\alumno;
use App\Models\periodo;
use App\Models\aula;
use App\Models\materia;
use App\Models\profesor;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function  obtenerfechainicioalumnosprofe(Request $request)
    {   
       $rutaImagenBase = asset('storage').'/';
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $buscaralu2 = $request->input('buscaralu');
       $materiaid2 = $request->input('materiaid');
       $aulaid2 = $request->input('aulaid');
       $periodoid2 = $request->input('periodoid');
       $userid=auth()->user()->id;
       $resultadoconsulta = inscripcion::obtenerfecchainicioalumnoslistaprofe($fechaini,$rutaImagenBase,$fechafin,$buscaralu2,$userid,$materiaid2,$aulaid2,$periodoid2);
       return response()->json($resultadoconsulta); 
    }
    public function  listaalumnosinscritos(Request $request)
    {   
       
       $materiaid2 = $request->input('materiaid');
       $resultadoconsulta = inscripcion::obtenerlistaalumnosinscritos($materiaid2);
       return response()->json($resultadoconsulta); 
    }
    public function  buscarfechainicioinscripcionesreportesecre(Request $request)
    {   
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $profesorid2 = $request->input('profesorid');
       $materiaid2 = $request->input('materiaid');
       $periodoid2 = $request->input('periodoid');
       $aulaid2 = $request->input('aulaid');
       $alumnoid2 = $request->input('alumnoid');  $alumnoidpa2 = $request->input('alumnoidpa');  $alumnoidma2 = $request->input('alumnoidma');
       $estadosecre2 = $request->input('estadosecre');
       $ordenarins2 = $request->input('ordenarins');
       $mayorymenorins2 = $request->input('mayorymenorins');
       $resultadoconsulta = inscripcion::obtenerfecchainicioinscripcionreportesecre($fechaini,$fechafin,$profesorid2,$materiaid2,$periodoid2,$aulaid2,$alumnoid2,$ordenarins2,$mayorymenorins2,$alumnoidpa2,$alumnoidma2,$estadosecre2);
       return response()->json($resultadoconsulta); 
    }
    public function  buscarfechainicioinscripcionesreporte(Request $request)
    {   
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $profesorid2 = $request->input('profesorid');
       $materiaid2 = $request->input('materiaid');
       $periodoid2 = $request->input('periodoid');
       $aulaid2 = $request->input('aulaid');
       $alumnoid2 = $request->input('alumnoid');  $alumnoidpa2 = $request->input('alumnoidpa');  $alumnoidma2 = $request->input('alumnoidma');
       $estadosecre2 = $request->input('estadosecre');
       $ordenarins2 = $request->input('ordenarins');
       $mayorymenorins2 = $request->input('mayorymenorins');
       $resultadoconsulta = inscripcion::obtenerfecchainicioinscripcionreporte($fechaini,$fechafin,$profesorid2,$materiaid2,$periodoid2,$aulaid2,$alumnoid2,$ordenarins2,$mayorymenorins2,$alumnoidpa2,$alumnoidma2,$estadosecre2);
       return response()->json($resultadoconsulta); 
    }
    public function  buscarfechainicioinscripciones(Request $request)
    {   
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $buscarin2 = $request->input('buscarin');
       $estadopro2 = $request->input('estadopro');
       $resultadoconsulta = inscripcion::obtenerfecchainicioinscripcion($fechaini,$fechafin,$buscarin2,$estadopro2 );
       return response()->json($resultadoconsulta); 
    }
    public function index2secre()
    {
        $inscripcions=inscripcion::obtenerdatosde3tabla();//reusando de del mode inscripcion 
        $profesors = profesor::all();
        $alumnos =alumno::all();
        $alumnosapeno=alumno::obtenerno();
        $alumnosapepa=alumno::obtenerapellidospa();
        $alumnosapema=alumno::obtenerapellidosma();
        $materias =materia::all();
        $aulas =aula::all();
        $periodos =periodo::all();
        $asignarpromas =asignarproma::all();
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);
        // return view('inscripcion.reporprofealumnosecre',compact('inscripcions','profesors','materias','aulas','periodos','alumnos','asignarpromas','alumnosapeno','alumnosapepa','alumnosapema'));
         return response()->view('inscripcion.reporprofealumnosecre',compact('inscripcions','profesors','materias','aulas','periodos','alumnos','asignarpromas','alumnosapeno','alumnosapepa','alumnosapema'))
         ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
    public function index2()
    {
        $inscripcions=inscripcion::obtenerdatosde3tabla();//reusando de del mode inscripcion 
        $profesors = profesor::all();
        $alumnos =alumno::all();
        $alumnosapeno=alumno::obtenerno();
        $alumnosapepa=alumno::obtenerapellidospa();
        $alumnosapema=alumno::obtenerapellidosma();
        $materias =materia::all();
        $aulas =aula::all();
        $periodos =periodo::all();
        $asignarpromas =asignarproma::all();
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);
         return view('inscripcion.reporprofealumno',compact('inscripcions','profesors','materias','aulas','periodos','alumnos','asignarpromas','alumnosapeno','alumnosapepa','alumnosapema'));
         /*return response()->view('inscripcion.reporprofealumno',compact('inscripcions','profesors','materias','aulas','periodos','alumnos','asignarpromas','alumnosapeno','alumnosapepa','alumnosapema'))
         ->header('Cache-Control', 'no-cache, no-store, must-revalidate');*/
        }
    public function index()
    {
        /*$inscripcions=inscripcion::obtenerdatosde3tabla();
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);
         return view('inscripcion.index',compact('inscripcions'));*/

         $inscripcions=inscripcion::obtenerdatosde3tabla();  
        $response = response()->view('inscripcion.index',compact('inscripcions'))
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
       // $asignarpromas = asignarproma::where('estado', 'activo')->distinct('profesor_id')->get();
       $asignarpromas = asignarproma::where('estado', 'activo')
        ->select('profesor_id')
        ->distinct()
        ->get();
        $alumnos =alumno::all();
        //$profesors =profesor::has('asignarproma');
        $profesors =profesor::all();
        $users =user::all();
        $materias =materia::all();
        $aulas =aula::all();
        $periodos =periodo::all();  
       // return view('inscripcion.create', compact('asignarpromas','alumnos','profesors', 'users', 'materias', 'aulas', 'periodos'));

        return response()->view('inscripcion.create', compact('asignarpromas','alumnos','profesors', 'users', 'materias', 'aulas', 'periodos'))->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosinscripcion=request()->except('_token');

        $fechadeinscripcion = $request->input('fechadeinscripcion');
        $asignarproma_id = $request->input('asignarproma_id');

        $profesoridva= $request->input('profesor_id');
        $alumnoidva=$request->input('alumno_id');

        $alumno_id = $request->input('alumno_id');
        $estado = $request->input('estado');
        
        $existeregistro =inscripcion::verificarregistroins($fechadeinscripcion, $asignarproma_id, $alumno_id , $estado);
        if ($existeregistro) {
            return redirect('inscripcion/create')->with('error', 'El registro ya existe.')//hasta ahi la validacion
            ->with([
                'mensaje' => 'Registro insertado exitosamente.',//envio de datos q ya estaban
                'profesor_id'  => $profesoridva,
                'alumno_id'  => $alumnoidva

            ]);
           
        }
        inscripcion::insert($datosinscripcion);
        //return response()->json($datosprofesor);
        return redirect('inscripcion');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $inscripcion=inscripcion::findOrFail($id);
        $alumno=alumno::all();
        $asignarproma=asignarproma::all();
        $user=user::all();
        $materia=materia::all();
        $profesor=profesor::all();
        $aula=aula::all();
        $periodo=periodo::all();
       // return view('inscripcion.show',compact('inscripcion','alumno','asignarproma','user','materia','profesor','aula','periodo'));

        return response()->view('inscripcion.show',compact('inscripcion','alumno','asignarproma','user','materia','profesor','aula','periodo'))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(inscripcion $inscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inscripcion $inscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(inscripcion $inscripcion)
    {
        //
    }
}
