<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

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

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('contabilidad.partidas.update', $partida->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <h5>Partida contable: {{ $partida->tipoPartida->tipo  }} {{ $partida->periodo->codigo }}</h5>

                    <a href="{{ route('contabilidad.cerrarPartida', $partida->id) }}" class="btn btn-danger">CERRAR PARTIDA</a>
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
