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
    
    

<h1 class='titulo'>REPORTE PDF DE CLIENTES</h1> 
<h3> Servicentro La 22</h3>
    <div>
    
        <table >
                            <thead>
                                <tr>
                                 <th>ID</th>
                                    <th>Cedula Cliente</th>
                                    <th>Nombre Cliente</th>
                                    <th>Apellido Cliente</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Ciudad</th>
                                    <th>Vehiculo Marca Id</th>
                                    <th>Vehiculo Modelo Id</th>
                                    <th>Vehiculo Matricula Id</th>
                                    <th>Vehiculo Color Id</th>

                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        
                                        <td>{{ $cliente->id }}</td>
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

                            
                                @endforeach
                            </tbody>
                        </table>









    </div>
    

</html>
