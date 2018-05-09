<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tipos';

	protected $primaryKey="id_tipo";
    
	protected $fillable = ['nombre'];
     public function usuarios(){
        return $this->hasMany('ControlInventario\Usuario');
    }
   


}

