<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>




    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Resultado de la importación de catalogo de cuentas contables </h5>
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
                          <th scope="col">Atirbutos</th>
                          <th scope="col" width="650">Mensaje</th>
                      </tr>
                  </thead>
                  <tbody>
                      @for ($i = 0; $i < count($errores); $i++)
                          <tr>
                              <th scope="row">{{ $i + 1 }}</th>
                              <td>
                                  <strong>Codigo:</strong> {{ $errores[$i][0]['codigo'] }} <br>
                                  <strong>Cuenta: </strong>{{ $errores[$i][0]['nombre_cuenta'] }} <br>


                              </td>
                              <td>
                                  <strong>Padre:</strong> {{ $errores[$i][0]['codigo_padre'] }} <br>
                                  <strong>Nivel:</strong> {{ $errores[$i][0]['nivel'] }} <br>
                                  <strong>Clasificación:</strong> {{ $errores[$i][0]['clasificacion'] }} <br>
                              </td>
                              <td>{{ $errores[$i][1] }}</td>
                          </tr>
                      @endfor

                  </tbody>
                 </table>
                @else 
                <div class="mt-2">
                  <x-message color="success" message="Se ha exportado el catalogo sin ningun error"></x-message>
                 </div>
                @endif
                




            </div>

        </div>

    </div>



</x-app-layout>
