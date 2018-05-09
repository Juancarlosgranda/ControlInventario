<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaStock extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stocks', function(Blueprint $table)
		{
			$table->increments('id_stock');
            $table->integer('stock_min');
            $table->integer('stock_max');
            $table->integer('stock_actual');
            $table->integer('repuesto_id')->unsigned();
            $table->foreign('repuesto_id')->references('id_repuesto')->on('repuestos');
            $table->integer('sede_id')->unsigned();
            $table->foreign('sede_id')->references('id_sede')->on('sedes');
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
		Schema::drop('stocks');
	}

}
