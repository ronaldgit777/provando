<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\secretaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  obtenerfechainiciosecre2(Request $request)
    {   
       $rutaImagenBase = asset('storage').'/';
       $fechaini = $request->input('fechainicio');
       $fechafin = $request->input('fechafinal');
       $buscarsecre2 = $request->input('buscarsecre');
       $estadosecre2 = $request->input('estadosecre');
       $resultadoconsulta = secretaria::obtenersecretariasdesdefechainicio2($fechaini,$rutaImagenBase,$fechafin,$buscarsecre2, $estadosecre2 );
           
       return response()->json($resultadoconsulta);        
    }

    public function obtenermenorfechainicio()
    {   
       $buscarmenorfecha = secretaria::obtenermenorfechadesdefechainicio();
       return response()->json($buscarmenorfecha);
    }

     public function  obtenerfechainiciosecre(Request $request)
     {   
        $rutaImagenBase = asset('storage').'/';
        $fechaini = $request->input('fechainicio');
        $fechafin = $request->input('fechafinal');
        $cisecre2 = $request->input('cisecre');
        $nombresecre2 = $request->input('nombresecre');
        $apellidopaternosecre2 = $request->input('apellidopaternosecre');
        $apellidomaternosecre2 = $request->input('apellidomaternosecre');
        $celularsecre2 = $request->input('celularsecre');
        $direccionsecre2 = $request->input('direccionsecre');
        $emailsecre2 = $request->input('emailsecre');
        $estadosecre2 = $request->input('estadosecre');
        $sueldominsecre2 = $request->input('sueldominsecre');
        $sueldomaxsecre2 = $request->input('sueldomaxsecre');
        $ordenarsecre2 = $request->input('ordenarsecre'); $mayorymenorsecre2 = $request->input('mayorymenorsecre');
        $resultadoconsulta = secretaria::obtenersecretariasdesdefechainicio($fechaini,$rutaImagenBase,$fechafin,
        $cisecre2,$nombresecre2,$apellidopaternosecre2,$apellidomaternosecre2,$celularsecre2,$direccionsecre2,$emailsecre2,$estadosecre2,
        $sueldominsecre2,$sueldomaxsecre2, $ordenarsecre2, $mayorymenorsecre2);
            
        return response()->json($resultadoconsulta);        
     }
     public function reporsecres()
     {   
         $secretarias = secretaria::obtenerSecretariasConRutaImagen();
         return view('secretaria.reporsecre', compact('secretarias'));    
     }
     public function opcionesreportesecre()
     {   
          return view('secretaria.reporsecretarias');    
     }
    public function index()
    {   
       
        // return profesor::with('sueldopro')->get(); 
         //$datos['sueldopros']=sueldopro::paginate(7);

         /*
         $secretarias=secretaria::paginate(5);
         return view('secretaria.index',compact('secretarias'));*/
///
          $secretarias=secretaria::paginate(5);     
          $response = response()->view('secretaria.index', compact('secretarias'))
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
        return view('secretaria.create',['users'=>user::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datossecretaria=request()->except('_token');
        if($request->hasfile('imagen')){
            $datossecretaria['imagen']=$request->file('imagen')->store('uploads','public');
        }
        secretaria::insert($datossecretaria);
        //return response()->json($datosprofesor);
        return redirect('secretaria');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $secretaria=secretaria::findOrFail($id);
        $user=user::all();
        //return view('secretaria.show',compact('secretaria','user'));
        return response()->view('secretaria.show',compact('secretaria','user'))->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $secretaria=secretaria::findOrFail($id);
        $user=user::join('secretarias','users.secretaria_id','=',$id);
        return response()->view('secretaria.edit',compact('secretaria','user'))->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contranueva=($request->input('password_confirmation'));
        $email=($request->input('email'));
        unset($request['password_confirmation']);
        unset($request['email']);

        $datossecretaria=request()->except(['_token','_method']);
        if($request->hasFile('imagen')){
            $secretaria=secretaria::findOrFail($id);
            storage::delete('public/'.$secretaria->imagen);
            $datossecretaria['imagen']=$request->file('imagen')->store('uploads','public');
        }
       secretaria::where('id','=',$id)->update($datossecretaria);
      // $user=user::join('secretarias','users.secretaria_id','=',$id);
      $secretaria = Secretaria::findOrFail($id);
      $user = $secretaria->user;
      $userId = $user->id;

       user::where('id','=',$userId)->update([
        'email' =>($email),
        'password' =>Hash::make($contranueva)
          ]);
        $secretaria=secretaria::findOrFail($id);
     
       // return view('profesor.edit',compact('profesor'));
       return redirect('secretaria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(secretaria $secretaria)
    {
        //
    }
}
