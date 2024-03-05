<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

    <x-slot:title>
       Importar catalogo de cuentas
     </x-slot>

     <x-slot:subtitle>
     </x-slot>


    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contabilidad.cuentas-contables.index') }}">Catalogo de cuentas contables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Importar catalogo de cuentas</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>




    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Agregar catalogo de cuentas contables via Excel </h5>

                <form enctype='multipart/form-data' method="post" action="{{ route('contabilidad.importarCuentasExcel') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-danger" href="{{ asset('plantillas/excel/export-catalogo-cuentas.xlsx') }}">Descarga plantilla</a>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <h5>Catalogos disponibles para la importación del catalogo contable</h5>
                             <div class="row">

                                <div class="col-md-6">
                                    <h6>Niveles de cuentas contables</h6>
                                    <table class="table table-sm">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nivel</th>
                                            <th scope="col">Digitos</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($niveles as $key=> $nivel)
                                          <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $nivel->nivel }}</td>
                                            <td>{{ $nivel->digitos }}</td>
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                </div>
                                <div class="col-md-6">
                                    <h6>Clasificación de cuentas contables</h6>
                                    <table class="table table-sm">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Clasificación</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($clasificacion as $key=> $c)
                                          <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $c->clasificacion }}</td>
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                      <br>

                                      <h6>Clasificación por tipo cuenta</h6>
                                    <table class="table table-sm">
                                        <thead>
                                          <tr>
                                            <th scope="col">Tipo cuena</th>
                                          </tr>
                                        </thead>
                                        <tbody>

                                          <tr>
                                            <td>acreedora</td>
                                          </tr>
                                          <tr>
                                            <td>deudora</td>
                                          </tr>

                                        </tbody>
                                      </table>
                                </div>
                             </div>
                        </div>
                    </div>

                    <div class="row mt-4">

                        <div class="col-md-12">
                            <h5>Ejemplo de archivo excel de exportación</h5>
                                <img src="{{ asset('plantillas/excel/catalogo-ejemplo.png') }}" alt="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""><strong>Subir catalogo en archivo Excel (.XLSX)</strong> </label>
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
