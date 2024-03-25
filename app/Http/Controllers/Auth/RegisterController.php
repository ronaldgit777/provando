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
use Illuminate\Validation\Rule;


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
                  /* $validator = Validator::make($request->all(), [
                        'email' => ['required', 'email', 'unique:users,email'],
                        'nombre' => ['required', 'string', 'min:3'],
                        'celular' => ['required', 'numeric', 'between:1,8'],
                        // Otras reglas de validación
                    ], [
                        'email.required' => 'El campo email es requerido.',
                        'email.email' => 'El email debe tener un formato válido.',
                        'email.unique' => 'Este correo electrónico ya está en uso.',
                        'nombre.required' => 'El campo nombre es requerido.',
                        'nombre.string' => 'El nombre debe ser una cadena de texto.',
                        'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
                        'celular.required' => 'El campo celular es requerido.',
                        'celular.numeric' => 'El celular debe ser un número.',
                        'celular.between' => 'El celular debe tener entre 1 y 8 dígitos.'
                    ]);*/
      
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:5'], 
            'password_confirmation' => ['required', 'string', 'min:5', 'same:password'], // Añadido 'same:password'
            'nombre' => ['required', 'string', 'min:3'],
            'apellidopaterno' => ['required', 'string', 'min:5'],
            'apellidomaterno' => ['required', 'string', 'min:5'],
        ], [
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener mínimo 5 caracteres.',
            'password_confirmation.min' => 'La contraseña de confirmación debe tener mínimo 5 caracteres.',
            'password_confirmation.same' => 'La contraseña de confirmación no coincide con la contraseña.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'apellidopaterno.min' => 'El apellido paterno debe tener al menos 5 caracteres.',
            'apellidomaterno.min' => 'El apellido materno debe tener al menos 5 caracteres.'
        ]);
                    
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        //return redirect('ruta-a-redirigir');
        
        
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
        //return view('auth.registroEmpleado');
        return response()->view('auth.registroEmpleado')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
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

