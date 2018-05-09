<?php namespace ControlInventario\Http\Controllers;
use ControlInventario\Http\Requests\CrearRegistroRequest;
use ControlInventario\Http\Requests\EditarRegistroRequest;
use ControlInventario\Repuesto;
use ControlInventario\Stock;
use ControlInventario\Sede;
use ControlInventario\Vehiculo;
use ControlInventario\Categoria;
use ControlInventario\Registro_repuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Registro_repuestoController extends Controller {
	
	public function __construct()
        
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
        $logueado=Auth::user();
        if($logueado->sede_id==1){
            $registros=Registro_repuesto::take(30)->orderBy('id_registro','desc')->get();
            $carros=Vehiculo::orderBy('placa','desc')->get();

        }else{
            $registros=Registro_repuesto::where('sede_id','=',$logueado->sede_id)->take(30)->orderBy('id_registro','desc')->get();
            $carros=Vehiculo::where('sede_id','=',$logueado->sede_id)->orderBy('placa','desc')->get();

        }
        //$cates=Categoria::all();
        $repuestos=Repuesto::all();
        $sedes=Sede::all();
        date_default_timezone_set("America/Lima");
        $fecha=date ('Y-m-d');
		return view('registro.mostrar',['registros'=>$registros,'repuestos'=>$repuestos,'carros'=>$carros,'sedes'=>$sedes,'fecha'=>$fecha]);
	}
    public function postVerRegistro(Request $request){
       $this->validate($request,['sede' => 'required|exists:sedes,id_sede','fecha1'=>'required|date_format:"Y-m-d','fecha2'=>'required|date_format:"Y-m-d']);
        if($request->get('fecha1')<=$request->get('fecha2')){
        $registros=Registro_repuesto::where('fecha','>=',$request->get('fecha1'))->where('fecha','<=',$request->get('fecha2'))->where('sede_id','=',$request->get('sede'))->get();
            
        if(sizeof($registros)>0){
            return view('registro.ver-registro',['registros'=>$registros]);
        }else{
            return redirect('/validado/registros')->with('null2',"¡No se encontro ningun registro entre las fechas !"); 
            }
        }
       return redirect('/validado/registros')->with('null',"¡La segunda fecha de debe ser mayor a la primera!");
        
    }
    public function postCrearRegistro(CrearRegistroRequest $request){
        //Falta descontar el stock te crees pendejo :v
        $repuesto_id=$request->get('repuesto');
        $sede=$request->get('sede');
        $cantidad=$request->get('cantidad');
        $stock=Stock::where('repuesto_id','=',$repuesto_id)->where('sede_id','=',$sede)->get();
        $repuesto=Repuesto::find($repuesto_id);
        if(sizeof($stock)>0 ){
            $stock_actual=$stock[0]->stock_actual;
            if($stock_actual>=$cantidad){
                Registro_repuesto::create([
            'repuesto_id'=>$repuesto_id,
            'cantidad'=>$cantidad,
            'fecha'=>$request->get('fecha'),
            'precio'=>$repuesto->precio*$cantidad,
            'placa'=>$request->get('carro'),
            'sede_id'=>$sede,
            'costo'=>$request->get('costo'),
            ]);
            $stock_real= $stock_actual-$cantidad;
            $stock[0]->stock_actual=$stock_real;
            $stock[0]->save();
        return redirect('/validado/registros')->with('creado',"¡Se registró el uso del repuesto satisfactoriamente!");
            }else{
                return redirect('/validado/registros')->with('nel',"¡No se cuenta con la cantidad requerida!"); 
            }
            
        }else{
          return redirect('/validado/registros')->with('nel1',"¡El repuesto no existe en esta sede!");  
        }
        
    }
    public function getEditarRegistro(Request $request){
        
        $this->validate($request,['id' => 'required|exists:registro_repuestos,id_registro']);
        $registro=Registro_repuesto::find($request->get('id'));
        $repuestos=Repuesto::all();
        $carros=Vehiculo::all();
        $sedes=Sede::all();
        return view('registro.actualizar-registro',['registro'=>$registro,'repuestos'=>$repuestos,'carros'=>$carros,'sedes'=>$sedes]);
    }
    public function postEditarRegistro(EditarRegistroRequest $request){
      $repuesto=$request->get('repuesto');
        $sede=$request->get('sede');
        $cantidad=$request->get('cantidad');
        //Restauracion del repuesto usado
        $registrold=Registro_repuesto::find($request->get('id'));
        $stockres=Stock::where('repuesto_id','=',$registrold->repuesto_id)->where('sede_id','=',$registrold->sede_id)->get();
        $stockres[0]->stock_actual=$stockres[0]->stock_actual+$registrold->cantidad;
        $stockres[0]->save();
        //continuara
        
        //Editando
        $stock=Stock::where('repuesto_id','=',$repuesto)->where('sede_id','=',$sede)->get();
        
        if(sizeof($stock)>0){
            $stock_actual=$stock[0]->stock_actual;
           if($stock_actual>=$cantidad){
               //restauracion
            
               //Fin de la restauracion
            $stock_real= $stock_actual-$cantidad;
            $stock[0]->stock_actual=$stock_real;
            $stock[0]->save();
            
            $registrold->repuesto_id=$repuesto;
            $registrold->cantidad=$cantidad;
            $registrold->fecha=$request->get('fecha');
            $registrold->placa=$request->get('carro');
            $registrold->sede_id=$sede;
            $registrold->costo=$request->get('costo');
            $registrold->save();
           
        return redirect('/validado/registros')->with('actualizado',"¡Se actualizó el uso del repuesto satisfactoriamente!");
        }else{
               $stockres[0]->stock_actual=$stockres[0]->stock_actual-$registrold->cantidad;
               $stockres[0]->save();
             return redirect('/validado/registros')->with('nel',"¡No se cuenta con la cantidad requerida!");
               
           }
        }else{
            $stockres[0]->stock_actual=$stockres[0]->stock_actual-$registrold->cantidad;
            $stockres[0]->save();
          return redirect('/validado/registros')->with('nel1',"¡El repuesto no existe en esta sede!");
             
        }
        
    }
    public function getEliminarRegistro(Request $request){
        $this->validate($request,['id' => 'required|exists:registro_repuestos,id_registro']);
        $registro=Registro_repuesto::find($request->get('id'));
        $registro->delete();
        
        return redirect('/validado/registros')->with('eliminado',"¡Se elimino correctamente el registro!");
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
}