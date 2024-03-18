<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
         // Obtener solo los clientes no desactivados
         $productos = Producto::where('desactivado', false)->get();
    
        // Iterar sobre cada producto y convertir IDs a valores
        $productos->transform(function ($producto) {
            // Puedes ajustar esto según tus relaciones y cómo están configurados tus modelos
    
            return $producto->only([
                'nombre_producto', 'cantidad_productos', 'precio_producto',
            ]);
        });
    
        return $productos;
    }

    public function headings(): array
    {
        return [
            'nombre_producto', 'cantidad_productos', 'precio_producto',
        ];
    }
}
