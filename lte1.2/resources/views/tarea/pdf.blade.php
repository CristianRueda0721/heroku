<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reportes Ventas PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            border: 0.1px solid grey;
            padding: 0px;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            text-align: center; /* Alineación horizontal */
            vertical-align: middle; /* Alineación vertical */
        }

        th {
            background-color: black;
            color: yellow;
        }

        td {
            background-color: white;
        }

        .logo-cell {
            background-color: white; /* Ajusta el color de fondo según tus necesidades */
            text-align: center;
            vertical-align: middle;
        }

        .logo-cell img {
            max-width: 100%; /* Ajusta el tamaño máximo de la imagen según tus necesidades */
            max-height: 100%;
        }
        .titulo {
            margin-top: -3rem;
            text-align: center;
            font-size: 50px;
            font-family: 'Arial', sans-serif;
            }
        h3{
            font-family: 'Arial', sans-serif;
        }

    </style>
</head>

<body>



<h1 class='titulo'>REPORTE PDF DE TAREAS</h1>
<h3> Servicentro La 22</h3>
    <div>

        <table id="example" class="table table-striped nowrap"style="width: 100%">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>

										<th>Nombre Servicio </th>

										<th>Nombre Producto </th>
										<th>Cantidad Producto </th>

										<th>Nombre Empleado </th>

										<th>Especialidad</th>
										<th>Estado</th>
										<th>Dispo</th>
										<th>Comision</th>
										<th>Nombre Cliente </th>
										<th>Apellido Cliente </th>
										<th>Vehiculo Marca </th>
										<th>Vehiculo Modelo </th>
										<th>Vehiculo Matricula </th>
										<th>Vehiculo Color </th>
										<th>Total Reparacion</th>
										<th>Comision total</th>
										<th>Comentarios</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tareas as $tarea)
                                        <tr>
                                            <td>{{ $tarea->id }}</td>

											<td>{{ $tarea->Servicio->nombre_servicio }}</td>


											<td>{{ $tarea->Producto->nombre_producto }}</td>
											<td>{{ $tarea->Producto->cantidad_productos }}</td>


											<td>{{ $tarea->Mecanico->nombre }}</td>
											>
											<td>{{ $tarea->Mecanico->especialidad}}</td>
											<td>{{ $tarea->estatus }}</td>
											<td>{{ $tarea->disponibilidad }}</td>
											<td>{{ $tarea->Comision }}</td>

											<td>{{ $tarea->Cliente->nombre_cliente }}</td>
											<td>{{ $tarea->Cliente->apellido_cliente }}</td>

											<td>{{ $tarea->Vehiculo->vehiculo_marca  }}</td>
											<td>{{ $tarea->Vehiculo->vehiculo_modelo }}</td>
											<td>{{ $tarea->Vehiculo->Vehiculo_matricula }}</td>
											<td>{{ $tarea->Vehiculo->Vehiculo_color }}</td>

											<td>{{ number_format($tarea->total_reparacion,0, ',', '.')}}</td>
											<td>{{ number_format($tarea->total_comision,0, ',', '.') }}</td>
											<td>{{ $tarea->comentarios }}</td>


                                    @endforeach
                                </tbody>
                            </table>








    </div>


</html>
