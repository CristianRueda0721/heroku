<?php

namespace App\Http\Controllers;

use App\Exports\serviciosExport;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

/**
 * Class ServicioController
 * @package App\Http\Controllers
 */
class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Servicio::query();

        // Filtro por nombre de cliente
        if ($request->filled('nombre_servicio')) {
            $query->where('nombre_servicio', 'like', '%' . $request->nombre_servicio . '%');
        }

        // Filtro por matrícula de vehículo
        if ($request->filled('telefono')) {
           $query->where('telefono', 'like', '%' . $request->telefono . '%');
       }

       $query->where('desactivado', false);
        $servicios = $query->paginate();

        return view('servicio.index', compact('servicios'))
            ->with('i', (request()->input('page', 1) - 1) * $servicios->perPage());
    }

    public function desactivar($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->desactivar();

        return redirect()->route('servicios.index')->with('desactivar', 'ok');
    }

    public function activar($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->activar();

        return redirect()->route('servicios.index')->with('activar', 'ok');
    }


    public function mostrarDesactivadas()
    {
        $serviciosDesactivadas = Servicio::where('desactivado', true)->paginate(20); // Ajusta el número según tus necesidades

        return view('servicio.activar', compact('serviciosDesactivadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicio = new Servicio();
        return view('servicio.create', compact('servicio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Servicio::$rules, [


            "nombre_servicio.required"  => '• Debe ingresar el nombre del Servicio.',
            "nombre_servicio.regex"  => '• El campo no debe tener numeros ni sombolos solo letras.',
            "nombre_servicio.max"  => '• El maximo de caraceteres son 10.',

            "precio_servicio.required"  => '• Debe ingresar el precio del servicio.',
            "precio_servicio.numeric"  => '• El campo no puede tener simbolos como letras, solo numeros.',
            "precio_servicio.max"  => '• El maximo de caraceteres son 999999999999.',






        ]);

        $servicio = Servicio::create($request->all());

        return redirect()->route('servicios.index')
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
        $servicio = Servicio::find($id);

        return view('servicio.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio = Servicio::find($id);

        return view('servicio.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Servicio $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        $request->validate(Servicio::$rules, [


            "nombre_servicio.required"  => '• Debe ingresar el nombre del Servicio.',
            "nombre_servicio.regex"  => '• El campo no debe tener numeros ni sombolos solo letras.',
            "nombre_servicio.max"  => '• El maximo de caraceteres son 25.',

            "precio_servicio.required"  => '• Debe ingresar el precio del servicio.',
            "precio_servicio.numeric"  => '• El campo no puede tener simbolos como letras, solo numeros.',
            "precio_servicio.max"  => '• El maximo de caraceteres son 999999999999.',






        ]);

        $servicio->update($request->all());

        return redirect()->route('servicios.index')
        ->with('editar', 'ok');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $servicio = Servicio::find($id)->delete();

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio deleted successfully');
    }

    public function import(Request $request)
    {
        dd('todo');
    }




        public function export()
        {
            return Excel::download(new serviciosExport, 'servicio.csv');
        }

        public function pdf()
    {
        // Obtener solo los clientes no desactivados
        $servicios = Servicio::where('desactivado', false)->get();

        $pdf = Pdf::loadView('servicio.pdf', compact('servicios'));
        return $pdf->setPaper('a4', 'landscape')->stream('Reporte_servicios.pdf');

    }
}
