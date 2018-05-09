<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Unidad_medida extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'unidad_medidas';
    
    protected $primaryKey="id_unidad";

	protected $fillable = ['nombre'];
    
    public function repuestos(){
        return $this->hasMany('ControlInventario\Repuesto','unidad_id');//Es necesario enviarle el segundo parametro con el cual reconocera nuestra PK, de lo contrario nos marcara error.En este caso le enviamos unidad_id que hace referencia a id_unidad
    }

}
