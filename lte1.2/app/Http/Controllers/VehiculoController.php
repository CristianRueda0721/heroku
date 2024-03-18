<?php

namespace App\Http\Controllers;

use App\Exports\vehiculosExport;
use App\Models\Vehiculo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class VehiculoController
 * @package App\Http\Controllers
 */
class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
     {
         $query = Vehiculo::query();

         // Filtro por nombre de cliente
         if ($request->filled('vehiculo_modelo')) {
             $query->where('vehiculo_modelo', 'like', '%' . $request->vehiculo_modelo . '%');
         }

         // Filtro por matrícula de vehículo
         if ($request->filled('Vehiculo_matricula')) {
            $query->where('Vehiculo_matricula', 'like', '%' . $request->Vehiculo_matricula . '%');
        }

        $query->where('desactivado', false);
         $vehiculos = $query->paginate();

         return view('vehiculo.index', compact('vehiculos'))
             ->with('i', (request()->input('page', 1) - 1) * $vehiculos->perPage());
     }

     public function desactivar($id)
     {
         $vehiculo = Vehiculo::findOrFail($id);
         $vehiculo->desactivar();

         return redirect()->route('vehiculos.index')->with('desactivar', 'ok');
     }

     public function activar($id)
     {
         $vehiculo = Vehiculo::findOrFail($id);
         $vehiculo->activar();

         return redirect()->route('vehiculos.index')->with('activar', 'ok');
     }


     public function mostrarDesactivadas()
     {
         $vehiculosDesactivadas = Vehiculo::where('desactivado', true)->paginate(20); // Ajusta el número según tus necesidades

         return view('vehiculo.activar', compact('vehiculosDesactivadas'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehiculo = new Vehiculo();
        return view('vehiculo.create', compact('vehiculo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Vehiculo::$rules, [


            "vehiculo_marca.required"  => '• Debe ingresar la marca del vehiculo.',
            "vehiculo_marca.regex"  => '• El campo no debe tener numeros ni sombolos solo letras.',
            "vehiculo_marca.max"  => '• El maximo de caraceteres son 20.',

            "vehiculo_modelo.required"  => '• Debe ingresar la modelo del vehiculo.',
            "vehiculo_modelo.regex"  => '• El campo no puede tener simbolos ni caracteres especiales.',
            "vehiculo_modelo.max"  => '• El maximo de caraceteres son 15.',

            "Vehiculo_matricula.required"  => '• Debe ingresar la matricula del vehiculo.',
            "Vehiculo_matricula.regex"  => '• El campo no puede simbolos ni caracteres especiales.',
            "Vehiculo_matricula.max"  => '• El campo debe tener por lo menos 6 caracteres.',

            "Vehiculo_color.required"  => '• Debe ingresar la color del vehiculo.',
            "Vehiculo_color.regex"  => '• El campo no debe tener ni numeros como simbolos o caracteres especiales, solo letras.',
            "Vehiculo_color.max"  => '• El maximo de caracteres son 15.',


        ]);



        $vehiculo = Vehiculo::create($request->all());

        return redirect()->route('vehiculos.index')
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
        $vehiculo = Vehiculo::find($id);

        return view('vehiculo.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::find($id);

        return view('vehiculo.edit', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Vehiculo $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate(Vehiculo::$rules, [


            "vehiculo_marca.required"  => '• Debe ingresar la marca del vehiculo.',
            "vehiculo_marca.regex"  => '• El campo no debe tener numeros ni sombolos solo letras.',
            "vehiculo_marca.max"  => '• El maximo de caraceteres son 20.',

            "vehiculo_modelo.required"  => '• Debe ingresar la modelo del vehiculo.',
            "vehiculo_modelo.regex"  => '• El campo no puede tener simbolos ni caracteres especiales.',
            "vehiculo_modelo.max"  => '• El maximo de caraceteres son 15.',

            "Vehiculo_matricula.required"  => '• Debe ingresar la matricula del vehiculo.',
            "Vehiculo_matricula.regex"  => '• El campo no puede simbolos ni caracteres especiales.',
            "Vehiculo_matricula.max"  => '• El campo debe tener por lo menos 6 caracteres.',

            "Vehiculo_color.required"  => '• Debe ingresar la color del vehiculo.',
            "Vehiculo_color.regex"  => '• El campo no debe tener ni numeros como simbolos o caracteres especiales, solo letras.',
            "Vehiculo_color.max"  => '• El maximo de caracteres son 15.',


        ]);

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')
            ->with('editar', 'ok');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id)->delete();

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehiculo deleted successfully');
    }

    public function import(Request $request)
{
   dd('TODO');
}




    public function export()
    {
        return Excel::download(new vehiculosExport, 'vehiculos.csv');

    }
    public function pdf()
{
    // Obtener solo los vehículos no desactivados
    $vehiculos = Vehiculo::where('desactivado', false)->get();

    // Crear y retornar el archivo PDF
    $pdf = Pdf::loadView('vehiculo.pdf', compact('vehiculos'));
    return $pdf->setPaper('a4', 'landscape')->stream('Reporte_vehiculos.pdf');
}
}
