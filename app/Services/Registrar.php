<?php namespace ControlInventario\Services;

use ControlInventario\Usuario;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'email' => 'required|email|max:255|unique:usuarios',
			'password' => 'required|confirmed|min:6',
            'pregunta'=>'required|max:255',
            'respuesta'=>'required|max:255',
            'sede'=>'required',
            'tipo'=>'required'
		]);
	}

	public function create(array $data)
	{
		return Usuario::create([
			'email' => $data['email'],
            'tipo_id'=>$data['tipo'],
			'password' => bcrypt($data['password']),
            'pregunta'=>$data['pregunta'],
            'respuesta'=>$data['respuesta'],
            'sede_id'=>$data['sede'],
		]);
	}

}
