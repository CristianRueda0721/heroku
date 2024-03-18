<?php

namespace App\Http\Controllers;

use App\Exports\mecanicosExport;
use App\Models\Mecanico;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class MecanicoController
 * @package App\Http\Controllers
 */
class MecanicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $query = Mecanico::query();


        if ($request->filled('cedula')) {
            $query->where('cedula', 'like', '%' . $request->cedula . '%');
        }


        if ($request->filled('especialidad')) {
           $query->where('especialidad', 'like', '%' . $request->especialidad . '%');
       }

       $query->where('desactivado', false);
        $mecanicos = $query->paginate();

        return view('mecanico.index', compact('mecanicos'))
            ->with('i', (request()->input('page', 1) - 1) * $mecanicos->perPage());
    }

    public function desactivar($id)
     {
         $mecanico = Mecanico::findOrFail($id);
         $mecanico->desactivar();

         return redirect()->route('mecanicos.index')->with('desactivar', 'ok');
     }

     public function activar($id)
     {
         $mecanico = Mecanico::findOrFail($id);
         $mecanico->activar();

         return redirect()->route('mecanicos.index')->with('activar', 'ok');
     }


     public function mostrarDesactivadas()
     {
         $mecanicosDesactivadas = Mecanico::where('desactivado', true)->paginate(20); // Ajusta el número según tus necesidades

         return view('mecanico.activar', compact('mecanicosDesactivadas'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mecanico = new Mecanico();
        return view('mecanico.create', compact('mecanico'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Mecanico::$rules, [

            'cedula.required' => '• Debe ingresar la cedula del empleado.',
            'cedula.numeric' => '• El campo no debe tener simbolos ni letras, solo numeros.',
            'cedula.digits' => '• El campo debe tener 10 digitos por lo menos.',

            'nombre.required' => '• Debe ingresar el nombre del mecanico.',
            'nombre.regex' => '• El campo no debe tener simbolos ni numeros, solo letras.',
            'nombre.max' => '• El campo debe tener solamente 20 caracteres.',

            'apellido.required' => '• Debe ingresar el apellido del mecanico.',
            'apellido.regex' => '• El campo no debe tener simbolos ni numeros, solo letras.',
            'apellido.max' => '• El campo debe tener solamente 20 caracteres.',

            "direccion.required"  => '• Debe ingrear una direccion.',
            "direccion.max"  => '• El campo no debe superar los 10 caracteres.',
            "direccion.regex"  => '• El campo solo acepta simbolos como: "# y -".',

            "telefono.required"  => '• Debe ingresar el telefono del mecanico.',
            "telefono.numeric"  => '• El campo no debe tener simbolos ni letras, solo numeros.',
            "telefono.digits"  => '• El campo debe tener 10 digitos por lo menos',


            "email.required"  => '• Debe ingresar el correo del mecanico.',
            "email.email"  => '• El correo debe tener un "@" y lo siguiente al "@".',
            "email.max"  => '• El correo no debe pasar lo 30 caracteres.',
            "email.regex"  => '• El correo debe tener el ".com".',


            "ciudad.required"  => '• Debe Ingresar la cuidad del mecanico.',
            "ciudad.alpha"  => '• El campo no debe tener numeros ni simbolos solo letras.',
            "ciudad.max"  => '• La cuidad no debe pasar los 10 caracteres.',

            "especialidad.required"  => '• Debe ingresar una especialidad al mecanico.',
            "especialidad.regex"  => '• El campo no debe tener simbolos como tambien numeros, unicamnete letras.',
            "especialidad.max"  => '• La especialidad no debe pasar los 25 caracteres.',

        ]);

        $mecanico = Mecanico::create($request->all());

        return redirect()->route('mecanicos.index')
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
        $mecanico = Mecanico::find($id);

        return view('mecanico.show', compact('mecanico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mecanico = Mecanico::find($id);

        return view('mecanico.edit', compact('mecanico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Mecanico $mecanico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mecanico $mecanico)
    {
        $request->validate(Mecanico::$rules, [

            'cedula.required' => '• Debe ingresar la cedula del empleado.',
            'cedula.numeric' => '• El campo no debe tener simbolos ni letras, solo numeros.',
            'cedula.digits' => '• El campo debe tener 10 digitos por lo menos.',

            'nombre.required' => '• Debe ingresar el nombre del mecanico.',
            'nombre.regex' => '• El campo no debe tener simbolos ni numeros, solo letras.',
            'nombre.max' => '• El campo debe tener solamente 20 caracteres.',

            'apellido.required' => '• Debe ingresar el apellido del mecanico.',
            'apellido.regex' => '• El campo no debe tener simbolos ni numeros, solo letras.',
            'apellido.max' => '• El campo debe tener solamente 20 caracteres.',

            "direccion.required"  => '• Debe ingrear una direccion.',
            "direccion.max"  => '• El campo no debe superar los 10 caracteres.',
            "direccion.regex"  => '• El campo solo acepta simbolos como: "# y -".',

            "telefono.required"  => '• Debe ingresar el telefono del mecanico.',
            "telefono.numeric"  => '• El campo no debe tener simbolos ni letras, solo numeros.',
            "telefono.digits"  => '• El campo debe tener 10 digitos por lo menos',


            "email.required"  => '• Debe ingresar el correo del mecanico.',
            "email.email"  => '• El correo debe tener un "@" y lo siguiente al "@".',
            "email.max"  => '• El correo no debe pasar lo 30 caracteres.',
            "email.regex"  => '• El correo debe tener el ".com".',


            "ciudad.required"  => '• Debe Ingresar la cuidad del mecanico.',
            "ciudad.alpha"  => '• El campo no debe tener numeros ni simbolos solo letras.',
            "ciudad.max"  => '• La cuidad no debe pasar los 10 caracteres.',

            "especialidad.required"  => '• Debe ingresar una especialidad al mecanico.',
            "especialidad.regex"  => '• El campo no debe tener simbolos como tambien numeros, unicamnete letras.',
            "especialidad.max"  => '• La especialidad no debe pasar los 25 caracteres.',

        ]);

        $mecanico->update($request->all());

        return redirect()->route('mecanicos.index')
        ->with('editar', 'ok');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $mecanico = Mecanico::find($id)->delete();

        return redirect()->route('mecanicos.index')
            ->with('success', 'Mecanico deleted successfully');
    }

    public function import(Request $request)
{
    DD('TODO');
}




    public function export()
    {
        return Excel::download(new mecanicosExport, 'mecanicos.csv');
    }

    public function pdf()
    {
        // Obtener solo los clientes no desactivados
        $mecanicos = Mecanico::where('desactivado', false)->get();

        $pdf = Pdf::loadView('mecanico.pdf', compact('mecanicos'));
        return $pdf->setPaper('a4', 'landscape')->stream('Reporte_mecanicos.pdf');

    }

}
