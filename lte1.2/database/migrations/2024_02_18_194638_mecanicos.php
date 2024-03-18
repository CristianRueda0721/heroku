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
        Schema::create('mecanicos', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->integer('cedula')->length(10)->unsigned();
            $table->string('nombre',45);
            $table->string('apellido',45);
            $table->string('direccion',45);
            $table->integer('telefono')->length(45)->unsigned();
            $table->string('email',45);
            $table->string('ciudad',45);
            $table->string('especialidad',45);
            $table->boolean('desactivado')->default(false); // Por defecto, la venta estará activa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mecanicos');
    }
};
