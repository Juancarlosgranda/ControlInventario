<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Compra_repuesto extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'compra_repuestos';
    
    protected $primaryKey="id_compra";

	protected $fillable = ['cantidad','repuesto_id','precio_compra','fecha','factura','remision'];
     public function repuesto(){
        return $this->belongsTo('ControlInventario\Repuesto');
    }
    
}


