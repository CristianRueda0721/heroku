<?php

use App\Models\Mecanico;
use Illuminate\Http\Request;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\RedirectController;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');

            $table->BigInteger('nombre_empleado_id')->unsigned();
            $table->BigInteger('apellido_empleado_id')->unsigned();
            $table->BigInteger('especialidad_id')->unsigned();

            $table->BigInteger('nombre_cliente_id')->unsigned();
            $table->BigInteger('apellido_cliente_id')->unsigned();

            $table->BigInteger('vehiculo_marca_id')->unsigned();
            $table->BigInteger('vehiculo_modelo_id')->unsigned();
            $table->BigInteger('vehiculo_matricula_id')->unsigned();
            $table->BigInteger('vehiculo_color_id')->unsigned();


            $table->BigInteger('nombre_servicio_id')->unsigned();
            $table->BigInteger('precio_servicio_id')->unsigned();

            $table->BigInteger('nombre_producto_id')->unsigned();
            $table->BigInteger('cantidad_producto_id')->unsigned();
            $table->BigInteger('precio_producto_id')->unsigned();



            $table->BigInteger('total_comision_id')->unsigned();
            $table->date('fecha_venta');
            $table->decimal('total_venta', 10, 2)->default(0);;

            $table->boolean('desactivado')->default(false); // Por defecto, la venta estará activa

            $table->timestamps();










            $table->foreign('nombre_servicio_id')->references('id')->on('servicios')
                ->onDelete("cascade");
            $table->foreign('precio_servicio_id')->references('id')->on('servicios')
                ->onDelete("cascade");


            $table->foreign('nombre_producto_id')->references('id')->on('productos')
                ->onDelete("cascade");
            $table->foreign('cantidad_producto_id')->references('id')->on('productos')
                ->onDelete("cascade");
            $table->foreign('precio_producto_id')->references('id')->on('productos')
                ->onDelete("cascade");


            $table->foreign('nombre_empleado_id')->references('id')->on('mecanicos')
                ->onDelete("cascade");
            $table->foreign('apellido_empleado_id')->references('id')->on('mecanicos')
                ->onDelete("cascade");
            $table->foreign('especialidad_id')->references('id')->on('mecanicos')
                ->onDelete("cascade");


            $table->foreign('nombre_cliente_id')->references('id')->on('clientes')
                ->onDelete("cascade");
            $table->foreign('apellido_cliente_id')->references('id')->on('clientes')
                ->onDelete("cascade");


            $table->foreign('vehiculo_marca_id')->references('id')->on('vehiculos')
                ->onDelete("cascade");
            $table->foreign('vehiculo_modelo_id')->references('id')->on('vehiculos')
                ->onDelete("cascade");
            $table->foreign('vehiculo_matricula_id')->references('id')->on('vehiculos')
                ->onDelete("cascade");
            $table->foreign('vehiculo_color_id')->references('id')->on('vehiculos')
                ->onDelete("cascade");


            $table->foreign('total_comision_id')->references('id')->on('tareas')
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
