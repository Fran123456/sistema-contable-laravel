<x-app-layout>
    <x-slot:title>
    Configuración de contabilidad
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configuración</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> {{ $titulo }} </h5>
                <form action="{{ route('contabilidad.configuracion')}}" method="get" >
                    <select name="valor" class="form-control" id="">
                        <option value="balance">balance</option>
                        <option value="general">general</option>
                    </select>
                    <button type="submit" class="btn btn-success mt-2">Cargar</button>
                </form>
                <br>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre cuenta</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Grupo</th>                            
                            <th scope="col" class="text-center"><i class="fas fa-edit"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item?->cuenta?->nombre_cuenta}}</td>
                                <td>{{$item->balance}}</td>
                                <td>{{$item->grupo}}</td>
                                <td><a href="{{route('contabilidad.editarConfiguracion', $item->id)}}" class="btn btn-warning" title="Editar"><i class="fas fa-edit"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
