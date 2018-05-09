<?php namespace ControlInventario;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table = 'usuarios';

    protected $primaryKey="id";
	
	protected $fillable = ['email', 'password','tipo_id','pregunta','respuesta','sede_id'];

	protected $hidden = ['password', 'remember_token'];
    
    public function sede(){
        return $this->belongsTo('ControlInventario\Sede');
        
    }
    public function tipo(){
        return $this->belongsTo('ControlInventario\Tipo');
    }
   
        
    
        

}
