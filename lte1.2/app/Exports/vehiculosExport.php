<?php

namespace App\Exports;

use App\Models\Vehiculo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehiculosExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retornar solo vehículos no desactivados
        return Vehiculo::where('desactivado', false)->get(['vehiculo_marca', 'vehiculo_modelo', 'Vehiculo_matricula', 'Vehiculo_color']);
    }

    public function headings(): array
    {
        // Encabezados de las columnas en el archivo CSV
        return [
            'vehiculo_marca', 'vehiculo_modelo', 'Vehiculo_matricula', 'Vehiculo_color',
        ];
    }
}
