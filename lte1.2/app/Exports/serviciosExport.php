<?php

namespace App\Exports;

use App\Models\Servicio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiciosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        // Obtener solo los clientes no desactivados
        $servicios = Servicio::where('desactivado', false)->get();
    
        // Iterar sobre cada servicio y convertir IDs a valores
        $servicios->transform(function ($servicio) {
            // Puedes ajustar esto según tus relaciones y cómo están configurados tus modelos
    
            return $servicio->only([
                'nombre_servicio', 'precio_servicio',
            ]);
        });
    
        return $servicios;
    }

    public function headings(): array
    {
        return [
            'nombre_servicio', 'precio_servicio',
        ];
    }
}
