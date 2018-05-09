<?php namespace ControlInventario\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use ControlInventario\Usuario;
use ControlInventario\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller {
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
        $sedes = Sede::all();
        
		return view('sede.mostrar',['sedes'=>$sedes]);
	}
    public function getCrearSede(){
        return view('sede.crear-sede'); 
    }
    
    public function postCrearSede(Request $request){
        $this->validate($request,['nombre' => 'required|unique:sedes']);
        Sede::create([
            'nombre'=>$request->get('nombre'),
        ]);
        return redirect('/validado/sedes')->with('creado','sede creado!'); 
    }
    
    public function getEditarSede(Request $request){
        $this->validate($request,['id'=>'required|exists:sedes,id_sede']);
        $sede= Sede::find($request->get('id'));
        
        return view('sede.actualizar-sede',['sede'=>$sede]); 
    }
    public function postEditarSede(Request $request){
        $this->validate($request,['nombre'=>'required']);
        $nombre=$request->get('nombre');
        $id=$request->get('id');
        $sede=Sede::find($id);
        $sede->nombre=$nombre;
        $sede->save();
        
      return redirect('/validado/sedes')->with('actualizado','sede actualizado!'); 
    }
    
    public function getEliminarSede(Request $request){
        $this->validate($request,['id'=>'required|exists:sedes,id_sede']);
        
        $sede=Sede::find($request->get('id'));
        $usuarios=$sede->usuarios;
        $regRepuestos=$sede->registro_repuestos;
        $stocks=$sede->stocks;
        $regEnvios=$sede->registro_envios;
        $vehiculos=$sede->vehiculos;
        foreach($usuarios as $usuario){
            $usuario->delete();
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
        foreach($vehiculos as $vehiculo){
            $vehiculo->sede_id=1;
            $vehiculo->save();
        }
        $sede->delete();
        return redirect('/validado/sedes')->with('eliminado','sede eliminado!'); 
        
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
}