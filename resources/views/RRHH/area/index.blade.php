<x-app-layout>
    <x-slot:title>
        Lista de areas
      </x-slot>

      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Areas</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Areas</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col" width="110">Area</th>
                            <th scope="col" width="90">Empresa</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($areas as $key => $area)
                        <tr>
                            <td>{{$key + 1}}</td>
                        <td>{{ $area->area }}</td>
                        {{-- Mostramos el nombre de la empresa.
                            1 parametro es de la función del Modelo
                            2 parametro es el nombre en la bbdd --}}
                        <td> {{$area->empresa->empresa}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>