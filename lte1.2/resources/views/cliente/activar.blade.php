@extends('adminlte::page')



@section('title', 'Dashboard')

@section('content_header')
    <h1>Fidelizacion de Clientes</h1>

@stop
@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Registros inhabilitados de clientes') }}
                            </span>

                            <div class="float-right">





                                <div class="text-right"> <!-- Alineación a la derecha -->

                                    <a href="{{ route('clientes.index') }}" class="btn btn-primary btn-sm"
                                        data-placement="right">
                                        {{ __('Clientes habilitados') }}
                                    </a>







                                </div>
                            </div>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped nowrap" style="width: 100%">
                                    <thead class="thead">
                                        <tr>


                                            <th>Cedula Cliente</th>
                                            <th>Nombre Cliente</th>
                                            <th>Apellido Cliente</th>
                                            <th>Direccion</th>
                                            <th>Telefono</th>
                                            <th>Email</th>
                                            <th>Ciudad</th>
                                            <th>Vehiculo Marca</th>
                                            <th>Vehiculo Modelo</th>
                                            <th>Vehiculo Matricula</th>
                                            <th>Vehiculo Color</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientesDesactivadas as $cliente)
                                            <tr>


                                                <td>{{ $cliente->cedula_cliente }}</td>
                                                <td>{{ $cliente->nombre_cliente }}</td>
                                                <td>{{ $cliente->apellido_cliente }}</td>
                                                <td>{{ $cliente->direccion }}</td>
                                                <td>{{ $cliente->telefono }}</td>
                                                <td>{{ $cliente->email }}</td>
                                                <td>{{ $cliente->ciudad }}</td>
                                                <td>{{ $cliente->Vehiculo->vehiculo_marca }}</td>
                                                <td>{{ $cliente->Vehiculo->vehiculo_modelo }}</td>
                                                <td>{{ $cliente->Vehiculo->Vehiculo_matricula }}</td>
                                                <td>{{ $cliente->Vehiculo->Vehiculo_color }}</td>

                                                <td>

                                                    @if ($cliente->desactivado)
                                                        <form action="{{ route('clientes.activar', $cliente->id) }}"
                                                            method="POST">
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ route('clientes.show', $cliente->id) }}">
                                                                <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                            </a>
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ route('clientes.edit', $cliente->id) }}">
                                                                <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                            </a>

                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-info btn-sm "><i
                                                                    class="fa fa-fw fa-save"></i>
                                                                {{ __('Habilitar') }}</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('clientes.desactivar', $cliente->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn btn-warning">Inhabilitar</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {!! $clientesDesactivadas->links() !!}
                </div>
            </div>
        </div>
    @endsection



    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
            rel="stylesheet" />
        <link href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css" rel="stylesheet" />

    @stop

    @section('js')
        <script>
            console.log('Hi!');
        </script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.js"></script>

        <script>
            $("#example").DataTable({
                responsive: true,

                "language": {
                    "lengthMenu": "Mostrar _MENU_ filas por página",
                    "zeroRecords": "Datos no encontrados - sorry",
                    "info": "Mostrandro la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros dispobles",
                    "infoFiltered": "(Filtrado de _MAX_ filas en totals)",
                    "search": 'Buscar:',
                    "paginate": {
                        "first": "Primero",
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "last": "Último"
                    }
                }

            })
        </script>




        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    @stop
