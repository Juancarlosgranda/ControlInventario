<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use ControlInventario\Tipo;


class TiposSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        Tipo::create([
            'nombre' => "Administrador",
        ]);
        Tipo::create([
            'nombre' => "Encargado",
        ]);
	}

}
