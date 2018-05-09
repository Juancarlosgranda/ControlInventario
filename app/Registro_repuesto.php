<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Registro_repuesto extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registro_repuestos';
    
    protected $primaryKey="id_registro";
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['repuesto_id','cantidad','precio','fecha','placa','sede_id','costo'];
    public function repuesto(){
        return $this->belongsTo('ControlInventario\Repuesto');
    }
     public function vehiculo(){
        return $this->belongsTo('ControlInventario\Vehiculo');
    }
     public function sede(){
        return $this->belongsTo('ControlInventario\Sede');
    }
}
