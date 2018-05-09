<?php namespace ControlInventario\Http\Requests;

use ControlInventario\Http\Requests\Request;

class EditarCompraRequest extends Request {

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
            'id'=>'required|exists:compra_repuestos,id_compra',
            'repuesto'=>'required|exists:repuestos,id_repuesto',
            'cantidad'=>'required',
            'precio'=>'required',
            'fecha'=>'required',
		];
	}

}
