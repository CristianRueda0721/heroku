<?php

namespace App\Imports;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Mecanico;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VentasImport implements ToModel, WithHeadingRow
{
    protected $rowCount = 0;

    public function model(array $row)
    {
        $this->rowCount++;

        // Obtén las instancias relacionadas
        $cliente = Cliente::firstOrCreate(['nombre_cliente' => $row['nombre_cliente']]);
        $mecanico = Mecanico::firstOrCreate(['nombre_empleado' => $row['nombre_empleado']]);
        $vehiculo = Vehiculo::firstOrCreate(['vehiculo_matricula' => $row['vehiculo_matricula']]);
        $producto = Producto::firstOrCreate(['nombre_producto' => $row['nombre_producto']]);
        $servicio = Servicio::firstOrCreate(['nombre_servicio' => $row['nombre_servicio']]);
        // Puedes ajustar esto según tus relaciones y cómo están configurados tus modelos

        // Resto de la lógica para crear el modelo
        return new Venta([
            "nombre_empleado_id" => $mecanico->id,
            "apellido_empleado_id" => $row["apellido_empleado_id"],
            "especialidad_id" => $row["especialidad_id"],
            "nombre_cliente_id" => $cliente->id,
            "apellido_cliente_id" => $row["apellido_cliente_id"],
            "vehiculo_marca_id" => $row["vehiculo_marca_id"],
            "vehiculo_modelo_id" => $row["vehiculo_modelo_id"],
            "vehiculo_matricula_id" => $vehiculo->id,
            "vehiculo_color_id" => $row["vehiculo_color_id"],
            "nombre_servicio_id" => $servicio->id,
            "precio_servicio_id" => $row["precio_servicio_id"],
            "nombre_producto_id" => $producto->id,
            "cantidad_producto_id" => $row["cantidad_producto_id"],
            "precio_producto_id" => $row["precio_producto_id"],
            "total_comision_id" => $row["total_comision_id"],
            "fecha_venta" => $row["fecha_venta"],
            "total_venta" => $row["total_venta"],
        ]);
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }
}
