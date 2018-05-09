<?php namespace ControlInventario\Http\Controllers;
use ControlInventario\Http\Requests\CrearEnvioRequest;
use ControlInventario\Http\Requests\EditarEnvioRequest;
use ControlInventario\Repuesto;
use ControlInventario\Stock;
use ControlInventario\Sede;
use ControlInventario\Registro_envio;
use Illuminate\Http\Request;

class Registro_envioController extends Controller {
	
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
       /*date_default_timezone_set("America/Lima");
        return date ('Y-m-d H:i:s');*/
        $envios= Registro_envio::take(20)->orderBy('id_envio','desc')->orderBy('fecha','desc')->get();
        return view('envio.mostrar',['envios'=>$envios]);
        //return $envios;
        
	}
    public function getCrearEnvio(){
        
        $repuestos=Repuesto::all();
        $sedes=Sede::where('id_sede','!=',1)->get();
        date_default_timezone_set("America/Lima");
        $fecha=date ('Y-m-d');
        //return $fecha;
        return view('envio.crear-envio',['repuestos'=>$repuestos,'fecha'=>$fecha,'sedes'=>$sedes]); 
    }
    public function postCrearEnvio(CrearEnvioRequest $request){
        $cantidad=$request->get('cantidad');
        $id_rep=$request->get('repuesto');
        $id_sede=$request->get('sede');
        //Veremos si existe el stock del producto del cual debemos enviar
        $stock=Stock::where('repuesto_id','=',$id_rep)->where('sede_id','=',1)->get();
        //Veremos si ese estock al cual enviaremos existe
        $stock1=Stock::where('repuesto_id','=',$id_rep)->where('sede_id','=',$id_sede)->get();
        if(sizeof($stock)==0){
            return redirect('/validado/envios')->with('null','El repuesto no posee un stock en la sede principal!');
        }
        else if(sizeof($stock1)==0){
            if($cantidad<=$stock[0]->stock_actual){
            Stock::create([
            'stock_min'=>'5',
            'stock_max'=>'200',
            'stock_actual'=>$request->get('cantidad'),   
            'repuesto_id'=>$request->get('repuesto'),
            'sede_id'=>$id_sede,
        ]);
             $descuento = $stock[0]->stock_actual;
                $descuento=$descuento-$cantidad;
                $stock[0]->stock_actual=$descuento;
                $stock[0]->save();
            
            Registro_envio::create([
                'repuesto_id'=>$id_rep,
                'cantidad'=>$cantidad,
                'fecha'=>$request->get('fecha'),
                'sede_id'=>$id_sede,
                'remision'=>$request->get('remision'),
                ]); 
            }else{
                 return redirect('/validado/envios')->with('nullo','La cantidad de envio supera el stock actual del producto en la sede principal'); 
            }
            
             return redirect('/validado/envios')->with('creado','¡El envio se realizo exitosamente!');
        }else{
            if($cantidad<=$stock[0]->stock_actual){
                //Aumentamos el stock a la respectiva sede
                $canti_actual = $stock1[0]->stock_actual;
                $canti_actual=$canti_actual+$cantidad;
                $stock1[0]->stock_actual=$canti_actual;
                $stock1[0]->save();
                //Descontamos el stock en la sede principal
                $descuento = $stock[0]->stock_actual;
                $descuento=$descuento-$cantidad;
                $stock[0]->stock_actual=$descuento;
                $stock[0]->save();
                //Una vez realizado lo anterior recien ejecutamos
                Registro_envio::create([
                'repuesto_id'=>$id_rep,
                'cantidad'=>$cantidad,
                'fecha'=>$request->get('fecha'),
                'sede_id'=>$id_sede,
                'remision'=>$request->get('remision'),
                ]);
            }
            else{
                 return redirect('/validado/envios')->with('nullo','La cantidad de envio supera el stock actual del producto en la sede principal'); 
            }
       
            return redirect('/validado/envios')->with('creado','¡El envio se realizo exitosamente!'); 
        }
    }
    public function getEditarEnvio(Request $request){
        $this->validate($request,['id' => 'required|exists:registro_envios,id_envio']);
        $envio=Registro_envio::find($request->get('id'));
        $repuestos=Repuesto::all();
        $sedes=Sede::all();
        return view('envio.actualizar-envio',['envio'=>$envio,'repuestos'=>$repuestos,'sedes'=>$sedes]); 
    }
     public function postEditarEnvio(EditarEnvioRequest $request){
        $id_rep=$request->get('repuesto');
        $cantidad=$request->get('cantidad');
        $id_sede=$request->get('sede');
        $envio=Registro_envio::find($request->get('id'));
        //Buscamos el antiguo stock y lo restauramos.
        $stockprincipal=Stock::where('repuesto_id','=',$envio->repuesto_id)->where('sede_id','=',1)->get();
        $stock=Stock::where('repuesto_id','=',$envio->repuesto_id)->where('sede_id','=',$envio->sede_id)->get();
         
         //restauracion
         $stock[0]->stock_actual=$stock[0]->stock_actual-$envio->cantidad;
         $stock[0]->save();
        //Tambien restauramos el estock principal
            $stockprincipal[0]->stock_actual=$stockprincipal[0]->stock_actual+$envio->cantidad;
            $stockprincipal[0]->save();
                //Fin de la restauracion
         
        //Hora procedemos a buscar la existencia de ese nuevo estock al cual queremos actualizar si me da cero lo crearemos de lo contrario solo modificaremos su cantidad.
        $stock1=Stock::where('repuesto_id','=',$id_rep)->where('sede_id','=',$request->get('sede'))->get();
        $stockprincipal1=Stock::where('repuesto_id','=',$id_rep)->where('sede_id','=',1)->get();
        if(sizeof($stockprincipal1)==0){
            return redirect('/validado/envios')->with('null','El repuesto no posee un stock en la sede principal!');
        }
        else if(sizeof($stock1)==0){
             if($cantidad<=$stock[0]->stock_actual){
                 //restauramos el stock donde se envio
               /* $stock[0]->stock_actual=$stock[0]->stock_actual-$envio->cantidad;
                $stock[0]->save();
                 //Tambien restauramos el estock principal
                $stockprincipal[0]->stock_actual=$stockprincipal[0]->stock_actual+$envio->cantidad;
                $stockprincipal[0]->save();*/
                //Fin de la restauracion
            Stock::create([
            'stock_min'=>'5',
            'stock_max'=>'200',
            'stock_actual'=>$cantidad,   
            'repuesto_id'=>$request->get('repuesto'),
            'sede_id'=>$request->get('sede'),
        ]);
        //descontamos al stock principal
        $stockprincipal1[0]->stock_actual=$stockprincipal1[0]->stock_actual-$cantidad;
        $stockprincipal1[0]->save();  
                 
            $envio->repuesto_id=$request->get('repuesto');
            $envio->cantidad=$cantidad;
            $envio->fecha=$request->get('fecha');
            $envio->sede_id=$request->get('sede');
            $envio->save();
           return redirect('/validado/envios')->with('actualizado1','El envio fue actualizado y el stock fue creado!'); 
             }else{
                 $stock[0]->stock_actual=$stock[0]->stock_actual+$envio->cantidad;
                 $stock[0]->save();
                //Tambien restauramos el estock principal
                    $stockprincipal[0]->stock_actual=$stockprincipal[0]->stock_actual-$envio->cantidad;
                    $stockprincipal[0]->save();
                 return redirect('/validado/envios')->with('nullo','La cantidad de envio supera el stock actual del producto en la sede principal'); 
            }
        }else{
            
        if($cantidad<=$stockprincipal1[0]->stock_actual){
            //continuando con la restauracion
               /* $stock[0]->stock_actual=$stock[0]->stock_actual-$envio->cantidad;
                $stock[0]->save();
                 //Tambien restauramos el estock principal
                $stockprincipal[0]->stock_actual=$stockprincipal[0]->stock_actual+$envio->cantidad;
                $stockprincipal[0]->save();*/
                //Fin de la restauracion
            //Eso se vuelve hacer debido a que sea el mismo stock al que solo le cambiaremos la cantidad
        $stock1=Stock::where('repuesto_id','=',$id_rep)->where('sede_id','=',$request->get('sede'))->get();
        $stockprincipal1=Stock::where('repuesto_id','=',$id_rep)->where('sede_id','=',1)->get();
        //sumamos la cantidad elegida en el stock actual del stock escogido
        $stock1[0]->stock_actual=$stock1[0]->stock_actual+$request->get('cantidad');
        $stock1[0]->save();
        //descontamos al stock principal
        $stockprincipal1[0]->stock_actual=$stockprincipal1[0]->stock_actual-$request->get('cantidad');
        $stockprincipal1[0]->save();   
            
            $envio->repuesto_id=$request->get('repuesto');
            $envio->cantidad=$request->get('cantidad');
            $envio->fecha=$request->get('fecha');
            $envio->sede_id=$request->get('sede');
            $envio->save();
        }else{
                $stock[0]->stock_actual=$stock[0]->stock_actual+$envio->cantidad;
                 $stock[0]->save();
                //Tambien restauramos el estock principal
                    $stockprincipal[0]->stock_actual=$stockprincipal[0]->stock_actual-$envio->cantidad;
                    $stockprincipal[0]->save();
                 return redirect('/validado/envios')->with('nullo','La cantidad de envio supera el stock actual del producto en la sede principal'); 
            }
        return redirect('/validado/envios')->with('actualizado','El envio fue actualizado'); 
    }
       
    }
    public function getEliminarEnvio(Request $request){
        $this->validate($request,['id' => 'required|exists:registro_envios,id_envio']);
        $envio=Registro_envio::find($request->get('id'));
        $envio->delete();
        
        return redirect('/validado/envios')->with('eliminado','¡Se elimino correctamente el registro!'); 
    }
    public function postVerEnvio(Request $request){
        $this->validate($request,['fecha1'=>'required|date_format:"Y-m-d','fecha2'=>'required|date_format:"Y-m-d']);
        if($request->get('fecha1')<=$request->get('fecha2')){
        $registros=Registro_envio::where('fecha','>=',$request->get('fecha1'))->where('fecha','<=',$request->get('fecha2'))->get();
            
        if(sizeof($registros)>0){
            return view('envio.mostrarxfecha',['registros'=>$registros]);
        }else{
            return redirect('/validado/envios')->with('bus2',"¡No se encontro ningun registro entre las fechas !"); 
            }
        }
       return redirect('/validado/envios')->with('bus',"¡La segunda fecha de debe ser mayor a la primera!");
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }
}