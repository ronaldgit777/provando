<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\profesor;
use App\Models\secretaria;
use App\Models\adelantopro;
use App\Models\adelantosecre;
use App\Models\alumno;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'min:2'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
     /*  $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        $roleUser = $data['role'];
            */
       // return redirect('profesor');
    }
    protected function registrarEmpleado(Request $request)
    {
      /*  $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            // Agrega aquí más reglas de validación según tus necesidades
        ]);*/
      
        $user = User::create([
           // 'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);
        
        $roleUser = "App\\Models\\".$request->input('role'); //profesor::create secretaria::create
        $sueldo =  $request->input('sueldo');
        
        $empleado = $roleUser::create([
            'fechadeingreso' => $request->input('fechadeingreso'),
            'ci' => $request->input('ci'),
            'nombre' => $request->input('nombre'),
            'apellidopaterno' => $request->input('apellidopaterno'),
            'apellidomaterno' => $request->input('apellidomaterno'),
            'celular' => $request->input('celular'),
            'direccion' => $request->input('direccion'),
            'estado' => $request->input('estado'),
            'imagen' =>$request->file('imagen')->store('uploads','public'),
            'sueldo' => $request->input('sueldo'),
            'user_id' => $user->id
        ]);
                //para obtener el id del profesor recien registrado es con: $empleado->id
         // Obtén la fecha actual del servidor
         $fechaActual = Carbon::now();
         // Obtén el día del mes    
         $dia = $fechaActual->day;

        //fecha de registro del profesor: $empleado->created_at
        if($dia>1){      
            $descuento = ($sueldo/30)*($dia-1);      
            $observacion = "por fecha de ingreso";
            $estadoade = "pendiente";
            if(str_contains($roleUser, 'profesor')){
                adelantopro::create([
                    'profesor_id' => $empleado->id,
                    'monto' => round($descuento),
                    'estadoade' => $estadoade,
                    'observacion' => $observacion,
                    'fechaadelantopro' => $fechaActual
                ]);
            }
            else{
                // si fuera secretaria 
                adelantosecre::create([
                    'secretaria_id' => $empleado->id,
                    'monto' => round($descuento),
                    'estadoade' => $estadoade,
                    'observacion' => $observacion,
                    'fechaadelantosecre' => $fechaActual
                ]);
            }
            
        }


        return redirect('home');
    }

    public function formularioEmpleado()
    {
        return view('auth.registroEmpleado');
    }  

    public function verperfiluser()
{
    $user = Auth::user();
    $profesor = Profesor::join('users', 'profesors.user_id', '=', 'users.id')
    //->join('users', 'secretarias.user_id', '=', 'users.id')
        ->where('users.id', $user->id)
        ->select('profesors.*')
        ->first();
    return view('auth.perfil', compact('user', 'profesor'));
}

    public function actualizaruser(Request $request, $id,$role)
    {
        $datosasig=request()->except(['_token','_method']);
        //$role = $request->input('tipouser');
        if($role=="profesor"){
            profesor::where('profesors.user_id','=',$id)->update([
                'celular' =>$request->input('celular'),
                'direccion' =>$request->input('direccion')
            ]);
            user::where('id','=',$id)->update([
                'email' =>$request->input('email'),
                'password' =>Hash::make($request->input('password_confirmation'))
            ]);
            return redirect('home');
        }else{
            secretaria::where('secretarias.user_id','=',$id)->update([
                'celular' =>$request->input('celular'),
                'direccion' =>$request->input('direccion')
            ]);
            user::where('id','=',$id)->update([
                'email' =>$request->input('email'),
                'password' =>Hash::make($request->input('password_confirmation'))
            ]);
            return redirect('home');
        }
    }
}
//xdebug

