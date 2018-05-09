<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model {

	protected $table = 'stocks';
    
    protected $primaryKey="id_stock";
    
	protected $fillable = ['stock_min','stock_max','stock_actual','repuesto_id','sede_id'];
     public function repuesto(){
        return $this->belongsTo('ControlInventario\Repuesto');
    }
     public function sede(){
        return $this->belongsTo('ControlInventario\Sede');
    }
}
