<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use ControlInventario\Tipo;
use ControlInventario\Unidad_medida;
use ControlInventario\Vehiculo;
use ControlInventario\Repuesto;
use ControlInventario\Sede;
use ControlInventario\Usuario;
use ControlInventario\Registro_envio;
use ControlInventario\Registro_repuesto;
use ControlInventario\Compra_repuesto;
use ControlInventario\Stock;
use ControlInventario\Categoria;


class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        Tipo::truncate();
        Categoria::truncate();
        Unidad_medida::truncate();
        Sede::truncate();
        Vehiculo::truncate();
        Repuesto::truncate();
        Usuario::truncate();
        Registro_envio::truncate();
        Registro_repuesto::truncate();
        Compra_repuesto::truncate();
        Stock::truncate();
        
        
        
        $this->call('TiposSeeder');
        $this->call('Unidad_medidasSeeder');
        $this->call('SedesSeeder');
        $this->call('VehiculosSeeder');
        $this->call('CatesSeeder');
        $this->call('RepuestosSeeder');
        $this->call('UsuariosSeeder');
        $this->call('Registro_enviosSeeder');
        $this->call('Registro_repuestosSeeder');
        $this->call('Compra_repuestosSeeder');
        $this->call('StocksSeeder');
        
        
	}

}
