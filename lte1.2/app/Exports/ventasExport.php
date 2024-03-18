<?php

namespace App\Exports;

use App\Models\Venta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
        // Obtener solo los clientes no desactivados
        $ventas = Venta::where('desactivado', false)->get();
    
        // Iterar sobre cada venta y convertir IDs a valores
        $ventas->transform(function ($venta) {
            $venta->nombre_empleado_id = optional($venta->mecanico)->nombre;
            $venta->apellido_empleado_id = optional($venta->mecanico)->apellido;
            $venta->especialidad_id = optional($venta->mecanico)->especialidad;
            $venta->nombre_cliente_id = optional($venta->cliente)->nombre_cliente;
            $venta->apellido_cliente_id = optional($venta->cliente)->apellido_cliente;
            $venta->vehiculo_marca_id = optional($venta->vehiculo)->vehiculo_marca;
            $venta->vehiculo_modelo_id = optional($venta->vehiculo)->vehiculo_modelo;
            $venta->vehiculo_matricula_id = optional($venta->vehiculo)->Vehiculo_matricula;
            $venta->vehiculo_color_id = optional($venta->vehiculo)->Vehiculo_color;
            $venta->nombre_servicio_id = optional($venta->servicio)->nombre_servicio;
            $venta->precio_servicio_id = optional($venta->servicio)->precio_servicio;
            $venta->nombre_producto_id = optional($venta->producto)->nombre_producto;
            $venta->cantidad_producto_id = optional($venta->producto)->cantidad_productos;
            $venta->precio_producto_id = optional($venta->producto)->precio_producto;
            $venta->total_comision_id = optional($venta->tarea)->total_comision;
    
            return $venta->only([
                'nombre_empleado_id', 'apellido_empleado_id', 'especialidad_id',
                'nombre_cliente_id', 'apellido_cliente_id',
                'vehiculo_marca_id', 'vehiculo_modelo_id', 'vehiculo_matricula_id', 'vehiculo_color_id',
                'nombre_servicio_id', 'precio_servicio_id',
                'nombre_producto_id', 'cantidad_producto_id', 'precio_producto_id',
                'total_comision_id',
                'fecha_venta', 'total_venta',
            ]);
        });
    
        return $ventas;
    }

    public function headings(): array
    {
        return [
            'nombre_empleado_id', 'apellido_empleado_id', 'especialidad_id',
            'nombre_cliente_id', 'apellido_cliente_id',
            'vehiculo_marca_id', 'vehiculo_modelo_id', 'vehiculo_matricula_id', 'vehiculo_color_id',
            'nombre_servicio_id', 'precio_servicio_id',
            'nombre_producto_id', 'cantidad_producto_id', 'precio_producto_id',
            'total_comision_id',
            'fecha_venta', 'total_venta',
        ];
    }
}

