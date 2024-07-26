<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos Seleccionados</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .table {
            margin-top: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead th {
            background-color: #343a40;
            color: #fff;
        }
        .btn-view-cv {
            background-color: #28a745;
            color: white;
        }
        .btn-view-cv:hover {
            background-color: #218838;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4">Contactos Seleccionados</h1>
                <p class="lead">Aquí puedes ver la información de los contactos seleccionados.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Portafolio</th>
                            <th>País</th>
                            <th>Cargo</th>
                            <th>CV</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactosSeleccionados as $contacto)
                            <tr>
                                <td>{{ $contacto->nombre }}</td>
                                <td>{{ $contacto->apellido }}</td>
                                <td>{{ $contacto->correo }}</td>
                                <td>{{ $contacto->telefono }}</td>
                                <td>{{ $contacto->portafolio }}</td>
                                <td>{{ $contacto->pais }}</td>
                                <td>{{ $contacto->cargo_id }}</td>
                                <td>
                                    @if($contacto->cv)
                                        <a class="btn btn-view-cv" href="{{url('/')}}/cv/{{$contacto->cv}}" target="_blank" title="Ver CV">Ver CV</a>
                                    @else
                                        No disponible
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
