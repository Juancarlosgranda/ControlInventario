<?php namespace ControlInventario\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use ControlInventario\Usuario;
use ControlInventario\Sede;
use ControlInventario\Stock;
use ControlInventario\Repuesto;
use ControlInventario\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ControlInventario\Http\Requests\CrearStockRequest;

class StockController extends Controller {
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
        //$stocks= Stock::groupBy('repuesto_id')->get();
        $stocks= Stock::all();
        $sedes= Sede::all();
        $cates= Categoria::all();
        
        //return $sedes;
        
		return view('stock.mostrar',['stocks'=>$stocks,'sedes'=>$sedes,'cates'=>$cates]);
	}
    public function getCrearStock(){
        
        $sedes=Sede::all();
        $repuestos=Repuesto::all();
        
        return view('stock.crear-stock',['sedes'=>$sedes,'repuestos'=>$repuestos]); 
    }
    public function postCrearStock(CrearStockRequest $request){
        $repuesto=$request->get('repuesto');
        $sede=$request->get('sede');
        $lugar=Sede::find($sede);
        $consulta=Stock::where('sede_id','=',$sede)->where('repuesto_id','=',$repuesto)->get();
        if(sizeof($consulta)>0){
           return redirect('/validado/stocks')->with('existe',"El stock ya existe en la sede $lugar->nombre");
        }
        
        Stock::create([
            'stock_min'=>$request->get('minimo'),
            'stock_max'=>$request->get('maximo'),
            'stock_actual'=>$request->get('actual'),   
            'repuesto_id'=>$request->get('repuesto'),
            'sede_id'=>$request->get('sede'),
        ]);
        
        return redirect('/validado/stocks')->with('creado','stock creado!'); 
    }
    public function getEditarStock(Request $request){
        $this->validate($request,['id'=>'required|exists:stocks,id_stock']);
        $stock= Stock::find($request->get('id'));
        return view('stock.actualizar-stock',['stock'=>$stock]); 
    }
    public function postEditarStock(Request $request){
        $this->validate($request,['id'=>'required|exists:stocks,id_stock','minimo'=>'required|numeric','maximo'=>'required|numeric','actual'=>'required|numeric']);
        $stock=Stock::find($request->get('id'));
        $stock->stock_min=$request->get('minimo');
        $stock->stock_max=$request->get('maximo');
        $stock->stock_actual=$request->get('actual');
        $stock->save();
        return redirect('/validado/stocks')->with('actualizado','stock actualizado!');
        
    }
    public function getEliminarStock(Request $request){
        $this->validate($request,['id'=>'required|exists:stocks,id_stock']);
        $stock=Stock::find($request->get('id'));
        $stock->delete();
        return redirect('/validado/stocks')->with('eliminado'); 
    }
    public function postVer(Request $request){
         /*$stocks=Stock::where('sede_id','=',$request->get('sede'))->get();
         $stocks = Stock::join('repuestos','repuestos.id_repuesto','=','stocks.repuesto_id')->select('repuestos.*')->where('repuestos.categoria_id','=',$request->get('cate'))->where('stocks.sede_id','=',$request->get('sede'))->get();*/
        if(($request->get('sede')=="all")&&($request->get('cate')=="all")){
           $stocks=DB::select('SELECT s.id_stock,r.nombre,s.stock_min,s.stock_max,s.stock_actual,c.nombre as categoria, d.nombre as sede FROM stocks s INNER JOIN repuestos r ON s.repuesto_id= r.id_repuesto INNER JOIN categorias c ON r.categoria_id = c.id_categoria INNER JOIN sedes d ON s.sede_id = d.id_sede');
            return view('stock.mostrar-stockxsede',['stocks'=>$stocks]); 
        }
        else if($request->get('sede')=="all"){
            $stocks=DB::select('SELECT s.id_stock,r.nombre,s.stock_min,s.stock_max,s.stock_actual,c.nombre as categoria, d.nombre as sede FROM stocks s INNER JOIN repuestos r ON s.repuesto_id= r.id_repuesto INNER JOIN categorias c ON r.categoria_id = c.id_categoria INNER JOIN sedes d ON s.sede_id = d.id_sede WHERE c.id_categoria=?', [$request->get('cate')]);
            return view('stock.mostrar-stockxsede',['stocks'=>$stocks]);
        } else if($request->get('cate')=="all"){
            $stocks=DB::select('SELECT s.id_stock,r.nombre,s.stock_min,s.stock_max,s.stock_actual,c.nombre as categoria, d.nombre as sede FROM stocks s INNER JOIN repuestos r ON s.repuesto_id= r.id_repuesto INNER JOIN categorias c ON r.categoria_id = c.id_categoria INNER JOIN sedes d ON s.sede_id = d.id_sede WHERE d.id_sede= ?', [$request->get('sede')]);
            return view('stock.mostrar-stockxsede',['stocks'=>$stocks]);
        }
        $stocks=DB::select('SELECT s.id_stock,r.nombre,s.stock_min,s.stock_max,s.stock_actual,c.nombre as categoria, d.nombre as sede FROM stocks s INNER JOIN repuestos r ON s.repuesto_id= r.id_repuesto INNER JOIN categorias c ON r.categoria_id = c.id_categoria INNER JOIN sedes d ON s.sede_id = d.id_sede WHERE d.id_sede= ? and c.id_categoria=?', [$request->get('sede'),$request->get('cate')]);
            return view('stock.mostrar-stockxsede',['stocks'=>$stocks]);
        }
      public function postShow(Request $request){
         $this->validate($request,['buscar'=>'required']);
         $repuestos=Repuesto::where('nombre','LIKE',"%{$request->get('buscar')}%")->get();
         if(sizeof($repuestos)>0){
          $repuesto=$repuestos[0]->id_repuesto;
          $stocks=Stock::where('repuesto_id','=',$repuesto)->get();
           return view('stock.buscar',['stocks'=>$stocks]);}
          else{
              return redirect('/validado')->with('nohay','No se obtuvo resultados :( ');
          }
        }
    
    public function missingMethod($parameters=array()){
        abort(404);
    }
}