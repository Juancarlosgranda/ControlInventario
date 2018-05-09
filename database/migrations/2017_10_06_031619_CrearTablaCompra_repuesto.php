<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCompraRepuesto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('compra_repuestos', function(Blueprint $table)
		{
			$table->increments('id_compra');
            $table->integer('cantidad');
            $table->integer('repuesto_id')->unsigned();
            $table->foreign('repuesto_id')->references('id_repuesto')->on('repuestos');
            $table->decimal('precio_compra', 10, 2);
            $table->date('fecha');
            $table->string('factura');
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
		Schema::drop('compra_repuestos');
	}

}
