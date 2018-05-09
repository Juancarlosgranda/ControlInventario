<?php namespace ControlInventario\Http\Controllers;
use ControlInventario\Http\Requests\CrearRepuestoRequest;
use ControlInventario\Http\Requests\EditarRepuestoRequest;
use ControlInventario\Unidad_medida;
use ControlInventario\Categoria;
use ControlInventario\Repuesto;
use Illuminate\Http\Request;

class RepuestoController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *s
	 * @return Response
	 */
	public function getIndex()
	{
        $repuestos=Repuesto::all();
		return view('repuesto.mostrar',['repuestos'=>$repuestos]);
	}
    public function getCrearRepuesto(){
        
        $unidades=Unidad_medida::all();
        $categorias=Categoria::all();
        
		return view('repuesto.crear-repuesto',['unidades'=>$unidades,'categorias'=>$categorias]);
    }
    
    public function postCrearSede(CrearRepuestoRequest $request){
        
        Repuesto::create([
            'nombre'=>$request->get('nombre'),
            'precio'=>$request->get('precio'),
            'unidad_id'=>$request->get('unidad'),
            'categoria_id'=>$request->get('categoria'),
        ]);
        return redirect('/validado/repuestos')->with('creado','repuesto creado!'); 
    }
    
    public function getEditarRepuesto(Request $request){
        $this->validate($request,['id'=>'required|exists:repuestos,id_repuesto']);
        $repuesto= Repuesto::find($request->get('id'));
        $unidades=Unidad_medida::all();
        $categorias=Categoria::all();
        
        return view('repuesto.actualizar-repuesto',['repuesto'=>$repuesto,'unidades'=>$unidades,'categorias'=>$categorias]); 
    }
    public function postEditarRepuesto(EditarRepuestoRequest $request){
        $this->validate($request,['id'=>'required|exists:repuestos,id_repuesto']);
        $id=$request->get('id');
        $nombre=$request->get('nombre');
        $precio=$request->get('precio');
        $unidad=$request->get('unidad');
        $categoria=$request->get('categoria');
        
        $repuesto=Repuesto::find($id);
        $repuesto->nombre=$nombre;
        $repuesto->precio=$precio;
        $repuesto->unidad_id=$unidad;
        $repuesto->categoria_id=$categoria;
        $repuesto->save();
        
      return redirect('/validado/repuestos')->with('actualizado','repuesto actualizado!'); 
    }
    
    public function getEliminarRepuesto(Request $request){
        $this->validate($request,['id'=>'required|exists:repuestos,id_repuesto']);
        $id_repuesto=$request->get('id');
        $repuesto=Repuesto::find($id_repuesto);
        $regRepuestos=$repuesto->registro_repuestos;
        $stocks=$repuesto->stocks;
        $regEnvios=$repuesto->registro_envios;
        $compraReps=$repuesto->compra_repuestos;
        foreach($compraReps as $compraRep){
            $compraRep->delete();
        }
        foreach($regRepuestos as $regRepuesto){
            $regRepuesto->delete();
        }
        foreach($regEnvios as $regEnvio){
            $regEnvio->delete();
        }
        foreach($stocks as $stock){
            $stock->delete();
        }
        $repuesto->delete();
        return redirect('/validado/repuestos')->with('eliminado','repuesto eliminado!'); 
       
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
}