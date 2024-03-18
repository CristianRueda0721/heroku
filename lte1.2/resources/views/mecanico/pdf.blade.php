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
    
    

<h1 class='titulo'>REPORTE PDF DE EMPLEADOS</h1> 
<h3> Servicentro La 22</h3>
    <div>
    
        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>

                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Ciudad</th>
                                    <th>Especialidad</th>

                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mecanicos as $mecanico)
                                    <tr>
                                        <td>{{ $mecanico->id }}</td>

                                        <td>{{ $mecanico->cedula }}</td>
                                        <td>{{ $mecanico->nombre }}</td>
                                        <td>{{ $mecanico->apellido }}</td>
                                        <td>{{ $mecanico->direccion }}</td>
                                        <td>{{ $mecanico->telefono }}</td>
                                        <td>{{ $mecanico->email }}</td>
                                        <td>{{ $mecanico->ciudad }}</td>
                                        <td>{{ $mecanico->especialidad }}</td>

                                    
                                @endforeach
                            </tbody>
                        </table>









    </div>
    

</html>
