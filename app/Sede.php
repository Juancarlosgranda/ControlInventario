<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sedes';
    
    
    protected $primaryKey="id_sede";

	protected $fillable = ['nombre'];
     public function registro_repuestos(){
        return $this->hasMany('ControlInventario\Registro_repuesto');
    }
    public function stocks(){
        return $this->hasMany('ControlInventario\Stock');
    }
    public function registro_envios(){
        return $this->hasMany('ControlInventario\Registro_envio');
    }
    public function usuarios(){
        return $this->hasMany('ControlInventario\Usuario');
     }
    public function vehiculos(){
        return $this->hasMany('ControlInventario\Vehiculo');
     }



}

