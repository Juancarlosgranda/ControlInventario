<?php namespace ControlInventario;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categorias';

	protected $primaryKey="id_categoria";
    
	protected $fillable = ['nombre'];
     public function repuestos(){
        return $this->hasMany('ControlInventario\Repuesto');
    }
   


}

