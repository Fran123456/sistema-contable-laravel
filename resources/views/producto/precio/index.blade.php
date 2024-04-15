{{-- @extends('metronic.base')
@section('extracss')
@endsection
@section('extrajs')
@endsection

@section('titulo')
    Tipo de precios
@endsection

@section('content')
    {{-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Dashboard</a></li>

      <li class="breadcrumb-item active" aria-current="page">Tipo precios</li>
    </ol>
  </nav> --}}
{{-- 
    @include('sessions')
    {{-- <h3 style="text-align: center">Tipo de precios</h3> --}}
    {{-- <div class="card shadow-sm">
        <div class="card-body">
            <form method="post" action="{{ route('productoprecios.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Tipo precio</label>
                        <input type="text" name="tipo" class="form-control">
                    </div>
                    <div class="col-md-12 mt-1 mb-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div></div>
                    <a href="{{ route('producto.importarPreciosExcel') }}" class="btn btn-success"><i
                            class="fas fa-file-excel"></i>
                        Importar precios vía Excel</a>
                </div>
            </form>
            @if (count($data) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th scope="col" width="70">#</th>
                            <th scope="col">Tipo</th>
                            <th width="60">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <td> {{ $key + 1 }} </td>
                            <td>{{ $item->tipo }}</td>
                            <td>
                                <form method="post" action="{{ route('productoprecios.destroy', $item->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-danger">
                    <strong>¡Opps! Parece que no tienes ningun precio registrado.</strong>
                </div>
            @endif
        </div>
    </div>
@endsection
 --}} 

 <x-app-layout>
    <x-slot:title>
        Lista de precios
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Precios</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    
    <form method="post" action="{{ route('producto.precio.store') }}">
        <div class="row">
            @csrf
            <div class="col-md-6   mt-2 mb-21">
                <label for="">Tipo de precio</label>
                <input name="tipo" required type="text" class="form-control" required>
            </div>
            <input type="hidden" name="empresa_id" value={{$empresa}}>
            <div class="col-md-12 mb-3 mt-3">
                <button class="btn btn-primary mb-2" style="color:white;" type="submit"> <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> Precios </h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Precio</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($precios as $key => $item)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->tipo}}</td>
                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('producto.precio.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el precio?')"
                                            class="btn btn-danger"
                                            type="button" title="Eliminar"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>  
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>