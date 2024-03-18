@extends('adminlte::page')



@section('title', 'Dashboard')

@section('content_header')
    <h1>Peticiones, quejas y recursos</h1>



    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">


                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">

                            <table id="example" class="table table-striped" style="width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Identificación</th>
                                        <th scope="col">Asunto</th>
                                        <th scope="col">Mensaje</th>
                                        <th scope="col">Fecha de Creación</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Enviar Correo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($claims as $claim)
                                        <tr>
                                            <td>{{ $claim->nombre }}</td>
                                            <td>{{ $claim->email }}</td>
                                            <td>{{ $claim->telefono }}</td>
                                            <td>{{ $claim->identificacion }}</td>
                                            <td>{{ $claim->asunto }}</td>
                                            <td>{{ $claim->mensaje }}</td>
                                            <td>{{ $claim->created_at }}</td>
                                            <!-- claims.blade.php -->
                                            <td>
                                                <div>
                                                    <span></span>
                                                    <button class="btn btn-sm btn-primary status-btn"
                                                        data-claim-id="{{ $claim->id }}">{{ $claim->status }}</button>

                                                </div>
                                            </td>

                                            <td>
                                                <a class="btn btn-sm btn-primary status-btn"  href="{{url('send_mail' , $claim->id)}}">enviar correo</a>
                                            </td>    
                                        </tr>
                                    @endforeach
                                </tbody>




                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stop
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusButtons = document.querySelectorAll('.status-btn');

            statusButtons.forEach(statusButton => {
                statusButton.addEventListener('click', function() {
                    const claimId = this.dataset.claimId; // Access dataset of clicked statusButton
                    fetch(`/update-status/${claimId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token here
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.text()) // Convert response to text
                        .then(data => {
                            console.log('Response:', data); // Log the response
                            try {
                                const jsonData = JSON.parse(data);
                                this.textContent = jsonData
                                .status; // Update textContent of clicked statusButton
                            } catch (error) {
                                console.error('Error parsing JSON:', error);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>


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
