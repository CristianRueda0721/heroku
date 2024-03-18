<?php

namespace App\Http\Controllers;

use App\Exports\productosExport;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $query = Producto::query();

        // Filtro por nombre de cliente
        if ($request->filled('nombre_producto')) {
            $query->where('nombre_producto', 'like', '%' . $request->nombre_producto . '%');
        }

        // Filtro por matrícula de vehículo
        if ($request->filled('telefono')) {
            $query->where('telefono', 'like', '%' . $request->telefono . '%');
        }

        $query->where('desactivado', false);
        $productos = $query->paginate();

        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    public function desactivar($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->desactivar();

        return redirect()->route('productos.index')->with('desactivar', 'ok');
    }

    public function activar($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->activar();

        return redirect()->route('productos.index')->with('activar', 'ok');
    }


    public function mostrarDesactivadas()
    {
        $productosDesactivadas = Producto::where('desactivado', true)->paginate(20); // Ajusta el número según tus necesidades

        return view('producto.activar', compact('productosDesactivadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();
        return view('producto.create', compact('producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Producto::$rules, [


            "nombre_producto.required"  => '• Debe ingresar el nombre del producto.',
            "nombre_producto.regex"  => '• El campo no debe tener numeros ni sombolos solo letras.',
            "nombre_producto.max"  => '• El maximo de caraceteres son 10.',

            "cantidad_productos.required"  => '• Debe ingresar la catidad de productos.',
            "cantidad_productos.numeric"  => '• El campo no puede tener simbolos como letras, solo numeros.',
            "cantidad_productos.max"  => '• El maximo de caraceteres son 999999.',

            "precio_producto.required"  => '• Debe ingresar el precio del producto.',
            "precio_producto.numeric"  => '• El campo no puede tener simbolos como letras, solo numeros.',
            "precio_producto.max"  => '• El maximo de caracteres son 99999.',






        ]);

        $precio_producto = $request->precio_producto;
        $precio_producto = str_replace('.', '', $precio_producto); // para eliminar el punto
        $precio_producto = str_replace(',', '.', $precio_producto); // para cambiar la coma por el punto

        $producto = new Producto();
        $producto->nombre_producto = $request->nombre_producto;
        $producto->cantidad_productos = $request->cantidad_productos;
        $producto->precio_producto = $precio_producto;

        $producto->save();


        return redirect()->route('productos.index')
            ->with('agregar', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);

        return view('producto.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate(Producto::$rules, [


            "nombre_producto.required"  => '• Debe ingresar el nombre del producto.',
            "nombre_producto.regex"  => '• El campo no debe tener numeros ni sombolos solo letras.',
            "nombre_producto.max"  => '• El maximo de caraceteres son 10.',

            "cantidad_productos.required"  => '• Debe ingresar la catidad de productos.',
            "cantidad_productos.numeric"  => '• El campo no puede tener simbolos como letras, solo numeros.',
            "cantidad_productos.max"  => '• El maximo de caraceteres son 999999.',

            "precio_producto.required"  => '• Debe ingresar el precio del producto.',
            "precio_producto.regex"  => '• El campo no puede tener simbolos como letras, solo numeros.',
            "precio_producto.max"  => '• El maximo de caracteres son 99999.',




        ]);

        $precio_producto = $request->precio_producto;
        $precio_producto = str_replace('.', '', $precio_producto);
        $precio_producto = str_replace(',', '.', $precio_producto);


        $producto->update([
            'nombre_producto' => $request->nombre_producto,
            'cantidad_productos' => $request->cantidad_productos,
            'precio_producto' => $precio_producto,
        ]);



        return redirect()->route('productos.index')
            ->with('editar', 'ok');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto deleted successfully');
    }

    public function import(Request $request)
    {
        dd('TODO');
    }




    public function export()
    {
        return Excel::download(new productosExport, 'Productos.csv');
    }

    public function pdf()
    {
        // Obtener solo los clientes no desactivados
        $productos = Producto::where('desactivado', false)->get();

        $pdf = Pdf::loadView('producto.pdf', compact('productos'));
        return $pdf->setPaper('a4', 'landscape')->stream('Reporte_productos.pdf');
    }
}
