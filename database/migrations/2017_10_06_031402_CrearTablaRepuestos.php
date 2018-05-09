<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRepuestos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('repuestos', function(Blueprint $table)
		{
			$table->increments('id_repuesto');
            $table->string('nombre');
            $table->decimal('precio', 5, 2);
            $table->integer('unidad_id')->unsigned();
            $table->foreign('unidad_id')->references('id_unidad')->on('unidad_medidas');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id_categoria')->on('categorias');
			$table->timestamps();
            
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('repuestos');
	}

}
