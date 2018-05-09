<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Registro_envio extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registro_envios';
    
    protected $primaryKey="id_envio";
	
	protected $fillable = ['repuesto_id','cantidad','fecha','sede_id','remision'];
    
    public function repuesto(){
        return $this->belongsTo('ControlInventario\Repuesto');
    }
     public function sede(){
        return $this->belongsTo('ControlInventario\Sede');
    }
}
