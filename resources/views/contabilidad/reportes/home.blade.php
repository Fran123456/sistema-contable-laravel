<x-app-layout>
<x-select2></x-select2>
<script>
$(document).ready(function(){
    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
});
</script>
<x-slot:title>
        Reportes contables
    </x-slot>

    <x-slot:subtitle>
        {{--Periodo {!! Help::periodoContable()?->codigo!!}  --}}
    </x-slot>


    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reportes contables</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="row">


        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Balance de comprobación</h5>
                    <button style="color:white" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#balance_comprobacion">
                        Generar
                    </button>
                </div>
            </div>
        </div>
        @include('contabilidad.reportes.modal.modal_balance_saldos')

        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Libro Diario Mayor</h5>
                    <button style="color:white" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#libro_mayor">
                        Generar
                    </button>
                </div>
            </div>
        </div>
        @include('contabilidad.reportes.modal.modal_libro_diario_mayor')

        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Libro diario</h5>
                    <button style="color:white" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#libro_diario">
                        Generar
                    </button>
                </div>
            </div>
        </div>
        @include('contabilidad.reportes.modal.modal_libro_diario')

        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Balance general</h5>
                    <button style="color:white" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#balance_general">
                        Generar
                    </button>
                </div>
            </div>
        </div>
        @include('contabilidad.reportes.modal.modal_balance_general')

        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Estado de resultados</h5>
                    <button style="color:white" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#estado_resultado">
                        Generar
                    </button>
                </div>
            </div>
        </div>
        @include('contabilidad.reportes.modal.modal_estado_resultado')


        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Saldo por cuenta</h5>
                    <button style="color:white" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#saldo_cuenta">
                        Generar
                    </button>
                </div>
            </div>
        </div>
        @include('contabilidad.reportes.modal.modal_saldo_cuenta')


        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listado de partidas </h5>
                    <button style="color:white" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#listado_partidas">
                        Generar
                    </button>
                </div>
            </div>
        </div>
        @include('contabilidad.reportes.modal.modal_listado_partidas')

    </div>



<script>
    $('.select2').each(function() {
        $(this).select2({ dropdownParent: $(this).parent()});
    })

</script>




</x-app-layout>
