<?php namespace ControlInventario\Http\Controllers;
use ControlInventario\Http\Requests\EditarPerfilRequest;
use Illuminate\Support\Facades\Auth;
use ControlInventario\Usuario;
use ControlInventario\Tipo;
use ControlInventario\Sede;
use ControlInventario\Http\Requests\ELiminarUsuarioRequest;
use ControlInventario\Http\Requests\CrearUsuarioRequest;

class UsuarioController extends Controller {

	 
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function getIndex(){
        
        $usuarios = Usuario::all();
        
        return view('usuario.mostrar',['usuarios'=>$usuarios]);
        
    }
	
	public function getEditarPerfil($id)
	{
        $tipos = Tipo::all();
        $sedes = Sede::all();
        $usuario = Usuario::find($id);
        return view('usuario.actualizar',['tipos'=>$tipos,'sedes'=>$sedes,'usuario'=>$usuario]); 
        
	}
     public function postEditarPerfil(EditarPerfilRequest $request){
        
        $id=$request->get('id');
        $usuario=Usuario::find($id);
        $logueado=Auth::user();
        $email=$request->get('email');
        $usuario->email=$email;
        if($request->has('password')){
            $usuario->password=bcrypt($request->get('password'));
        }
        if($request->has('pregunta')){
            $usuario->pregunta=$request->get('pregunta');
            $usuario->respuesta=$request->get('respuesta');
        }
        $usuario->save();
        if($usuario->id==$logueado->id){
        return  redirect('/validado')->with('actualizado','Su perfil ha sido actualizado');}
         else{
         return  redirect('/validado/usuario')->with('actualizado','Su perfil ha sido actualizado');    
         }
    }
    public function getRegistro()
	{
         $tipos = Tipo::all();
         $sedes = Sede::all();
        return view('usuario.registro',['tipos'=>$tipos,'sedes'=>$sedes]); 
    }
    
	public function postRegistro(CrearUsuarioRequest $request)
	{
        Usuario::create([
            'email'=>$request->get('email'),
            'tipo_id'=>$request->get('tipo'),
            'password'=>bcrypt($request->get('password')),
            'pregunta'=>$request->get('pregunta'),
            'respuesta'=>$request->get('respuesta'),
            'sede_id'=>$request->get('sede'),
        ]);
            return redirect('/validado/usuario')->with('creado','El usuario fue creado!'); 
        
		
	}
     public function getEliminar(ELiminarUsuarioRequest $request){
        $usuario=Usuario::find($request->get('id'));
        $usuario->delete();
        return redirect('/validado/usuario')->with('eliminado','El usuario fue eliminado!'); 
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
    
}