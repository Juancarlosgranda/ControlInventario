<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
 
use ControlInventario\Sede;
 


class SedesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
       
        Sede::create([
            'nombre' => "Arequipa",
        ]);
         Sede::create([
            'nombre' => "Tacna",
        ]);
         Sede::create([
            'nombre' => "Arcata",
        ]);
	}

}
