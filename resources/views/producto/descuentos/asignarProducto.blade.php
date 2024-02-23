@extends('metronic.base')
@section('extracss')
@endsection
@section('extrajs')
@endsection

@section('titulo')
   Descuentos
@endsection

@section('content')


    @include('sessions')
    {{-- <h3 style="text-align: center">Tipo de precios</h3> --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Asignar descuento a productos  {{ $descuento->nombre }}</h3>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">



            <form method="POST" action="{{ route('descuento.asignarProductoPost') }}">
                @csrf
                <br>
                <div class="row">
                    <div class="col-md-6">
                            <label for="">Categorias</label>
                            <select required data-control="select2" multiple  class="form-control" name="cliente[]" id="">
                                @foreach ($clientes as $item)
                                    <option value="{{ $item->id }}"> {{ $item->categoria }}</option>
                                @endforeach
                            </select>
                    </div>
                    <input type="hidden" value="{{ $descuento->id }}" name="desc">

                </div>
                <br>
                <button type="submit" class="btn btn-primary">Asignar</button>

        </div>
    </div>
@endsection
