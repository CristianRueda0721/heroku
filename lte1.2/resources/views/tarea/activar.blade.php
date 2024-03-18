@extends('adminlte::page')



@section('title', 'Dashboard')

@section('content_header')
    <h1>Tareas Empleados </h1>

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tareas inhabilitadas') }}
                            </span>



                            <div class="float-right">


                                <div class="text-right">

                                    <a href="{{ route('tarea.index') }}" class="btn btn-primary btn-sm"
                                        data-placement="right">
                                        {{ __('Volver a Tareas habilitadas') }}
                                    </a>
                                </div>
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
                            <table id="example" class="table table-striped nowrap"style="width: 100%">
                                <thead class="thead">
                                    <tr>


                                        <th>Nombre Servicio </th>
                                        <th>Precio Servicio </th>
                                        <th>Nombre Producto </th>
                                        <th>Cantidad Producto </th>
                                        <th>Precio Producto </th>
                                        <th>Nombre Empleado </th>
                                        <th>Apellido Empleado </th>
                                        <th>Especialidad </th>
                                        <th>Estatus</th>
                                        <th>Disponibilidad</th>
                                        <th>Comision</th>
                                        <th>Nombre Cliente </th>
                                        <th>Apellido Cliente </th>
                                        <th>Vehiculo Marca </th>
                                        <th>Vehiculo Modelo </th>
                                        <th>Vehiculo Matricula </th>
                                        <th>Vehiculo Color </th>
                                        <th>Total Reparacion</th>
                                        <th>Total Comision</th>
                                        <th>Comentarios</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tareasDesactivadas as $tarea)
                                        <tr>


                                            <td>{{ $tarea->Servicio->nombre_servicio }}</td>
                                            <td>{{ $tarea->Servicio->precio_servicio }}</td>

                                            <td>{{ $tarea->Producto->nombre_producto }}</td>
                                            <td>{{ $tarea->Producto->cantidad_productos }}</td>
                                            <td>{{ $tarea->Producto->precio_producto }}</td>

                                            <td>{{ $tarea->Mecanico->nombre }}</td>
                                            <td>{{ $tarea->Mecanico->apellido }}</td>
                                            <td>{{ $tarea->Mecanico->especialidad }}</td>
                                            <td>{{ $tarea->estatus }}</td>
                                            <td>{{ $tarea->disponibilidad }}</td>
                                            <td>{{ $tarea->Comision }}</td>

                                            <td>{{ $tarea->Cliente->nombre_cliente }}</td>
                                            <td>{{ $tarea->Cliente->apellido_cliente }}</td>

                                            <td>{{ $tarea->Vehiculo->vehiculo_marca }}</td>
                                            <td>{{ $tarea->Vehiculo->vehiculo_modelo }}</td>
                                            <td>{{ $tarea->Vehiculo->Vehiculo_matricula }}</td>
                                            <td>{{ $tarea->Vehiculo->Vehiculo_color }}</td>

                                            <td>{{ number_format($tarea->total_reparacion,0, ',', '.') }}</td>
                                            <td>{{ number_format($tarea->total_comision,0, ',', '.')}}</td>
                                            <td>{{ $tarea->comentarios }}</td>

                                            <td>

                                                @if ($tarea->desactivado)
                                                    <form action="{{ route('tareas.activar', $tarea->id) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('tareas.show', $tarea->id) }}">
                                                            <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                        </a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('tareas.edit', $tarea->id) }}">
                                                            <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                        </a>

                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-info btn-sm "><i
                                                                class="fa fa-fw fa-save"></i>
                                                            {{ __('Habilitar') }}</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('tareas.desactivar', $tarea->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-warning">Inhabilitar</button>
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
                {!! $tareasDesactivadas->links() !!}
            </div>
        </div>
    </div>
@endsection





@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
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
        new DataTable('#example', {
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
