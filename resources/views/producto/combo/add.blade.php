@extends('metronic.base')
@section('extracss')
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('extrajs')
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script>
       $(document).ready(function() {
          $('select[name="producto"').select2();
          document.querySelector('select[name="producto"').parentElement.querySelector('span.select2-container').style.width="100%"
         });
   </script>
@endsection

@section('titulo')
    Combo - crear
@endsection


@section('content')
{{-- <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/producto/combos">Combos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar combo</li>
  </ol> --}}
    @include('sessions')
    <h2 style="text-align: center">Agregar combo con productos </h2>




    <div class="container-fluid">
        <div style="text-align: right;">
            <a href="/producto/combos/create" class="btn btn-primary" style="text-align: right">CREAR NUEVO COMBO</a>
        </div>
        {{-- <div class=" text-right">
            <a href="/producto/combos/create" class="btn btn-primary" style="text-align: right">CREAR NUEVO COMBO</a>
        </div> --}}
        <br>
        @include('producto.combo.form-store')
        <br>

        @include('producto.combo.precios')
        <br>

        @include('producto.combo.productos')
    </div>
@endsection
