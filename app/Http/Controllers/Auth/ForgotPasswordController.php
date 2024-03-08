<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Notifications\CustomResetPasswordNotification;
use App\Models\User;
use Illuminate\Http\Request;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    protected function customSendResetLinkEmail(Request $request)
    {
        $email = $request->email;        

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            //return back()->withErrors(['email' => 'No pudimos encontrar un usuario con esa dirección de correo electrónico.']);
            $datos = [
                'message' => 'El correo electronico no existe en el sistema.',
                'alert' => 'danger',
            ];
    
            return response()->json($datos);
        }

        // Envía la notificación personalizada
        $user->notify(new CustomResetPasswordNotification(app('auth.password.broker')->createToken($user)));

        //return back()->with('status', 'Hemos enviado un enlace de restablecimiento de contraseña a tu correo electrónico.');
        $datos = [
            'message' => 'Hemos enviado un enlace de restablecimiento de contraseña a tu correo electrónico.',
            'alert' => 'success',
        ];

        return response()->json($datos);
    }

}
