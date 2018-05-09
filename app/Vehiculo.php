<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vehiculos';

    protected $primaryKey="placa";
    
	protected $fillable = ['placa','modelo','sede_id'];
    
     public function registro_repuestos(){
        return $this->hasMany('ControlInventario\Registro_repuesto');
     }
    public function sede(){
        return $this->belongsTo('ControlInventario\Sede');
    }
}
