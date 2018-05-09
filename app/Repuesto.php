<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'repuestos';
    
    protected $primaryKey="id_repuesto";

	protected $fillable = ['nombre','precio','unidad_id','categoria_id'];
    
    public function registro_repuestos(){
        return $this->hasMany('ControlInventario\Registro_repuesto');
    }
    public function stocks(){
        return $this->hasMany('ControlInventario\Stock');
    }
    public function registro_envios(){
        return $this->hasMany('ControlInventario\Registro_envio');
    }
    public function compra_repuestos(){
        return $this->hasMany('ControlInventario\Compra_repuesto');
    }
    public function unidad_medida(){
        return $this->belongsTo('ControlInventario\Unidad_medida','unidad_id');
    }
     public function categoria(){
        return $this->belongsTo('ControlInventario\Categoria');
    }
}
