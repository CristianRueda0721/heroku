<?php

namespace App\Http\Controllers;

use App\Exports\ventasExport;
use App\Imports\ventasImport;
use App\Models\Venta;
use App\Models\Tarea;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\Mecanico;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Validators\ValidationException;


/**
 * Class VentaController
 * @package App\Http\Controllers
 */
class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $query = Venta::query();

    // Filtro por nombre de empleado
    if ($request->filled('nombre_empleado_id')) {
        $query->whereHas('mecanico', function ($subquery) use ($request) {
            $subquery->where('nombre', 'like', '%' . $request->nombre_empleado_id . '%');
        });
    }

    // Filtro por fecha de venta
    if ($request->filled('fecha_venta')) {
        $query->whereDate('fecha_venta', $request->fecha_venta);
    }

    // Filtro por matrícula de vehículo
    if ($request->filled('vehiculo_matricula_id')) {
        $query->whereHas('vehiculo', function ($subquery) use ($request) {
            $subquery->where('Vehiculo_matricula', 'like', '%' . $request->vehiculo_matricula_id . '%');
        });
    }

    // Filtrar solo ventas activas
    $query->where('desactivado', false);

    $ventas = $query->paginate();

    return view('venta.index', compact('ventas'))
        ->with('i', ($request->input('page', 1) - 1) * $ventas->perPage());
}

public function desactivar($id)
{
    $venta = Venta::findOrFail($id);
    $venta->desactivar();

    return redirect()->route('venta.index')->with('desactivar', 'ok');
}

public function activar($id)
{
    $venta = Venta::findOrFail($id);
    $venta->activar();

    return redirect()->route('venta.index')->with('activar', 'ok');
}


