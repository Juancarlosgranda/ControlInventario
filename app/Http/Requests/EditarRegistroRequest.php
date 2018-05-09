<?php namespace ControlInventario\Http\Requests;

use ControlInventario\Http\Requests\Request;

class EditarRegistroRequest extends Request {

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
            'id'=>'required|exists:registro_repuestos,id_registro',
            'carro'=>'required|exists:vehiculos,placa',
            'repuesto'=>'required|exists:repuestos,id_repuesto',
            'cantidad'=>'required|integer',
            'fecha'=>'required|date_format:"Y-m-d',
            'costo'=>'required',
            'sede'=>'required|exists:sedes,id_sede',

		];
	}

}
