<?php namespace ControlInventario\Http\Requests;

use ControlInventario\Http\Requests\Request;

class EditarEnvioRequest extends Request {

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
            'id'=>'required|exists:registro_envios,id_envio',
            'repuesto'=>'required|exists:repuestos,id_repuesto',
            'cantidad'=>'required',
            'sede'=>'required|exists:sedes,id_sede',
            'fecha'=>'required',
		];
	}

}
