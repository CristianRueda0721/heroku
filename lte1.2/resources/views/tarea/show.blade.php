@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar Tarea</h1>
@stop

@section('content')
@section('template_title')
    {{ __('Update') }} Vehiculo
@endsection


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Tarea</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tarea.index') }}"> {{ __('Atras') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre Servicio Id:</strong>
                            {{ $tarea->Servicio->nombre_servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Servicio Id:</strong>
                            {{ $tarea->Servicio->precio_servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Producto Id:</strong>
                            {{ $tarea->Producto->nombre_producto }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Producto Id:</strong>
                            {{ $tarea->Producto->cantidad_productos }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Producto Id:</strong>
                            {{ $tarea->Producto->precio_producto }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Empleado Id:</strong>
                            {{ $tarea->Mecanico->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido Empleado Id:</strong>
                            {{ $tarea->Mecanico->apellido }}
                        </div>
                        <div class="form-group">
                            <strong>Especialidad Id:</strong>
                            {{ $tarea->Mecanico->especialidad }}}
                        </div>
                        <div class="form-group">
                            <strong>Estatus:</strong>
                            {{ $tarea->estatus }}
                        </div>
                        <div class="form-group">
                            <strong>Disponibilidad:</strong>
                            {{ $tarea->disponibilidad }}
                        </div>
                        <div class="form-group">
                            <strong>Comision:</strong>
                            {{ $tarea->Comision }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Cliente:</strong>
                            {{ $tarea->Cliente->nombre_cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido Cliente:</strong>
                            {{ $tarea->Cliente->apellido_cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Vehiculo Marca:</strong>
                            {{ $tarea->Vehiculo->vehiculo_marca }}
                        </div>
                        <div class="form-group">
                            <strong>Vehiculo Modelo:</strong>
                            {{ $tarea->Vehiculo->vehiculo_modelo }}
                        </div>
                        <div class="form-group">
                            <strong>Vehiculo Matricula:</strong>
                            {{ $tarea->Vehiculo->Vehiculo_matricula }}
                        </div>
                        <div class="form-group">
                            <strong>Vehiculo Color:</strong>
                            {{ $tarea->Vehiculo->Vehiculo_color }}
                        </div>
                        <div class="form-group">
                            <strong>Total Reparacion:</strong>
                            {{ number_format($tarea->total_reparacion,0, ',', '.') }}
                        </div>
                        <div class="form-group">
                            <strong>Total Comision:</strong>
                            {{ number_format($tarea->total_comision,0, ',', '.') }}
                        </div>
                        <div class="form-group">
                            <strong>Comentarios:</strong>
                            {{ $tarea->comentarios }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@stop

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
