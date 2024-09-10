<x-app-layout>
    <x-slot:title>
    Configuración de contabilidad
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Documentos eLectronicos</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                    <table class="table table-sm" id="datatable-responsive">
                        <thead>
                            <tr>
                                <th scope="col" width="40">#</th>
                                <th scope="col">Código</th>                 
                                <th scope="col">Número de control</th>                 
                                <th scope="col">Tipo de documento</th>                 
                                <th scope="col">Fecha</th>                 
                                <th scope="col">Sello recibido</th>                 
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentos as $key => $item)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$item->codigo_generacion}}</td>
                            <td>{{$item->numero_control}}</td>
                            <td>{{$item->tipoDocumento->valor}}</td>
                            <td>{{$item->fecha}}</td>
                            <td>{{$item->sello_recibido}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
</x-app-layout>