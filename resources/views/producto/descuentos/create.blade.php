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


            <h1>Crear Nuevo Descuento</h1>
            <form method="POST" action="{{ route('descuentos.store') }}">
                @csrf
                <br>
                <div class="">
                    <div class="form-group">
                        <label for="porcentaje">Nombre:</label>
                        <input type="text" required class="form-control" name="nombre" id="porcentaje">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="porcentaje">Porcentaje:</label>
                        <input type="text" class="form-control" name="porcentaje" id="porcentaje">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="dinero">Efectivo:</label>
                        <input type="text" class="form-control" name="dinero" id="dinero">
                    </div>
                    <br>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="activo" id="activo">
                        <label class="form-check-label" for="activo">Activo</label>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="fechai">Fecha Inicio:</label>
                        <input type="date" class="form-control" name="fechai" id="fechai">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="fechaf">Fecha Fin:</label>
                        <input type="date" class="form-control" name="fechaf" id="fechaf">
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Crear Descuento</button>

        </div>
    </div>
@endsection
