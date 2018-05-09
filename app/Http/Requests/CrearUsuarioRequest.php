<?php namespace ControlInventario\Http\Requests;

use ControlInventario\Http\Requests\Request;

class CrearUsuarioRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email' => 'required|email|max:255|unique:usuarios',
			'password' => 'required|confirmed|min:6',
            'pregunta'=>'required|max:255',
            'respuesta'=>'required|max:255',
            'sede'=>'required',
            'tipo'=>'required'
		];
	}

}
