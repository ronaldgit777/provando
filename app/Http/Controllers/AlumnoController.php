<?php

namespace App\Http\Controllers;

use App\Models\actividad;
use App\Models\alumno;
use App\Models\asignarproma;
use App\Models\profesor;
use App\Models\materia;
use App\Models\aula;
use App\Models\nota;
use App\Models\periodo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* SELECT * FROM `alumnos`INNER JOIN inscripcions ON alumnos.id = inscripcions.alumno_id 
    INNER JOIN asignarpromas ON inscripcions.asignarproma_id = asignarpromas.id 
    INNER JOIN profesors ON profesors.id = asignarpromas.profesor_id
    where profesors.id =20*/
   
    public function  obtenerfechainicioalumnos(Request $request)
    {   
        
       $rutaImagenBase = asset('storage').'/';
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $buscaralu2 = $request->input('buscaralu');
       $estadopro2 = $request->input('estadopro');
       $resultadoconsulta = alumno::obtenerfecchainicioalumnoslista($fechaini,$rutaImagenBase,$fechafin,$buscaralu2, $estadopro2 );
       return response()->json($resultadoconsulta); 
    }
    public function index2()
    {   
       $userid=auth()->user()->id;
       $alumnos =alumno
       //::all();
       ::join('inscripcions','inscripcions.alumno_id','=','alumnos.id')
        ->join('asignarpromas','inscripcions.asignarproma_id','=','asignarpromas.id')
        ->join('materias','asignarpromas.materia_id','=','materias.id')
        ->join('periodos','asignarpromas.periodo_id','=','periodos.id') ->join('aulas','asignarpromas.aula_id','=','aulas.id')
        ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
        ->join('users','users.id','=','profesors.user_id')
        ->select('alumnos.*','materias.materia as nombre_materia','materias.id as materiaid','periodos.periodo as nombre_periodo','aulas.aula as nombre_aula')
        ->where('profesors.user_id','=',$userid)
        ->where('asignarpromas.estado','=','activo')
        ->get();  
        $materias =materia::obtenermateriaprouser($userid);
        $aulas =aula::obteneraulaprouser($userid);
        $periodos =periodo::obtenerperiodoprouser($userid);
        $actividads =actividad::all();
        $usuario=user::obtenernombreusuario($userid);
        $notas=nota::all();
       // $alumnos=alumno::all();
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);
         return view('alumno.alumpro',compact('alumnos','materias','aulas','periodos','actividads','usuario','userid','notas'));
         
    }
     public function alumproreporte()
     {   
        $userid=auth()->user()->id;
        $alumnos =alumno
        ::join('inscripcions','inscripcions.alumno_id','=','alumnos.id')
         ->join('asignarpromas','inscripcions.asignarproma_id','=','asignarpromas.id')
         -> join('materias','asignarpromas.materia_id','=','materias.id')
         -> join('aulas','asignarpromas.aula_id','=','aulas.id')
         -> join('periodos','asignarpromas.periodo_id','=','periodos.id')  
         ->join('profesors','asignarpromas.profesor_id','=','profesors.id')
         ->join('users','users.id','=','profesors.user_id')
         ->select('alumnos.*','materias.*','aulas.*','periodos.*','asignarpromas.estado as asignarpromas_estado')
         ->where('profesors.user_id','=',$userid)
         ->get();  
         $materias =materia::obtenermateriaproalumno($userid);
         $aulas =aula::obteneraulaproalumno($userid);
        $periodos =periodo::obtenerperiodopro($userid);

         $usuario=user::all();
        // $alumnos=alumno::all();
         // return profesor::with('sueldopro')->get(); 
          //$datos['sueldopros']=sueldopro::paginate(7);
          return view('alumno.alumproreporte',compact('alumnos','materias','aulas','periodos','usuario'));
          
     }
     public function opcionesreportealumno()
     {
         $alumnos=alumno::all();
         // return profesor::with('sueldopro')->get(); 
          //$datos['sueldopros']=sueldopro::paginate(7);
          return view('alumno.reporopcionesalu',compact('alumnos'));
          
     }
     public function  obtenerfechainicioreporalusecre(Request $request)
     {   
        $rutaImagenBase = asset('storage').'/';
        $fechaini = $request->input('fechainicio');
        $fechafin = $request->input('fechafinal');
        $cipro2 = $request->input('cipro');
        $nombrepro2 = $request->input('nombrepro');
        $apellidopaternopro2 = $request->input('apellidopaternopro');
        $apellidomaternopro2 = $request->input('apellidomaternopro');
        $celularpro2 = $request->input('celularpro');
        $direccionpro2 = $request->input('direccionpro');
        $emailpro2 = $request->input('emailpro');
        $estadopro2 = $request->input('estadopro');
        $sueldominpro2 = $request->input('sueldominpro');
        $sueldomaxpro2 = $request->input('sueldomaxpro');
        $ordenarpro2 = $request->input('ordenarpro');
         $mayorymenorpro2 = $request->input('mayorymenorpro');
        $resultadoconsulta = alumno::obteneralumnosdesdefechainiciosecre($fechaini,$rutaImagenBase,$fechafin,
        $cipro2,$nombrepro2,$apellidopaternopro2,$apellidomaternopro2,$celularpro2,$direccionpro2,$emailpro2,$estadopro2,
        $sueldominpro2,$sueldomaxpro2, $ordenarpro2, $mayorymenorpro2);
            
        return response()->json($resultadoconsulta);        
     }
     public function  obtenerfechainicioreporalu(Request $request)
     {   
        $rutaImagenBase = asset('storage').'/';
        $fechaini = $request->input('fechainicio');
        $fechafin = $request->input('fechafinal');
        $cipro2 = $request->input('cipro');
        $nombrepro2 = $request->input('nombrepro');
        $apellidopaternopro2 = $request->input('apellidopaternopro');
        $apellidomaternopro2 = $request->input('apellidomaternopro');
        $celularpro2 = $request->input('celularpro');
        $direccionpro2 = $request->input('direccionpro');
        $emailpro2 = $request->input('emailpro');
        $estadopro2 = $request->input('estadopro');
        $sueldominpro2 = $request->input('sueldominpro');
        $sueldomaxpro2 = $request->input('sueldomaxpro');
        $ordenarpro2 = $request->input('ordenarpro');
         $mayorymenorpro2 = $request->input('mayorymenorpro');
        $resultadoconsulta = alumno::obteneralumnosdesdefechainicio($fechaini,$rutaImagenBase,$fechafin,
        $cipro2,$nombrepro2,$apellidopaternopro2,$apellidomaternopro2,$celularpro2,$direccionpro2,$emailpro2,$estadopro2,
        $sueldominpro2,$sueldomaxpro2, $ordenarpro2, $mayorymenorpro2);
            
        return response()->json($resultadoconsulta);        
     }
     public function reporalusecre()
     {
         $alumnos=alumno::obteneralumnosConRutaImagen();
         // return profesor::with('sueldopro')->get(); 
          //$datos['sueldopros']=sueldopro::paginate(7);
          return view('alumno.reporalusecre',compact('alumnos'));
          
     }
     public function reporalu()
     {
         $alumnos=alumno::obteneralumnosConRutaImagen();
         // return profesor::with('sueldopro')->get(); 
          //$datos['sueldopros']=sueldopro::paginate(7);
          return view('alumno.reporalu',compact('alumnos'));
          
     }
    public function index()
    {
        $alumnos=alumno::paginate(5);
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);
         return view('alumno.index',compact('alumnos'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('alumno.create',['alumnos'=>alumno::all()]);
       return view('alumno.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosalumno=request()->except('_token');
        if($request->hasfile('imagen')){
            $datosalumno['imagen']=$request->file('imagen')->store('uploads','public');
        }
        alumno::insert($datosalumno);
        //return response()->json($datosprofesor);
        return redirect('alumno');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno=alumno::findOrFail($id);
        return view('alumno.show',compact('alumno'));
    }
    public function show2alu($id)
    {
        $alumno=alumno::findOrFail($id);
        return view('alumno.show2',compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumno=alumno::findOrFail($id);
        //$sueldopro=sueldopro::get()->where('$id','=','12');
        return view('alumno.edit',compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $datosalumno=request()->except(['_token','_method']);
        if($request->hasFile('imagen')){
            $alumno=alumno::findOrFail($id);
            storage::delete('public/'.$alumno->imagen);
            $datosalumno['imagen']=$request->file('imagen')->store('uploads','public');
        }
        alumno::where('id','=',$id)->update($datosalumno);
        $alumno=alumno::findOrFail($id);
       // return view('alumno.edit',compact('alumno'));
        return redirect('alumno');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(alumno $alumno)
    {
        //
    }
}
