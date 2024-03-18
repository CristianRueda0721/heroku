<?php

namespace App\Exports;

use App\Models\Mecanico;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MecanicosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
        // Obtener solo los clientes no desactivados
        $mecanicos = Mecanico::where('desactivado', false)->get();
        
    
        // Iterar sobre cada mecánico y convertir IDs a valores
        $mecanicos->transform(function ($mecanico) {
            // Puedes ajustar esto según tus relaciones y cómo están configurados tus modelos
    
            return $mecanico->only([
                'cedula', 'nombre', 'apellido', 'direccion', 'telefono', 'email', 'ciudad', 'especialidad',
            ]);
        });
    
        return $mecanicos;
    }

    public function headings(): array
    {
        return [
            'cedula', 'nombre', 'apellido', 'direccion', 'telefono', 'email', 'ciudad', 'especialidad',
        ];
    }
}
