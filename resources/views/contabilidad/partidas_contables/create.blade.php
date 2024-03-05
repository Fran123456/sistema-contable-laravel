<x-app-layout>
   <x-chosen></x-chosen>
   <x-slot:title>
       Crear partida contable
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contabilidad.partidas.index') }}">Partidas contables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear partida contable</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('contabilidad.partidas.store') }}" method="post">
                    @csrf
                    <h5>Partida contable</h5>
                    @include('contabilidad.partidas_contables.partials.create_cabecera')
                    <br>
                    @include('contabilidad.partidas_contables.partials.create_detalle')
                </form>
            </div>
        </div>
    </div>

    <script>
        function correlativo() {
            let periodo = $('#periodo').val();
            let tipo = $('#tipo').val();
            // Función que envía y recibe respuesta con AJAX
            $.ajax({
                type: 'GET', // Envío con método GET
                url: "{{ route('contabilidad.obtenerCorrelativoAjax') }}", // Fichero destino (el PHP que trata los datos)
                data: {
                    periodo: periodo,
                    tipo: tipo
                } // Datos que se envían
            }).done(function(msg) { // Función que se ejecuta si todo ha ido bien
                $('#correlativo').val(msg);

            }).fail(function(jqXHR, textStatus, errorThrown) { // Función que se ejecuta si algo ha ido mal
                // Mostramos en consola el mensaje con el error que se ha producido
                $("#consola").html("The following error occured: " + textStatus + " " + errorThrown);
            });
        }

        $(document).ready(function() {
            $("select[name=periodo]").change(function() {
                correlativo();
            });

        });

        $(document).ready(function() {
            $("select[name=tipo]").change(function() {
                correlativo();
            });

        });
    </script>

    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>

</x-app-layout>
