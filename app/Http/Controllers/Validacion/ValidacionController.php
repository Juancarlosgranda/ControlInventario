<?php namespace ControlInventario\Http\Controllers\Validacion;

use ControlInventario\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use ControlInventario\Http\Requests\IniciarSesionRequest;
use ControlInventario\Usuario;
use ControlInventario\Tipo;
use ControlInventario\Sede;
use ControlInventario\Http\Requests\RecuperarContrasenaRequest;

class ValidacionController extends Controller {

	protected $auth;

	protected $registrar;

	
	public function __construct(Guard $auth, Registrar $registrar)
	{
     $this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getSalida']);   
	}
	public function getInicio()
	{
		return view('login');
	}

	
	public function postInicio(IniciarSesionRequest $request)
	{
     
        $credentials = $request->only('email', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return 'email o contraseña incorrectos';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getSalida()
	{
        $this->auth->logout();

		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/inicio';
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : '/validacion/inicio';
	}

	public function getRecuperar(){
        return view('validacion.recuperar');
    }
    public function postRecuperar(RecuperarContrasenaRequest $request){
        
        $pregunta=$request->get('pregunta');
        $respuesta=$request->get('respuesta');
        $email=$request->get('email');
        $usuario=Usuario::where('email','=',$email)->first();
        
        if ($pregunta===$usuario->pregunta && $respuesta=== $usuario->respuesta){
            $contrasena=$request->get('password');
            $usuario->password=bcrypt($contrasena);
            $usuario->save();
            return redirect('/')->with(['recuperada'=>'La contraseña se cambió. Inicia Sesión']);
        }
        return redirect('/validacion/recuperar')->withInput($request->only('email','pregunta'))->withErrors(['pregunta'=>'La pregunta y/o respuesta ingresada no coinciden']);
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }

}