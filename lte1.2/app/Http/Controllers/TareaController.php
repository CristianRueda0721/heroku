<?php

namespace App\Http\Controllers;

use App\Exports\tareasExport;
use App\Models\Tarea;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\Mecanico;
use App\Models\Producto;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class TareaController
 * @package App\Http\Controllers
 */
class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
{
    $query = Tarea::query();

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

    if ($request->filled('vehiculo_matricula_id')) {
        $query->whereHas('vehiculo', function ($subquery) use ($request) {
            $subquery->where('Vehiculo_matricula', 'like', '%' . $request->vehiculo_matricula_id . '%');
        });
    }

      // Filtrar solo ventas activas
      $query->where('desactivado', false);

    $tareas = $query->paginate();


    return view('tarea.index', compact('tareas'))
        ->with('i', (request()->input('page', 1) - 1) * $tareas->perPage());
}

public function desactivar($id)
{
    $tarea = Tarea::findOrFail($id);
    $tarea->desactivar();

    return redirect()->route('tarea.index')->with('desactivar', 'ok');
}

public function activar($id)
{
    $tarea = Tarea::findOrFail($id);
    $tarea->activar();

    return redirect()->route('tarea.index')->with('activar', 'ok');
}


public function mostrarDesactivadas()
{
    $tareasDesactivadas = Tarea::where('desactivado', true)->paginate(20); // Ajusta el número según tus necesidades

    return view('tarea.activar', compact('tareasDesactivadas'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         // Obtener solo los vehículos no desactivados
    $vehiculosActivos = Vehiculo::where('desactivado', false)->pluck('vehiculo_marca', 'id');
    $clientesActivos = Cliente::where('desactivado', false)->pluck('nombre_cliente', 'id');
    $mecanicosActivos = Mecanico::where('desactivado', false)->pluck('nombre', 'id');
    $productosActivos = Producto::where('desactivado', false)->pluck('nombre_producto', 'id');


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

        return view('tarea.create', compact('tarea','clientes','clientes1','mecanicos','mecanicos1',
        'mecanicos2','productos','productos1','productos2','servicios','servicios1','vehiculos','vehiculos1',
        'vehiculos2','vehiculos3','vehiculosActivos','clientesActivos','mecanicosActivos','productosActivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Tarea::$rules, [
            "nombre_servicio_id.required"  => '• Debe seleccionar al menos un servicio.',

            "precio_servicio_id.required"  => '• Debe seleccionar el precio del servicio.',

            "nombre_producto_id.required"  => '• Debe seleccionar al menos un producto.',

            "cantidad_producto_id.required"  => '• Debe seleccionar la cantidad del producto.',

            "precio_producto_id.required"  => '• Debe seleccionar el precio del producto.',

            'nombre_empleado_id.required' => '• Debe seleccionar el nombre del empleado.',

            "apellido_empleado_id.required"  => '• Debe seleccionar el apellido del empleado.',

            "especialidad_id.required"  => '• Debe seleccionar la espacialidad del empleado.',

            "estatus.required"  => '• Debe ingresar el estatus del empleado.',
            "estatus.regex"  => '• El campo no puede contener numeros ni simbolos. solo letras.',
            "estatus.max"  => '• El numero maximo de caracteres son 10.',

            "disponibilidad.required"  => '• Debe ingresar la disponibilidad del empleado.',
            "disponibilidad.max"  => '• El numero maximo de caracteres son 15.',
            "disponibilidad.regex"  => '• El campo no puede contener numeros ni simbolos. solo letras.',

            "Comision.required"  => '• Debe ingresar la comision del empleado.',
            "Comision.between"  => '• El numero maximo de comision es entre 1-100.',
            "Comision.numeric"  => '• El campo no puede contener letras ni simbolos. solo numeros.',

            "nombre_cliente_id.required"  => '• Debe seleccionar el nombre del cliente.',

            "apellido_cliente_id.required"  => '• Debe seleccionar el apellido del empleado.',

            "vehiculo_marca_id.required"  => '• Debe seleccionar la marca del vehiculo.',

            "vehiculo_modelo_id.required"  => '• Debe seleccionar la modelo del vehiculo.',

            "vehiculo_matricula_id.required"  => '• Debe seleccionar la matricula del vehiculo.',

            "vehiculo_color_id.required"  => '• Debe seleccionar la color del vehiculo.',

            "total_reparacion.required"  => '• Debe ingresar el costo de la repacion total.',
            "total_reparacion.numeric"  => '• El campo no puede tener ni simbolos ni letras. solo numeros.',
            "total_reparacion.max"  => '• Debe ingresar el costo de la repacion total.',

            "total_comision.required"  => '• Debe ingresar la comision total del empleado.',
            "total_comision.between"  => '• El numero maximo de comision es entre 1-100.',
            "total_comision.numeric"  => '• El campo no puede contener letras ni simbolos. solo numeros.',

            "comentarios.required"  => '• Debe ingresar un comentario',
        ]);

        $tarea = Tarea::create($request->all());

        return redirect()->route('tarea.index')
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
        $tarea = Tarea::find($id);

        return view('tarea.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // Obtener solo los vehículos no desactivados
     $vehiculosActivos = Vehiculo::where('desactivado', false)->pluck('vehiculo_marca', 'id');
     $clientesActivos = Cliente::where('desactivado', false)->pluck('nombre_cliente', 'id');
     $mecanicosActivos = Mecanico::where('desactivado', false)->pluck('nombre', 'id');
     $productosActivos = Producto::where('desactivado', false)->pluck('nombre_producto', 'id');


        $tarea = Tarea::find($id);
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

         return view('tarea.edit', compact('tarea','clientes','clientes1','mecanicos','mecanicos1',
        'mecanicos2','productos','productos1','productos2','servicios','servicios1','vehiculos','vehiculos1',
        'vehiculos2','vehiculos3','vehiculosActivos','clientesActivos','mecanicosActivos','productosActivos'));
     }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tarea $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        $request->validate(Tarea::$rules, [
            "nombre_servicio_id.required"  => '• Debe seleccionar al menos un servicio.',

            "precio_servicio_id.required"  => '• Debe seleccionar el precio del servicio.',

            "nombre_producto_id.required"  => '• Debe seleccionar al menos un producto.',

            "cantidad_producto_id.required"  => '• Debe seleccionar la cantidad del producto.',

            "precio_producto_id.required"  => '• Debe seleccionar el precio del producto.',

            'nombre_empleado_id.required' => '• Debe seleccionar el nombre del empleado.',

            "apellido_empleado_id.required"  => '• Debe seleccionar el apellido del empleado.',

            "especialidad_id.required"  => '• Debe seleccionar la espacialidad del empleado.',

            "estatus.required"  => '• Debe ingresar el estatus del empleado.',
            "estatus.regex"  => '• El campo no puede contener numeros ni simbolos. solo letras.',
            "estatus.max"  => '• El numero maximo de caracteres son 10.',

            "disponibilidad.required"  => '• Debe ingresar la disponibilidad del empleado.',
            "disponibilidad.max"  => '• El numero maximo de caracteres son 15.',
            "disponibilidad.regex"  => '• El campo no puede contener numeros ni simbolos. solo letras.',

            "Comision.required"  => '• Debe ingresar la comision del empleado.',
            "Comision.between"  => '• El numero maximo de comision es entre 1-100.',
            "Comision.regex"  => '• El campo no puede contener letras ni simbolos. solo numeros y el simbolo "%".',

            "nombre_cliente_id.required"  => '• Debe seleccionar el nombre del cliente.',

            "apellido_cliente_id.required"  => '• Debe seleccionar el apellido del empleado.',

            "vehiculo_marca_id.required"  => '• Debe seleccionar la marca del vehiculo.',

            "vehiculo_modelo_id.required"  => '• Debe seleccionar la modelo del vehiculo.',

            "vehiculo_matricula_id.required"  => '• Debe seleccionar la matricula del vehiculo.',

            "vehiculo_color_id.required"  => '• Debe seleccionar la color del vehiculo.',

            "total_reparacion.required"  => '• Debe ingresar el costo de la repacion total.',
            "total_reparacion.numeric"  => '• El campo no puede tener ni simbolos ni letras. solo numeros.',
            "total_reparacion.max"  => '• Debe ingresar el costo de la repacion total.',

            "total_comision.required"  => '• Debe ingresar la comision total del empleado.',
            "total_comision.between"  => '• El numero maximo de comision es entre 1-100.',
            "total_comision.numeric"  => '• El campo no puede contener letras ni simbolos. solo numeros.',

            "comentarios.required"  => '• Debe ingresar un comentario',
        ]);

        $tarea->update($request->all());

        return redirect()->route('tarea.index')
        ->with('editar', 'ok');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tarea = Tarea::find($id)->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea deleted successfully');
    }

    public function import(Request $request)
    {
       dd('TODO');
    }




        public function export()
        {
            return Excel::download(new tareasExport, 'tarea.csv');
        }

        public function pdf()
        {
            $tareas = Tarea::where('desactivado', false)->get();

            $pdf = Pdf::loadView('tarea.pdf', compact('tareas'));
            return $pdf->setPaper('a4', 'landscape')->stream('Reporte_tareas.pdf');

        }

}
