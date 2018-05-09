<?php namespace ControlInventario\Http\Controllers;
use ControlInventario\Repuesto;
use ControlInventario\Unidad_medida;
use Illuminate\Http\Request;

class Unidad_medidaController extends Controller {
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
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $unidades= Unidad_medida::all();
		return view('unidad.mostrar',['unidades'=>$unidades]);
        
	}
     public function getCrearUnidad(){
        return view('unidad.crear-unidad'); 
    }
    
    public function postCrearUnidad(Request $request){
        $this->validate($request,['nombre' => 'required|unique:unidad_medidas']);
        Unidad_medida::create([
            'nombre'=>$request->get('nombre'),
        ]);
        return redirect('/validado/unidad')->with('creado','Unidad creado!'); 
    }
    
    public function getEditarUnidad(Request $request){
        $this->validate($request,['id'=>'required|exists:unidad_medidas,id_unidad']);
        $unidad= Unidad_medida::find($request->get('id'));
        
        return view('unidad.actualizar-unidad',['unidad'=>$unidad]); 
    }
    public function postEditarUnidad(Request $request){
        $this->validate($request,['nombre'=>'required']);
        $nombre=$request->get('nombre');
        $id=$request->get('id');
        $unidad=Unidad_medida::find($id);
        $unidad->nombre=$nombre;
        $unidad->save();
        
      return redirect('/validado/unidad')->with('actualizado','Unidad actualizado!'); 
    }
    
    public function getEliminarUnidad(Request $request){
        $this->validate($request,['id'=>'required|exists:unidad_medidas,id_unidad']);
        
        $unidad=Unidad_medida::find($request->get('id'));
        
        $repuestos = $unidad->repuestos;
        
        foreach($repuestos as $repuesto){
            $repuesto->delete();
        }
        
        $unidad->delete();
        return redirect('/validado/unidad')->with('eliminado','Unidad eliminado!'); 
        
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
}