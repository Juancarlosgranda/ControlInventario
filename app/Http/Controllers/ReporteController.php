<?php namespace ControlInventario\Http\Controllers;
use ControlInventario\Compra_repuesto;
use ControlInventario\Repuesto;
use ControlInventario\Sede;
use ControlInventario\Stock;
use ControlInventario\Vehiculo;
use ControlInventario\Registro_repuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ControlInventario\Registro_envio;
use PDF;

class ReporteController extends Controller {
	
	public function __construct()
        
	{
		$this->middleware('auth');
	}
    public function Index(){
        return redirect('reporte');
    }
   //Reportes para los gastos... :)
    public function getBuscarGastos(Request $request)
    {
        $sedes = Sede::all();
       
        return view('reporte.mostrar-gastos',['sedes'=>$sedes]);
    }
    public function postBuscarGastos(Request $request){
        $this->validate($request,['fecha1'=>'required|date_format:"Y-m-d','fecha2'=>'required|date_format:"Y-m-d']);
        $fechas=$request->get('fecha1').' hasta el '.$request->get('fecha2');
        if($request->get('fecha1')<=$request->get('fecha2')){
        $registros=Compra_repuesto::where('fecha','>=',$request->get('fecha1'))->where('fecha','<=',$request->get('fecha2'))->get();
        if(sizeof($registros)>0){
            //return view('registro.ver-registro',['registros'=>$registros]);
            $suma=0;
            foreach($registros as $registro){
                $suma=$suma+$registro->precio_compra;
            }
            if($request->get('reporte')==1){
            $pdf= PDF::loadView('reporte.gastos',['gastos'=>$suma,'fechas'=>$fechas,'registros'=>$registros]);
            return $pdf->download('gastos.pdf');}
            else{
                return view('reporte.gastosexcel',['gastos'=>$suma,'fechas'=>$fechas,'registros'=>$registros]);
            }
        }else{
            return redirect('/validado/reportes/buscar-gastos')->with('null2',"¡No se encontro ningun registro entre las fechas !"); 
            }
        }
       return redirect('/validado/reportes/buscar-gastos')->with('null',"¡La segunda fecha de debe ser mayor a la primera!");
        
        
    }
    //Reportes para los usos de repuestos... :)
    public function getBuscarUsos()
    {
        
        $carros = Vehiculo::all();
       
        return view('reporte.mostrar-usados',['carros'=>$carros]);
    }
     public function postBuscarUsados(Request $request){
         $this->validate($request,['fecha1'=>'required|date_format:"Y-m-d','fecha2'=>'required|date_format:"Y-m-d']);
         
        $fechas=$request->get('fecha1').' hasta el  '.$request->get('fecha2');
         
        if($request->get('fecha1')<=$request->get('fecha2')){
            
          $registros=Registro_repuesto::where('fecha','>=',$request->get('fecha1'))->where('fecha','<=',$request->get('fecha2'))->get();
         
        if(sizeof($registros)>0){
           
            $suma=0;
            $suma2=0;
            foreach($registros as $registro){
                $suma=$suma+$registro->costo;
                $suma2=$suma2+($registro->precio);
            }
            if($request->get('reporte')==1){
            $pdf= PDF::loadView('reporte.usadosxfecha',['gastos'=>$suma,'fechas'=>$fechas,'registros'=>$registros,'gastosRe'=>$suma2]);
            return $pdf->download('repuestoporfecha.pdf');}
            else{
            return view('reporte.usadosxfechaexcel',['gastos'=>$suma,'fechas'=>$fechas,'registros'=>$registros,'gastosRe'=>$suma2]);    
            }
        }else{
            return redirect('/validado/reportes/buscar-usos')->with('null2',"¡No se encontro ningun registro entre las fechas !"); 
            }
        }
       return redirect('/validado/reportes/buscar-usos')->with('null',"¡La segunda fecha de debe ser mayor a la primera!");
    }
    public function postBuscarUsadosxcarro(Request $request){
        $carro=$request->get('carro');
        $this->validate($request,['carro'=>'required','fecha1'=>'required|date_format:"Y-m-d','fecha2'=>'required|date_format:"Y-m-d']);
        $fechas=$request->get('fecha1').' hasta el '.$request->get('fecha2');
        if($request->get('fecha1')<=$request->get('fecha2')){
            $registros=Registro_repuesto::where('fecha','>=',$request->get('fecha1'))->where('fecha','<=',$request->get('fecha2'))->where('placa','=',$request->get('carro'))->get();
            
        if(sizeof($registros)>0){
            //return view('registro.ver-registro',['registros'=>$registros]);
            $suma=0;
            $suma2=0;
            foreach($registros as $registro){
                $suma=$suma+$registro->costo;
                $suma2=$suma2+($registro->precio);
            }
             if($request->get('reporte')==1){
            $pdf= PDF::loadView('reporte.usadosxcarro',['gastos'=>$suma,'fechas'=>$fechas,'registros'=>$registros,'carro'=>$carro,'gastosRe'=>$suma2]);
            return $pdf->download('repuestoporcarro.pdf');}
            else{
                return view('reporte.usadosxcarroexcel',['gastos'=>$suma,'fechas'=>$fechas,'registros'=>$registros,'carro'=>$carro,'gastosRe'=>$suma2]);
            }
        }else{
            return redirect('/validado/reportes/buscar-usos')->with('null2',"¡No se encontro ningun registro entre las fechas !"); 
            }
        }
       return redirect('/validado/reportes/buscar-usos')->with('null',"¡La segunda fecha de debe ser mayor a la primera!");
    }
    public function getReportes(){
        return view('reporte.mostrar-reportes');
    }
    public function postReportes(Request $request){
        
        if($request->get('reporte')==1){
            $registros= Registro_repuesto::where('fecha','>=',$request->get('fecha1'))->where('fecha','<=',$request->get('fecha2'))->get();
            $nota="Reporte de los registro de repuestos";
            if(sizeof($registros)==0){
                 return redirect('/validado/reportes/reportes')->with('null2',"¡No se encontro ningun registro entre las fechas !"); 
            }
            return view('reporte.rrepuestoexcel',['registros'=>$registros,'nota'=>$nota]);
             
        }
        else if($request->get('reporte')==2){
            $registros= Registro_envio::where('fecha','>=',$request->get('fecha1'))->where('fecha','<=',$request->get('fecha2'))->get();
            $nota="Reporte de los registro de envíos";
            if(sizeof($registros)==0){
                 return redirect('/validado/reportes/reportes')->with('null2',"¡No se encontro ningun registro entre las fechas !"); 
            }
            return view('reporte.renvioexcel',['registros'=>$registros,'nota'=>$nota]);
            
        }
        else if($request->get('reporte')==3){
            $registros= Compra_repuesto::where('fecha','>=',$request->get('fecha1'))->where('fecha','<=',$request->get('fecha2'))->get();
            $nota="Reporte de los registro de compras";
            if(sizeof($registros)==0){
                 return redirect('/validado/reportes/reportes')->with('null2',"¡No se encontro ningun registro entre las fechas !"); 
            }
            return view('reporte.rcompraexcel',['registros'=>$registros,'nota'=>$nota]);
        }
        else{
            $registros= Stock::all();
            $nota="Reporte del control stocks";
            if(sizeof($registros)==0){
                 return redirect('/validado/reportes/reportes')->with('null2',"¡No se encontro ningun registro entre las fechas !"); 
            }
            return view('reporte.rstockexcel',['registros'=>$registros,'nota'=>$nota]);
        }
            
        
    }
    
    public function missingMethod($parameters=array()){
        abort(404);
    }
}