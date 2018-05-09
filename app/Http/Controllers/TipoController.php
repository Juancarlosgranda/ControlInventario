<?php namespace ControlInventario\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use ControlInventario\Usuario;
use ControlInventario\Tipo;
use Illuminate\Http\Request;


class TipoController extends Controller {
	
	public function __construct()
	{
		$this->middleware('auth');
	}

	
	public function getIndex()
	{  
        $tipos= Tipo::all();
        
		return view('tipo.mostrar',['tipos'=>$tipos]);
	}
    
    public function getCrearTipo(){
        return view('tipo.crear-tipo'); 
    }
    
    public function postCrearTipo(Request $request){
        $this->validate($request,['nombre' => 'required|unique:tipos']);
        Tipo::create([
            'nombre'=>$request->get('nombre'),
        ]);
        return redirect('/validado/tipo')->with('creado','tipo creado!'); 
    }
    
    public function getEditarTipo(Request $request){
        $this->validate($request,['id'=>'required|exists:tipos,id_tipo']);
        $tipo= Tipo::find($request->get('id'));
        
        return view('tipo.actualizar-tipo',['tipo'=>$tipo]); 
    }
    public function postEditarTipo(Request $request){
        $this->validate($request,['nombre'=>'required|unique:tipos']);
        $nombre=$request->get('nombre');
        $id=$request->get('id');
        $tipo=Tipo::find($id);
        $tipo->nombre=$nombre;
        $tipo->save();
        
      return redirect('/validado/tipo')->with('actualizado','Tipo actualizado!'); 
    }
    
    public function getEliminarTipo(Request $request){
        $this->validate($request,['id'=>'required|exists:tipos,id_tipo']);
        
        $tipo=Tipo::find($request->get('id'));
        $usuarios=$tipo->usuarios;
        foreach($usuarios as $usuario){
            $usuario->delete();
        }
        $tipo->delete();
        return redirect('/validado/tipo')->with('eliminado','Tipo eliminado!'); 
        
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
}