public function mostrarDesactivadas()
{
    $ventasDesactivadas = Venta::where('desactivado', true)->paginate(20); // Ajusta el número según tus necesidades

    return view('venta.activar', compact('ventasDesactivadas'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

         // Obtener solo los vehículos no desactivados
    $vehiculosActivos = Vehiculo::where('desactivado', false)->pluck('vehiculo_marca', 'id');
    $clientesActivos = Cliente::where('desactivado', false)->pluck('nombre_cliente', 'id');
    $mecanicosActivos = Mecanico::where('desactivado', false)->pluck('nombre', 'id');
    $productosActivos = Producto::where('desactivado', false)->pluck('nombre_producto', 'id');
    $tareasActivos = Tarea::where('desactivado', false)->pluck('total_comision', 'id');

    $venta = new Venta();

        $tarea = new Tarea();
        $servicios = Servicio::where('desactivado', false)->pluck('nombre_servicio', 'id');
        $servicios1 = Servicio::where('desactivado', false)->pluck('precio_servicio', 'id');


        $productos = Producto::where('desactivado', false)->pluck('nombre_producto', 'id');
        $productos1 = Producto::where('desactivado', false)->pluck('cantidad_productos', 'id');
        $productos2 = Producto::where('desactivado', false)->pluck('precio_producto', 'id');


        $mecanicos = Mecanico::where('desactivado', false)->pluck('nombre', 'id');
        $mecanicos1 = Mecanico::where('desactivado', false)->pluck('apellido', 'id');
        $mecanicos2 = Mecanico::where('desactivado', false)->pluck('especialidad', 'id');


        $clientes = Cliente::where('desactivado', false)->pluck('nombre_cliente', 'id');
        $clientes1 = Cliente::where('desactivado', false)->pluck('apellido_cliente', 'id');


        $vehiculos = Vehiculo::where('desactivado', false)->pluck('vehiculo_marca', 'id');
        $vehiculos1 = Vehiculo::where('desactivado', false)->pluck('vehiculo_matricula', 'id');
        $vehiculos2 = Vehiculo::where('desactivado', false)->pluck('vehiculo_modelo', 'id');
        $vehiculos3 = Vehiculo::where('desactivado', false)->pluck('vehiculo_color', 'id');


        $tareas = Tarea::where('desactivado', false)->pluck('total_comision', 'id');

        return view('venta.create', compact('venta','clientes','clientes1','mecanicos','mecanicos1',
        'mecanicos2','productos','productos1','productos2','servicios','servicios1','vehiculos',
        'vehiculos1','vehiculos2','vehiculos3','tareas','vehiculosActivos','clientesActivos','mecanicosActivos','productosActivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Venta::$rules, [
            'nombre_empleado_id.required' => '• Debe seleccionar el nombre del empleado.',

            "apellido_empleado_id.required"  => '• Debe seleccionar el apellido del empleado.',

            "especialidad_id.required"  => '• Debe seleccionar la espacialidad del empleado.',

            "nombre_cliente_id.required"  => '• Debe seleccionar el nombre del cliente.',

            "apellido_cliente_id.required"  => '• Debe seleccionar el apellido del empleado.',

            "vehiculo_marca_id.required"  => '• Debe seleccionar la marca del vehiculo.',

            "vehiculo_modelo_id.required"  => '• Debe seleccionar la modelo del vehiculo.',

            "vehiculo_matricula_id.required"  => '• Debe seleccionar la matricula del vehiculo.',

            "vehiculo_color_id.required"  => '• Debe seleccionar la color del vehiculo.',

            "nombre_servicio_id.required"  => '• Debe seleccionar al menos un servicio.',

            "precio_servicio_id.required"  => '• Debe seleccionar el precio del servicio.',

            "nombre_producto_id.required"  => '• Debe seleccionar al menos un producto.',

            "cantidad_producto_id.required"  => '• Debe seleccionar la cantidad del producto.',

            "precio_producto_id.required"  => '• Debe seleccionar el precio del producto.',

            "total_comision_id.required"  => '• Debe seleccionar la comision del mecanico encargado.',

            "fecha_venta.required"  => '• Debe ingresar una fecha.',

            'fecha_venta.after_or_equal' => '• La fecha es inválida. Por favor, ingrese una fecha válida del presente año 2024 y apartir del mes de marzo.',

            "total_venta.required"  => '• Debe ingresar el total de la venta',
            "total_venta.numeric"  => '• Debe ingresar solo numeros en el total de la venta',
            // Otros mensajes personalizados según tus reglas...
        ]);

        $venta = Venta::create($request->all());

        return redirect()->route('venta.index')
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
        $venta = Venta::find($id);

        return view('venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculosActivos = Vehiculo::where('desactivado', false)->pluck('vehiculo_marca', 'id');
    $clientesActivos = Cliente::where('desactivado', false)->pluck('nombre_cliente', 'id');
    $mecanicosActivos = Mecanico::where('desactivado', false)->pluck('nombre', 'id');
    $productosActivos = Producto::where('desactivado', false)->pluck('nombre_producto', 'id');
    $tareasActivos = Tarea::where('desactivado', false)->pluck('total_comision', 'id');

    $venta = Venta::find($id);

        $tarea = new Tarea();
        $servicios = Servicio::where('desactivado', false)->pluck('nombre_servicio', 'id');
        $servicios1 = Servicio::where('desactivado', false)->pluck('precio_servicio', 'id');


        $productos = Producto::where('desactivado', false)->pluck('nombre_producto', 'id');
        $productos1 = Producto::where('desactivado', false)->pluck('cantidad_productos', 'id');
        $productos2 = Producto::where('desactivado', false)->pluck('precio_producto', 'id');


        $mecanicos = Mecanico::where('desactivado', false)->pluck('nombre', 'id');
        $mecanicos1 = Mecanico::where('desactivado', false)->pluck('apellido', 'id');
        $mecanicos2 = Mecanico::where('desactivado', false)->pluck('especialidad', 'id');


        $clientes = Cliente::where('desactivado', false)->pluck('nombre_cliente', 'id');
        $clientes1 = Cliente::where('desactivado', false)->pluck('apellido_cliente', 'id');


        $vehiculos = Vehiculo::where('desactivado', false)->pluck('vehiculo_marca', 'id');
        $vehiculos1 = Vehiculo::where('desactivado', false)->pluck('vehiculo_matricula', 'id');
        $vehiculos2 = Vehiculo::where('desactivado', false)->pluck('vehiculo_modelo', 'id');
        $vehiculos3 = Vehiculo::where('desactivado', false)->pluck('vehiculo_color', 'id');


        $tareas = Tarea::where('desactivado', false)->pluck('total_comision', 'id');

        return view('venta.edit', compact('venta','clientes','clientes1','mecanicos','mecanicos1',
        'mecanicos2','productos','productos1','productos2','servicios','servicios1','vehiculos',
        'vehiculos1','vehiculos2','vehiculos3','tareas','vehiculosActivos','clientesActivos','mecanicosActivos','productosActivos'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        $request->validate(Venta::$rules, [
            'nombre_empleado_id.required' => '• Debe seleccionar el nombre del empleado.',
            "apellido_empleado_id.required"  => '• Debe seleccionar el apellido del empleado.',
            "especialidad_id.required"  => '• Debe seleccionar la espacialidad del empleado.',
            "nombre_cliente_id.required"  => '• Debe seleccionar el nombre del cliente.',
            "apellido_cliente_id.required"  => '• Debe seleccionar el apellido del empleado.',
            "vehiculo_marca_id.required"  => '• Debe seleccionar la marca del vehiculo.',
            "vehiculo_modelo_id.required"  => '• Debe seleccionar la modelo del vehiculo.',
            "vehiculo_matricula_id.required"  => '• Debe seleccionar la matricula del vehiculo.',
            "vehiculo_color_id.required"  => '• Debe seleccionar la color del vehiculo.',
            "nombre_servicio_id.required"  => '• Debe seleccionar al menos un servicio.',
            "precio_servicio_id.required"  => '• Debe seleccionar el precio del servicio.',
            "nombre_producto_id.required"  => '• Debe seleccionar al menos un producto.',
            "cantidad_producto_id.required"  => '• Debe seleccionar la cantidad del producto.',
            "precio_producto_id.required"  => '• Debe seleccionar el precio del producto.',
            "total_comision_id.required"  => '• Debe seleccionar la comision del mecanico encargado.',
            "fecha_venta.required"  => '• Debe ingresar una fecha.',
            'fecha_venta.after_or_equal' => '• La fecha es inválida. Por favor, ingrese una fecha válida del presente año 2024 y apartir del mes de marzo.',
            "total_venta.required"  => '• Debe ingresar el total de la venta',
            "total_venta.numeric"  => '• Debe ingresar solo numeros en el total de la venta',
            // Otros mensajes personalizados según tus reglas...
        ]);

        $venta->update($request->all());

        return redirect()->route('venta.index')
            ->with('editar', 'ok');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $venta = Venta::find($id)->delete();

        return redirect()->route('ventas.index')
            ->with('success', 'Venta deleted successfully');
    }

    public function import(Request $request)
{
    // Importación
    $request->validate([
        'documento_csv' => 'required|mimes:csv,text|max:4000',
    ]);

    try {
        $file = $request->file('documento_csv');
        $import = new ventasImport;
        Excel::import($import, $file);

        // Obtén la cantidad de registros importados
        $count = $import->getRowCount();

        // Éxito
        return back()->with(['success' => "Reporte Excel importado exitosamente. Registros importados: $count"]);
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        // Error de validación
        $failures = $e->failures();

        $errorMessage = 'Error en la validación del archivo Excel. Detalles:';
        foreach ($failures as $failure) {
            $errorMessage .= " Fila {$failure->row()}: " . implode(', ', $failure->errors()) . ';';
        }

        return back()->with(['danger' => $errorMessage])->withErrors($failures);
    } catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $e) {
        // Otros errores específicos
        return back()->with(['danger' => 'No se pudo detectar el tipo del archivo Excel.']);
    } catch (\Exception $e) {
        // Otros errores generales
        Log::error('Error al importar el archivo Excel: ' . $e->getMessage());
        return back()->with(['danger' => 'Error al importar el archivo Excel. Detalles en el registro de errores.']);
    }
}




    public function export(Request $request)
    {
        return Excel::download(new ventasExport, 'ventas.csv');
    }

    public function pdf()
    {
        // Obtener solo los clientes no desactivados
        $ventas = Venta::where('desactivado', false)->get();

        $pdf = Pdf::loadView('venta.pdf', compact('ventas'));
        return $pdf->setPaper('a4', 'landscape')->stream('Reporte_ventas.pdf');

    }




}

