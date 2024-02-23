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
        <div class="card-body">


            <h1>Editar Descuento</h1>

            <form method="POST" action="{{ route('descuentos.update', $pro_descuento->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group mt-3">
                    <label for="porcentaje">Nombre:</label>
                    <input type="text" required class="form-control" name="nombre" id="nombre" value="{{ $pro_descuento->nombre }}">
                </div>
                <div class="form-group mt-3">
                    <label for="porcentaje">Porcentaje:</label>
                    <input type="text" class="form-control" name="porcentaje" id="porcentaje" value="{{ $pro_descuento->porcentaje }}">
                </div>
                <div class="form-group mt-3">
                    <label for="dinero">Dinero:</label>
                    <input type="text" class="form-control" name="dinero" id="dinero" value="{{ $pro_descuento->dinero }}">
                </div>
                <div class="form-group form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="activo" id="activo" {{ $pro_descuento->activo ? 'checked' : '' }}>
                    <label class="form-check-label" for="activo">Activo</label>
                </div>
                <div class="form-group mt-3">
                    <label for="fechai">Fecha Inicio:</label>
                    <input type="date" class="form-control" name="fechai" id="fechai" value="{{ $pro_descuento->fechai }}">
                </div>
                <div class="form-group mt-3">
                    <label for="fechaf">Fecha Fin:</label>
                    <input type="date" class="form-control" name="fechaf" id="fechaf" value="{{ $pro_descuento->fechaf }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Actualizar Descuento</button>
            </form>

        </div>
    </div>
@endsection
