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



<h1 class='titulo'>REPORTE PDF DE SERVICIOS</h1>
<h3> Servicentro La 22</h3>
    <div>

        <table id="example" class="table table-striped nowrap" style="width: 100%">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>

										<th>Nombre Servicio</th>
										<th>Precio Servicio</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicios as $servicio)
                                        <tr>
                                            <td>{{ $servicio->id }}</td>

											<td>{{ $servicio->nombre_servicio }}</td>
											<td>{{ number_format($servicio->precio_servicio,0, ',', '.') }}</td>


                                    @endforeach
                                </tbody>
                            </table>









    </div>


</html>
