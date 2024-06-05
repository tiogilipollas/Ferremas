<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
    throw ValidationException::withMessages([
        $this->username() => ['Este correo no está registrado o la contraseña incorrecta.'],
    ]);
    }

    protected function authenticated(Request $request, $user)
    {
        switch ($user->tipo_users) {
            case 'Cliente':
                return redirect()->route('inicio');
            case 'Vendedor':
                return redirect()->route('agregarproductos.create');
            case 'Bodeguero':
                return redirect()->route('administracionproductos.listaadmin');
            case 'Administrador':
                return redirect()->route('home.index');
            default:
                return redirect('/');
        }
        
    }

}
