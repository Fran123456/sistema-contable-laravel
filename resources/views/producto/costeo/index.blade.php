@extends('metronic.base')

@section('extracss')
@endsection

@section('extrajs')
@endsection

@section('titulo')
Costeo
@endsection

@section('content')

@include('sessions')
<br>
<h2 style="text-align: center">Costeo de la cotización {{ $inicial->codigo_cotizacion }}</h2>



<div class="">

    <div class="col-md-12">
       <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="" class="btn btn-primary">
                Cerrar costeo
            </a>
        </div>-->

        <div class="alert alert-danger" role="alert">
             Para poder hacer el costeo se le indica que los servicios seran los unicos que debera ingresar la información, productos y combos
             se calcularan en automatico, por favor validar información, cuando crea que todo esta correcto, proseguir a cerrar el costeo.
          </div>
    </div>

    <div class="col-md-12">
       @include('producto.costeo.encargado')
    </div>

    <div class="col-md-12 mt-3">
        @include('producto.costeo.costeo')
     </div>
</div>

@endsection
