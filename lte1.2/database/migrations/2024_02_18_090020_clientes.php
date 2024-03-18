<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->integer('cedula_cliente')->length(10)->unsigned();
            $table->string('nombre_cliente', 45);
            $table->string('apellido_cliente', 45);
            $table->string('direccion', 45);
            $table->unsignedInteger('telefono')->length(45)->unsigned();
            $table->string('email', 45);
            $table->string('ciudad', 45);
            $table->BigInteger('vehiculo_marca_id')->unsigned();
            $table->BigInteger('vehiculo_modelo_id')->unsigned();
            $table->BigInteger('vehiculo_matricula_id')->unsigned();
            $table->BigInteger('vehiculo_color_id')->unsigned();
            $table->boolean('desactivado')->default(false); // Por defecto, la venta estará activa



            /**Llaves foraneas de vehiculos jaja.*/


            $table->timestamps();
            $table->foreign('vehiculo_marca_id')->references('id')->on('vehiculos')
                ->onDelete("cascade");
            $table->foreign('vehiculo_modelo_id')->references('id')->on('vehiculos')
                ->onDelete("cascade");
            $table->foreign('vehiculo_matricula_id')->references('id')->on('vehiculos')
                ->onDelete("cascade");
            $table->foreign('vehiculo_color_id')->references('id')->on('vehiculos')
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
