<?php namespace ControlInventario\Http\Controllers;
use ControlInventario\Vehiculo;
use ControlInventario\Sede;
use ControlInventario\Registro_repuesto;
use Illuminate\Http\Request;

class VehiculoController extends Controller {
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
        $vehiculos = Vehiculo::all();
        
		return view('vehiculo.mostrar',['vehiculos'=>$vehiculos]);
	}
    public function getCrearVehiculo(){
         $sedes= Sede::all();
        return view('vehiculo.crear-vehiculo',['sedes'=>$sedes]); 
    }
    
    public function postCrearVehiculo(Request $request){
        $this->validate($request,['placa' => 'required|unique:vehiculos,placa','modelo'=>'required','sede'=>'required|exists:sedes,id_sede']);
        Vehiculo::create([
            'placa'=>$request->get('placa'),
            'modelo'=>$request->get('modelo'),
            'sede_id'=>$request->get('sede'),
        ]);
        return redirect('/validado/vehiculos')->with('creado','vehiculo creado!'); 
    }
    
    public function getEditarVehiculo(Request $request){
        $this->validate($request,['id'=>'required|exists:vehiculos,placa']);
        $vehiculo= Vehiculo::find($request->get('id'));
        $sedes= Sede::all();
        return view('vehiculo.actualizar-vehiculo',['vehiculo'=>$vehiculo,'sedes'=>$sedes]); 
    }
    public function postEditarVehiculo(Request $request){
        $this->validate($request,['modelo'=>'required','sede'=>'required|exists:sedes,id_sede']);
        $modelo=$request->get('modelo');
        $id=$request->get('id');
        $vehiculo=Vehiculo::find($id);
        $vehiculo->modelo=$modelo;
        $vehiculo->sede_id=$request->get('sede');
        $vehiculo->save();
        
      return redirect('/validado/vehiculos')->with('actualizado','vehiculo actualizado!'); 
    }
    
    public function getEliminarVehiculo(Request $request){
        $this->validate($request,['id'=>'required|exists:vehiculos,placa']);
        
        $vehiculo=Vehiculo::find($request->get('id'));
        $regRepuestos=Registro_repuesto::where('placa','=',$vehiculo);
        foreach($regRepuestos as $regRepuesto){
            $regRepuesto->delete();
        }
        $vehiculo->delete();
        return redirect('/validado/vehiculos')->with('eliminado','vehiculo eliminado!'); 
        
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
}