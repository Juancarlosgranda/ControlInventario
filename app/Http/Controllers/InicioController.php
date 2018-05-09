<?php namespace ControlInventario\Http\Controllers;
use ControlInventario\Stock;
use ControlInventario\Registro_repuesto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

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
        if(Auth::user()->tipo_id==1){
            $registros=DB::select('SELECT count(*) as cantidad FROM stocks WHERE stock_min>=stock_actual');
            $valor=$registros[0]->cantidad;
             date_default_timezone_set("America/Lima");
            $fecha=date ('Y-m-d');
            $registrados=Registro_repuesto::where('fecha','=',$fecha)->count();
           return view('inicio',['registros'=>$valor,'registrados'=>$registrados]);

            //return $registros;
        }
		return redirect('/validado/registros')->with('welcome','¡Bienvenido a HyC Transportes!');
	}
    public function getVer(){
        $registros=DB::select('SELECT r.nombre,s.stock_min,s.stock_max,s.stock_actual,d.nombre as sede FROM stocks s INNER JOIN repuestos r ON s.repuesto_id= r.id_repuesto INNER JOIN sedes d ON s.sede_id = d.id_sede WHERE stock_min>=stock_actual');
        
        
           return view('inicio.mostrar',['stocks'=>$registros]); 
    }
    public function getVerRegistro(){
        date_default_timezone_set("America/Lima");
            $fecha=date ('Y-m-d');
            $registros=Registro_repuesto::where('fecha','=',$fecha)->get();
        
           return view('inicio.mostrar2',['registros'=>$registros]); 
    }
    public function missingMethod($parameters=array()){
        abort(404);
    }

}
