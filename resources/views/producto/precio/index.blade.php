@extends('metronic.base')
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

    @include('sessions')
    {{-- <h3 style="text-align: center">Tipo de precios</h3> --}}
    <div class="card shadow-sm">
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
