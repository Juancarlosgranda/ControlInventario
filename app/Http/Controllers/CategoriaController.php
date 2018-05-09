<?php namespace ControlInventario\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use ControlInventario\Repuesto;
use ControlInventario\Categoria;
use Illuminate\Http\Request;


class CategoriaController extends Controller {
	
	public function __construct()
	{
		$this->middleware('auth');
	}

	
	public function getIndex()
	{  
        $categorias= Categoria::all();
        
		return view('categoria.mostrar',['categorias'=>$categorias]);
	}
    
    public function getCrearCategoria(){
        return view('categoria.crear-categoria'); 
    }
    
    public function postCrearCategoria(Request $request){
        $this->validate($request,['nombre' => 'required|unique:categorias']);
        Categoria::create([
            'nombre'=>$request->get('nombre'),
        ]);
        return redirect('/validado/categoria')->with('creado','categorias creado!'); 
    }
    
    public function getEditarCategoria(Request $request){
        $this->validate($request,['id'=>'required|exists:categorias,id_categoria']);
        $categoria= Categoria::find($request->get('id'));
        
        return view('categoria.actualizar-categoria',['categoria'=>$categoria]); 
    }
    public function postEditarCategoria(Request $request){
        $this->validate($request,['nombre'=>'required|unique:categorias']);
        $nombre=$request->get('nombre');
        $id=$request->get('id');
        $categoria=Categoria::find($id);
        $categoria->nombre=$nombre;
        $categoria->save();
        
      return redirect('/validado/categoria')->with('actualizado','categorias actualizado!'); 
    }
    
    public function getEliminarCategoria(Request $request){
        $this->validate($request,['id'=>'required|exists:categorias,id_categoria']);
        
        $categoria=Categoria::find($request->get('id'));
        $repuestos=$categoria->repuestos;
        foreach($repuestos as $repuesto){
            $repuesto->delete();
        }
        $categoria->delete();
        return redirect('/validado/categoria')->with('eliminado','categorias eliminado!'); 
        
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
}