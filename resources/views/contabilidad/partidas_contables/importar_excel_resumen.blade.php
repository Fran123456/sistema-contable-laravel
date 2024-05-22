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
                <h5>Resultado de la importación de partida contable</h5>
                <h6>Total de filas recorridas: {{ $rows }}</h6>

                @if (count($errores) > 0)
                <div class="mt-2">
                  <x-message color="danger" message="Errores generados"></x-message>
              </div>
                <table class="table table-bordered table-sm">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Cuenta</th>
                          <th scope="col">Atrirbutos</th>
                          <th scope="col" width="650">Mensaje</th>
                      </tr>
                  </thead>
                  <tbody>
                      @for ($i = 0; $i < count($errores); $i++)
                          <tr>
                              <th scope="row">{{ $i + 1 }}</th>
                              <td>
                                  {{ $errores[$i][0]['cuenta'] }} <br>


                              </td>
                              <td>
                                  <strong>Debe:</strong> {{ $errores[$i][0]['debe'] }} <br>
                                  <strong>Haber:</strong> {{ $errores[$i][0]['haber'] }} <br>
                                  <strong>Periodo:</strong> {{ $errores[$i][0]['periodo'] }} <br>
                              </td>
                              <td>{{ $errores[$i][1] }}</td>
                          </tr>
                      @endfor

                  </tbody>
                 </table>
                @else
                <div class="mt-2">
                  <x-message color="success" message="Se ha exportado la partida sin ningun error"></x-message>
                 </div>
                @endif





            </div>

        </div>

    </div>



</x-app-layout>
