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



<h1 class='titulo'>REPORTE PDF DE VENTAS</h1>
<h3> Servicentro La 22</h3>
    <div>
        <table>
            <colgroup>
                <col span="17" />
                <!-- Colspan de 17 celdas para las columnas de datos -->
                <col class="logo-cell" />
                <!-- Colspan de 1 celda para la columna de la imagen -->
            </colgroup>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre  Empleado</th>
                    <th>Apellido Empleado</th>
                    <th>Especialidad</th>
                    <th>Nombre Cliente</th>
                    <th>Apellido Cliente</th>
                    <th>Vehiculo Marca</th>
                    <th>Vehiculo Modelo</th>
                    <th>Matricula</th>
                    <th>Color</th>
                    <th>Nombre Servicio</th>
                    <th>Precio Servicio</th>
                    <th>Nombre Producto</th>
                    <th>Cantidad Producto</th>
                    <th>Precio Producto</th>
                    <th>Total Comision</th>
                    <th>Fecha Venta</th>
                    <th>Total Venta</th>
                    <!-- Nueva columna para la imagen -->

                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->Mecanico->id }}</td>
                        <td>{{ $venta->Mecanico->nombre }}</td>
                        <td>{{ $venta->Mecanico->apellido }}</td>
                        <td>{{ $venta->Mecanico->especialidad}}</td>

                        <td>{{ $venta->Cliente->nombre_cliente }}</td>
                        <td>{{ $venta->Cliente->apellido_cliente }}</td>

                        <td>{{ $venta->Vehiculo->vehiculo_marca }}</td>
                        <td>{{ $venta->Vehiculo->vehiculo_modelo }}</td>
                        <td>{{ $venta->Vehiculo->Vehiculo_matricula }}</td>
                        <td>{{ $venta->Vehiculo->Vehiculo_color  }}</td>

                        <td>{{ $venta->Servicio->nombre_servicio }}</td>
                        <td>{{ $venta->Servicio->precio_servicio }}</td>

                        <td>{{ $venta->Producto->nombre_producto }}</td>
                        <td>{{ $venta->Producto->cantidad_productos}}</td>
                        <td>{{ $venta->Producto->precio_producto }}</td>

                        <td>{{ $venta->Tarea->total_comision }}</td>
                        <td>{{ $venta->fecha_venta }}</td>
                        <td>{{ number_format($venta->total_venta,0, ',', '.') }}</td>



                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</html>
