<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

    <x-slot:title>
        Importar partida contable
    </x-slot>

    <x-slot:subtitle>
    </x-slot>


    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contabilidad.partidas.index') }}">Partidas contables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Importar partida contable</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>




    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Agregar partida contable via Excel </h5>

                <form enctype='multipart/form-data' method="post"
                    action="{{ route('contabilidad.importarPartidasExcel') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-danger" href="{{ asset('plantillas/excel/partida.xlsx') }}">Descarga
                                plantilla</a>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <h5>Catalogos disponibles para la importación de una partida</h5>
                            <div class="row">

                                <div class="col-md-12">
                                    <h6>Tipo de partidas</h6>
                                    <p>Importante poner exactamente el tipo de partida si no , no se podra crear</p>
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tipos as $key => $tp)
                                                <tr>
                                                    <td>{{ $tp->tipo }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">

                        <div class="col-md-12">
                            <h5>Ejemplo de archivo excel de exportación</h5>
                            <a class="btn btn-warning"
                                href="{{ asset('plantillas/excel/partida_ejemplo.xlsx') }}">Descarga ejemplo</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-3 mb-2">
                            <label for=""><strong>Subir partida en archivo Excel (.XLSX)</strong> </label>
                            <input type="file" name="excel" required class="form-control">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-4 mb-1">
                            <button style="color: white" type="submit" class="btn btn-success"> <i
                                    class="fas fa-save"></i></button>
                        </div>
                    </div>
                </form>



            </div>

        </div>

    </div>



</x-app-layout>
