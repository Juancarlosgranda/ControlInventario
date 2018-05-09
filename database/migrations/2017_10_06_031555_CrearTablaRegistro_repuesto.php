<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegistroRepuesto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registro_repuestos', function(Blueprint $table)
		{
			$table->increments('id_registro');
            $table->integer('repuesto_id')->unsigned();
            $table->foreign('repuesto_id')->references('id_repuesto')->on('repuestos');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->date('fecha');
            $table->string('placa');
            $table->foreign('placa')->references('placa')->on('vehiculos');
            $table->integer('sede_id')->unsigned();
            $table->foreign('sede_id')->references('id_sede')->on('sedes');
            $table->decimal('costo', 10, 2);
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
		Schema::drop('registro_repuestos');
	}

}
