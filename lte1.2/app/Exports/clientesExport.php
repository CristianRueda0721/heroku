<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Obtener solo los clientes no desactivados
        $clientes = Cliente::where('desactivado', false)->get();

        // Iterar sobre cada cliente y convertir IDs a valores
        $clientes->transform(function ($cliente) {
            $cliente->vehiculo_marca_id = optional($cliente->vehiculo)->vehiculo_marca;
            $cliente->vehiculo_modelo_id = optional($cliente->vehiculo)->vehiculo_modelo;
            $cliente->vehiculo_matricula_id = optional($cliente->vehiculo)->Vehiculo_matricula;
            $cliente->vehiculo_color_id = optional($cliente->vehiculo)->Vehiculo_color;
            // Puedes ajustar esto según tus relaciones y cómo están configurados tus modelos
    
            return $cliente->only([
                'cedula_cliente', 'nombre_cliente', 'apellido_cliente',
                'direccion', 'telefono', 'email', 'ciudad',
                'vehiculo_marca_id', 'vehiculo_modelo_id', 'vehiculo_matricula_id', 'vehiculo_color_id',
            ]);
        });
    
        return $clientes;
    }

    public function headings(): array
    {
        return [
            'cedula_cliente', 'nombre_cliente', 'apellido_cliente',
            'direccion', 'telefono', 'email', 'ciudad',
            'vehiculo_marca_id', 'vehiculo_modelo_id', 'vehiculo_matricula_id', 'vehiculo_color_id',
        ];
    }
}

