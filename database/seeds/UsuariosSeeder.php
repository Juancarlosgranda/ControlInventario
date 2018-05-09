<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use ControlInventario\Usuario;



class UsuariosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
    Usuario::create([
            'email' =>"admin@hyctransportes.com",
            'password'=>bcrypt("hyctrans99"),
            'tipo_id'=>"1",
            'pregunta'=>"pregunta",
            'respuesta'=>"respuesta",
            'sede_id'=>"1",
                ]);    
	}

}
