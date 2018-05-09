<?php
use ControlInventario\Usuario;
use ControlInventario\Sede;
use ControlInventario\Stock;
use ControlInventario\Repuesto;
use Illuminate\Http\Request;


/*Route::post('/information/ver',function()
{
         $id_sede=Input::get('sede')*1;
         $stocks=Stock::where('sede_id','=',$id_sede)->get();
            //return $repuestos;
         return view('stock.mostrar-stockxsede',['stocks'=>$stocks]);
});*/

Route::controllers([
	'validacion' => 'validacion\ValidacionController',
    'validado/compras'=>'Compra_repuestoController',
    'validado/envios'=>'Registro_envioController',
    'validado/registros'=>'Registro_repuestoController',
    'validado/repuestos'=>'RepuestoController',
    'validado/sedes'=>'SedeController',
    'validado/stocks'=>'StockController',
    'validado/unidad'=>'Unidad_medidaController',
    'validado/vehiculos'=>'VehiculoController',
    'validado/usuario'=>'UsuarioController',
    'validado/reportes'=>'ReporteController',
    'validado/tipo'=>'TipoController',
    'validado/categoria'=>'CategoriaController',
    'validado'=>'InicioController',
    '/' => 'BienvenidaController',
]);
/*Route::get('/ajax-unidad',function(){
    $repuesto_id= Input::get('repuesto_id');
    
    $unidades=Repuesto::where('id_repuesto','=',$repuesto_id)->get();
    $unidad=$unidades[0]->unidad_medida->nombre;
    return Response::json('hola');
});
*/
Route::get('/ajax-state-repuesto',function(){
    /*$categoria_id= Input::get('categoria_id');
    
    $repuestos=Repuesto::where('categoria_id','=',$categoria_id)->get();*/

    return  "hola";
});
/*Route::get('/information/create/ajax-state-repuesto',function()
{
    $categoria_id= Input::get('categoria_id');
    
    $repuestos=Repuesto::where('categoria_id','=',$categoria_id)->get();

    return $repuestos;

});*/










