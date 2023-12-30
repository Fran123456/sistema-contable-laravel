<x-app-layout>
    <x-chosen></x-chosen>
    <x-slot:title>
        Editar partida contable
     </x-slot>

     <x-slot:subtitle>
     </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="/contabilidad/partidas">Partidas contables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar partida contable</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 mb-2 text-end">
        <form id="partida{{ $partida->id }}"
            action="{{ route('contabilidad.cerrarPartida', $partida->id) }}"
            method="get">
            <button
                onclick="confirm('partida{{ $partida->id }}','¿Desea cerrar la partida?')"
                class="btn btn-danger "
                type="button">CERRAR PARTIDA</button>
        </form>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('contabilidad.partidas.update', $partida->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <h5>Partida contable:  {{ Help::codigoPartida($partida)  }} </h5>
                    <hr>

                    @include('contabilidad.partidas_contables.partials.edit_cabecera')
                </form>

                <br>
                 <form action="{{route('contabilidad.partidas.update', $partida->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="detalle" value="detalle">
                    @include('contabilidad.partidas_contables.partials.create_detalle')
                 </form>
                <hr>

                @include('contabilidad.partidas_contables.partials.edit_detalle')
            </div>
        </div>
    </div>



    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>

</x-app-layout>
