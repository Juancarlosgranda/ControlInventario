<?php namespace ControlInventario\Http\Requests;

use ControlInventario\Http\Requests\Request;

class EditarRepuestoRequest extends Request {

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
            'id'=>'required|exists:repuestos,id_repuesto',
			'nombre'=>'required|max:255',
            'precio'=>'required|between:0,99.99',
            'unidad'=>'required|exists:unidad_medidas,id_unidad',
            'categoria'=>'required|exists:categorias,id_categoria',
		];
	}

}
