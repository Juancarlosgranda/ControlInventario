<?php namespace ControlInventario\Http\Controllers;
use ControlInventario\Http\Requests\CrearCompraRequest;
use ControlInventario\Http\Requests\EditarCompraRequest;
use ControlInventario\Repuesto;
use ControlInventario\Stock;
use ControlInventario\Compra_repuesto;
use Illuminate\Http\Request;

class Compra_repuestoController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
       /*date_default_timezone_set("America/Lima");
        return date ('Y-m-d H:i:s');*/
        $compras= Compra_repuesto::take(20)->orderBy('id_compra','desc')->orderBy('fecha','desc')->get();
        return view('compra.mostrar',['compras'=>$compras]);
        //return $compras;
        
	}
    public function getCrearCompra(){
        
        $repuestos = Repuesto::all();
        date_default_timezone_set("America/Lima");
        $fecha=date ('Y-m-d');
        return view('compra.crear-compra',['repuestos'=>$repuestos,'fecha'=>$fecha]); 
    }
    public function postCrearCompra(CrearCompraRequest $request){
        $cantidad=$request->get('cantidad');
        $id_rep=$request->get('repuesto');
      
        $stock=Stock::where('repuesto_id','=',$id_rep)->where('sede_id','=',1)->get();
        if(sizeof($stock)==0){
            Stock::create([
            'stock_min'=>'5',
            'stock_max'=>'200',
            'stock_actual'=>$request->get('cantidad'),   
            'repuesto_id'=>$request->get('repuesto'),
            'sede_id'=>'1',
        ]);
             Compra_repuesto::create([
            'repuesto_id'=>$id_rep,
            'cantidad'=>$cantidad,
            'precio_compra'=>$request->get('precio'),
            'fecha'=>$request->get('fecha'),
            'factura'=>$request->get('factura'),
            'remision'=>$request->get('remision'),
        ]);
            return redirect('/validado/compras')->with('seacreado','compra creada!');
        }else{
             Compra_repuesto::create([
            'repuesto_id'=>$id_rep,
            'cantidad'=>$cantidad,
            'precio_compra'=>$request->get('precio'),
            'fecha'=>$request->get('fecha'),
            'factura'=>$request->get('factura'),
            'remision'=>$request->get('remision'),
        ]);
            
        $canti_actual = $stock[0]->stock_actual;
        $canti_actual=$canti_actual+$cantidad;
        $stock[0]->stock_actual=$canti_actual;
        $stock[0]->save();
            
        return redirect('/validado/compras')->with('creado','compra creada!'); 
    }
    }
    public function getEditarCompra(Request $request){
        $this->validate($request,['id' => 'required|exists:compra_repuestos,id_compra']);
        $compra=Compra_repuesto::find($request->get('id'));
        $repuestos=Repuesto::all();
        //return $compra;
        return view('compra.actualizar-compra',['compra'=>$compra,'repuestos'=>$repuestos]); 
    }
    public function postEditarCompra(EditarCompraRequest $request){
        $id_rep=$request->get('repuesto');
        $compra=Compra_repuesto::find($request->get('id'));
        //Buscamos el antiguo stock y lo restauramos.
        $stock=Stock::where('repuesto_id','=',$compra->repuesto_id)->where('sede_id','=','1')->get();//Repuesto 5
        $stock[0]->stock_actual=$stock[0]->stock_actual-$compra->cantidad;
        $stock[0]->save();
        //Fin de la restauracion
        //Hora procedemos a buscar la existencia de ese nuevo estock al cual queremos actualizar si me da cero lo crearemos de lo contrario solo modificaremos su cantidad.
        $stock1=Stock::where('repuesto_id','=',$id_rep)->where('sede_id','=',1)->get();
        if(sizeof($stock1)==0){
            Stock::create([
            'stock_min'=>'5',
            'stock_max'=>'200',
            'stock_actual'=>$request->get('cantidad'),   
            'repuesto_id'=>$request->get('repuesto'),
            'sede_id'=>'1',
        ]);
            $compra->repuesto_id=$request->get('repuesto');
            $compra->cantidad=$request->get('cantidad');
            $compra->precio_compra=$request->get('precio');
            $compra->fecha=$request->get('fecha');
            $compra->save();
           return redirect('/validado/compras')->with('actualizado1','Compra actualizada/stock creado!'); 
        }else{
        
        $stock1[0]->stock_actual=$stock1[0]->stock_actual+$request->get('cantidad');
        $stock1[0]->save();
            $compra->repuesto_id=$request->get('repuesto');
            $compra->cantidad=$request->get('cantidad');
            $compra->precio_compra=$request->get('precio');
            $compra->fecha=$request->get('fecha');
            $compra->save();
            
        return redirect('/validado/compras')->with('actualizado','compra actualizada!'); 
    }
       
    }
    public function getEliminarCompra(Request $request){
        $this->validate($request,['id' => 'required|exists:compra_repuestos,id_compra']);
        $compra=Compra_repuesto::find($request->get('id'));
        $compra->delete();
        return redirect('/validado/compras')->with('eliminado','compra creada!'); 
    }
    public function postVerCompra(Request $request){
        $this->validate($request,['fecha1'=>'required|date_format:"Y-m-d','fecha2'=>'required|date_format:"Y-m-d']);
        if($request->get('fecha1')<=$request->get('fecha2')){
        $registros=Compra_repuesto::where('fecha','>=',$request->get('fecha1'))->where('fecha','<=',$request->get('fecha2'))->get();
            
        if(sizeof($registros)>0){
            return view('compra.mostrarxfecha',['registros'=>$registros]);
        }else{
            return redirect('/validado/compras')->with('bus2',"¡No se encontro ningun registro entre las fechas !"); 
            }
        }
       return redirect('/validado/compras')->with('bus',"¡La segunda fecha de debe ser mayor a la primera!");
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
}