<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegistroEnvio extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registro_envios', function(Blueprint $table)
		{   
            $table->integer('repuesto_id')->unsigned();
            $table->foreign('repuesto_id')->references('id_repuesto')->on('repuestos');
			$table->increments('id_envio');
            $table->integer('cantidad');
            $table->date('fecha');
            $table->integer('sede_id')->unsigned();
            $table->foreign('sede_id')->references('id_sede')->on('sedes');
            $table->string('remision');
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
		Schema::drop('registro_envios');
	}

}
