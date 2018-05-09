<?php namespace ControlInventario\Http\Requests;

use ControlInventario\Http\Requests\Request;

class CrearStockRequest extends Request {

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
            'repuesto'=>'required|exists:repuestos,id_repuesto',
            'sede'=>'required|exists:sedes,id_sede',
            'minimo'=>'required|numeric',
            'maximo'=>'required|numeric',
            'actual'=>'required|numeric',
		];
	}

}
