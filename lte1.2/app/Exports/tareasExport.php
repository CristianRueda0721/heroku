<?php

namespace App\Exports;

use App\Models\Tarea;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TareasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        $tareas = Tarea::where('desactivado', false)->get();
    
        // Iterar sobre cada tarea y convertir IDs a valores
        $tareas->transform(function ($tarea) {
            $tarea->nombre_servicio_id = optional($tarea->servicio)->nombre_servicio;
            $tarea->precio_producto_id = optional($tarea->producto)->precio_producto;
            $tarea->nombre_producto_id = optional($tarea->producto)->nombre_producto;
            $tarea->cantidad_producto_id = optional($tarea->producto)->cantidad_productos;
            $tarea->nombre_empleado_id = optional($tarea->mecanico)->nombre;
            $tarea->apellido_empleado_id = optional($tarea->mecanico)->apellido;
            $tarea->especialidad_id = optional($tarea->mecanico)->especialidad;
            $tarea->nombre_cliente_id = optional($tarea->cliente)->nombre_cliente;
            $tarea->apellido_cliente_id = optional($tarea->cliente)->apellido_cliente;
            $tarea->vehiculo_marca_id = optional($tarea->vehiculo)->vehiculo_marca;
            $tarea->vehiculo_modelo_id = optional($tarea->vehiculo)->vehiculo_modelo;
            $tarea->vehiculo_matricula_id = optional($tarea->vehiculo)->Vehiculo_matricula;
            $tarea->vehiculo_color_id = optional($tarea->vehiculo)->Vehiculo_color;
            $tarea->precio_servicio_id = optional($tarea->servicio)->precio_servicio;
           
            
            
            // Puedes ajustar esto según tus relaciones y cómo están configurados tus modelos
    
            return $tarea->only([
                'nombre_servicio_id', 'precio_servicio_id',
                'nombre_producto_id', 'cantidad_producto_id', 'precio_producto_id',
                'nombre_empleado_id', 'apellido_empleado_id', 'especialidad_id',
                'estatus', 'disponibilidad', 'Comision',
                'nombre_cliente_id', 'apellido_cliente_id',
                'vehiculo_marca_id', 'vehiculo_modelo_id', 'vehiculo_matricula_id', 'vehiculo_color_id',
                'total_reparacion', 'total_comision', 'comentarios',
                
                
               
            ]);
        });
    
        return $tareas;
    }

    public function headings(): array
    {
        return [
            'nombre_servicio_id', 'precio_servicio_id',
            'nombre_producto_id', 'cantidad_producto_id', 'precio_producto_id',
            'nombre_empleado_id', 'apellido_empleado_id', 'especialidad_id',
            'estatus', 'disponibilidad', 'Comision',
            'nombre_cliente_id', 'apellido_cliente_id',
            'vehiculo_marca_id', 'vehiculo_modelo_id', 'vehiculo_matricula_id', 'vehiculo_color_id',
            'total_reparacion', 'total_comision', 'comentarios',
        ];
    }
}
