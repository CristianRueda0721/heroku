<?php

namespace App\Http\Controllers;

use App\Exports\clientesExport;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
        $query = Cliente::query();


        if ($request->filled('nombre_cliente')) {
            $query->where('nombre_cliente', 'like', '%' . $request->nombre_cliente . '%');
        }


        if ($request->filled('cedula_cliente')) {
            $query->where('cedula_cliente', 'like', '%' . $request->cedula_cliente . '%');
        }

        $query->where('desactivado', false);
        $clientes = $query->paginate();

        return view('cliente.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }


    public function desactivar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->desactivar();

        return redirect()->route('clientes.index')->with('desactivar', 'ok');
    }

    public function activar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->activar();

        return redirect()->route('clientes.index')->with('activar', 'ok');
    }


    public function mostrarDesactivadas()
    {
        $clientesDesactivadas = Cliente::where('desactivado', true)->paginate(20); // Ajusta el número según tus necesidades

        return view('cliente.activar', compact('clientesDesactivadas'));
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

        // Otros datos necesarios para el formulario
        $cliente = new Cliente();
        $vehiculos = Vehiculo::where('desactivado', false)->pluck('vehiculo_marca', 'id');
        $vehiculos1 = Vehiculo::where('desactivado', false)->pluck('vehiculo_matricula', 'id');
        $vehiculos2 = Vehiculo::where('desactivado', false)->pluck('vehiculo_modelo', 'id');
        $vehiculos3 = Vehiculo::where('desactivado', false)->pluck('vehiculo_color', 'id');


        // Pasar los datos a la vista
        return view('cliente.create', compact('cliente', 'vehiculos', 'vehiculos1', 'vehiculos2', 'vehiculos3', 'vehiculosActivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Cliente::$rules, [
            'cedula_cliente.required' => '• Debe ingresar la cedula del cliente.',
            'cedula_cliente.numeric' => '• El campo no debe tener símbolos ni letras, solo números.',
            'cedula_cliente.digits' => '• El campo debe tener 10 digitos por lo menos.',

            'nombre_cliente.required' => '• Debe ingresar el nombre del cliente.',
            "nombre_cliente.regex" => '• El campo no debe tener numeros ni caracteres especiales, solo letras.',
            "nombre_cliente.max" => '• El nombre no debe pasar de 20 caracteres.',


            'apellido_cliente.required' => '• Debe ingresar el apellido del cliente.',
            "apellido_cliente.regex" => '• El campo no debe tener numeros ni caracteres especiales, solo letras.',
            "apellido_cliente.max" => '• El apellido no debe pasar de 20 caracteres.',


            "direccion.required"  => '• Debe ingrear una direccion.',
            "direccion.max"  => '• El campo no debe superar los 30 caracteres.',
            "direccion.regex" => '• El campo solo acepta símbolos como: # y -.',

            "telefono.required"  => '• Debe ingresar el telefono del cliente.',
            "telefono.numeric"  => '• El campo no debe tener simbolos ni letras, solo numeros.',
            "telefono.digits"  => '• El campo debe tener 10 digitos por lo menos',


            "email.required"  => '• Debe ingresar el correo del cliente.',
            "email.email"  => '• El correo debe tener un "@" y lo siguiente al "@".',
            "email.max"  => '• El correo no debe pasar lo 30 caracteres.',
            "email.regex"  => '• El correo debe tener el ".com".',


            "ciudad.required"  => '• Debe Ingresar la cuidad del cliente.',
            "ciudad.alpha"  => '• El campo no debe tener numeros ni simbolos solo letras.',
            "ciudad.max"  => '• La cuidad no debe pasar los 10 caracteres.',



            "vehiculo_marca_id.required"  => '• Debe seleccionar la marca del vehiculo.',
            "vehiculo_modelo_id.required"  => '• Debe seleccionar el modelo del vehiculo.',
            "vehiculo_matricula_id.required"  => '• Debe seleccionar la matricula del vehiculo.',
            "vehiculo_color_id.required"  => '• Debe seleccionar el color del vehiculo.',

        ]);

        $cliente = Cliente::create($request->all());
        $query = Vehiculo::query();

        $query->where('desactivado', false);

        return redirect()->route('clientes.index')
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
        $cliente = Cliente::find($id);

        return view('cliente.show', compact('cliente'));
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

        // Otros datos necesarios para el formulario
        $cliente = Cliente::find($id);
        $vehiculos = Vehiculo::where('desactivado', false)->pluck('vehiculo_marca', 'id');
        $vehiculos1 = Vehiculo::where('desactivado', false)->pluck('vehiculo_matricula', 'id');
        $vehiculos2 = Vehiculo::where('desactivado', false)->pluck('vehiculo_modelo', 'id');
        $vehiculos3 = Vehiculo::where('desactivado', false)->pluck('vehiculo_color', 'id');

        // Pasar los datos a la vista
        return view('cliente.edit', compact('cliente', 'vehiculos', 'vehiculos1', 'vehiculos2', 'vehiculos3', 'vehiculosActivos'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate(Cliente::$rules, [
            'cedula_cliente.required' => '• Debe ingresar la cedula del cliente.',
            'cedula_cliente.numeric' => '• El campo no debe tener símbolos ni letras, solo números.',
            'cedula_cliente.digits' => '• El campo debe tener 10 digitos por lo menos.',

            'nombre_cliente.required' => '• Debe ingresar el nombre del cliente.',
            "nombre_cliente.regex" => '• El campo no debe tener numeros ni caracteres especiales, solo letras.',
            "nombre_cliente.max" => '• El nombre no debe pasar de 20 caracteres.',


            'apellido_cliente.required' => '• Debe ingresar el apellido del cliente.',
            "apellido_cliente.regex" => '• El campo no debe tener numeros ni caracteres especiales, solo letras.',
            "apellido_cliente.max" => '• El apellido no debe pasar de 20 caracteres.',


            "direccion.required"  => '• Debe ingrear una direccion.',
            "direccion.max"  => '• El campo no debe superar los 30 caracteres.',
            "direccion.regex" => '• El campo solo acepta símbolos como: # y -.',

            "telefono.required"  => '• Debe ingresar el telefono del cliente.',
            "telefono.numeric"  => '• El campo no debe tener simbolos ni letras, solo numeros.',
            "telefono.digits"  => '• El campo debe tener 10 digitos por lo menos',


            "email.required"  => '• Debe ingresar el correo del cliente.',
            "email.email"  => '• El correo debe tener un "@" y lo siguiente al "@".',
            "email.max"  => '• El correo no debe pasar lo 30 caracteres.',
            "email.regex"  => '• El correo debe tener el ".com".',


            "ciudad.required"  => '• Debe Ingresar la cuidad del cliente.',
            "ciudad.alpha"  => '• El campo no debe tener numeros ni simbolos solo letras.',
            "ciudad.max"  => '• La cuidad no debe pasar los 10 caracteres.',

            "vehiculo_marca_id.required"  => '• Debe seleccionar la marca del vehiculo.',
            "vehiculo_modelo_id.required"  => '• Debe seleccionar el modelo del vehiculo.',
            "vehiculo_matricula_id.required"  => '• Debe seleccionar la matricula del vehiculo.',
            "vehiculo_color_id.required"  => '• Debe seleccionar el color del vehiculo.',

        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('editar', 'ok');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id)->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deleted successfully');
    }

    public function import(Request $request)
    {
        dd('TODO');
    }




    public function export()
    {
        return Excel::download(new clientesExport, 'cliente.csv');
    }


    public function pdf()
    {
        // Obtener solo los clientes no desactivados
        $clientes = Cliente::where('desactivado', false)->get();

        // Crear y retornar el archivo PDF
        $pdf = Pdf::loadView('cliente.pdf', compact('clientes'));
        return $pdf->setPaper('a4', 'landscape')->stream('Reporte_clientes.pdf');
    }
}
