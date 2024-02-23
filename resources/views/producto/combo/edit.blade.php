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
    Combo - editar
@endsection


@section('content')
{{-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="/producto/combos">Combos</a></li>
      <li class="breadcrumb-item active" aria-current="page">Editar combo</li>
    </ol>
  </nav> --}}
    @include('sessions')
    <h3 style="text-align: center">Edita el combo: {{ $data->combo }} </h3>


    <div class="container-fluid">
        @include('producto.combo.form-edit')
        <br>
        @include('producto.combo.precios')
        <br>
        @include('producto.combo.productos')
    </div>
@endsection
