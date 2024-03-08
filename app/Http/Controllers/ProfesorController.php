<?php

namespace App\Http\Controllers;
use App\Custom\MyClass;
use App\Models\adelantopro;
use App\Models\profesor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfesorController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function  obtenerfechainicio2(Request $request)
    {   
       $rutaImagenBase = asset('storage').'/';
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $buscarpro2 = $request->input('buscarpro');
       $estadopro2 = $request->input('estadopro');
       $resultadoconsulta = profesor::obtenerprofesoresdesdefechainicio2($fechaini,$rutaImagenBase,$fechafin,$buscarpro2,$estadopro2);
           
       return response()->json($resultadoconsulta);        
    }
    public function  obtenerfechainicio2secre(Request $request)
    {   
       $rutaImagenBase = asset('storage').'/';
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $buscarpro2 = $request->input('buscarpro');
       $estadopro2 = $request->input('estadopro');
       $resultadoconsulta = profesor::obtenerprofesoresdesdefechainicio2secre($fechaini,$rutaImagenBase,$fechafin,$buscarpro2,$estadopro2);
           
       return response()->json($resultadoconsulta);        
    }

    public function obtenermenorfechainicio()
    {   
       $buscarmenorfecha = profesor::obtenermenorfechadesdefechainicio();
       return response()->json($buscarmenorfecha);
    }

     public function  obtenerfechainicio(Request $request)
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
        $resultadoconsulta = profesor::obtenerprofesoresdesdefechainicio($fechaini,$rutaImagenBase,$fechafin,
        $cipro2,$nombrepro2,$apellidopaternopro2,$apellidomaternopro2,$celularpro2,$direccionpro2,$emailpro2,$estadopro2,
        $sueldominpro2,$sueldomaxpro2, $ordenarpro2, $mayorymenorpro2);
            
        return response()->json($resultadoconsulta);        
     }

     public function reporpro()
     {   
         $profesors = Profesor::obtenerProfesoresConRutaImagen();
         $user=user::all();
         return view('profesor.reporpro', compact('profesors','user'));    
     }
    public function opcionesreporte()
    {   
         return view('profesor.reporopciones');    
    }
    public function index()
    {   
       $profesors=profesor::paginate(5);
      //  $profesors=profesor::all();
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);
         return view('profesor.index',compact('profesors'));    
    }
    public function indexsecre()
    {   
       $profesors=profesor::paginate(5);
      //  $profesors=profesor::all();
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);
         return view('profesor.indexsecre',compact('profesors'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('profesor.create');
        return view('profesor.create',['users'=>User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosprofesor=request()->except('_token');
        if($request->hasfile('imagen')){
            $datosprofesor['imagen']=$request->file('imagen')->store('uploads','public');
        }
        profesor::insert($datosprofesor);
        //return response()->json($datosprofesor);
        return redirect('profesor');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profesor=profesor::findOrFail($id);
        $user=user::all();
        return view('profesor.show',compact('profesor','user'));
    }
    public function show2($id)
    {
        $profesor=profesor::findOrFail($id);
        $user=user::all();
        return view('profesor.show2',compact('profesor','user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profesor=profesor::findOrFail($id);
        //$sueldopro=sueldopro::get()->where('$id','=','12');
        return view('profesor.edit',compact('profesor'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
       $contranueva=($request->input('password_confirmation'));
       $email=($request->input('email'));
       unset($request['password_confirmation']);
       unset($request['email']);

       $datosprofesor=request()->except(['_token','_method']);
        if($request->hasFile('imagen')){
            $profesor=profesor::findOrFail($id);
            storage::delete('public/'.$profesor->imagen);
            $datosprofesor['imagen']=$request->file('imagen')->store('uploads','public');
        }
        profesor::where('id','=',$id)->update($datosprofesor);
     // $user=user::join('secretarias','users.secretaria_id','=',$id);
     $profesor = profesor::findOrFail($id);
     $user = $profesor->user;
     $userId = $user->id;

      user::where('id','=',$userId)->update([
       'email' =>($email),
       'password' =>Hash::make($contranueva)
         ]);
       $profesor=profesor::findOrFail($id);
    
      // return view('profesor.edit',compact('profesor'));
      return redirect('profesor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesor=profesor::findOrfail($id);
        if(storage::delete('public/'.$profesor->imagen)){
            profesor::destroy($id);
        }
        return redirect('profesor');
    }

}
