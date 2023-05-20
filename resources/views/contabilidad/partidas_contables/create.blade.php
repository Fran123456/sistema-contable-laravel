<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Partida contable</h5>

                <div class="row">
                    <div class="col-md-3 mt-2">
                        <label for=""> <strong>Periodo</strong></label>
                        <select required id="periodo" name="periodo" class="form-control" id="">
                            @foreach ($periodos as $p)
                                <option value="{{ $p->id }}">{{ $p->codigo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mt-2">
                        <label for=""> <strong>Tipo de partida</strong></label>
                        <select required id="tipo" name="tipo" class="form-control" id="">
                            @foreach ($tipos as $t)
                                <option value="{{ $t->id }}">{{ $t->tipo }} - {{ $t->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mt-2">
                        <label for=""> <strong>Fecha</strong></label>
                        <input required type="date" class="form-control" name="fecha">
                    </div>


                    <div class="col-md-3 mt-2">
                        <label for=""> <strong>Correlativo</strong></label>
                        <input type="text" name="correlativo" id="correlativo"
                            @if (isset($periodos[0])) value="{{ $periodos[0]->tiposPartida()->first()->pivot->correlativo +1 }}" @endif
                            class="form-control" readonly>
                    </div>

                    <div class="col-md-12 mt-2 ">
                        <label for=""> <strong>Concepto</strong></label>
                        <textarea name="concepto" class="form-control" rows="10"></textarea>

                    </div>
                </div>
 <br>
                 <form action="">
                    <div class="row">
                        <h5>Detalle de la partida</h5>
                        <div class="col-md-4 mt-2">
                            <label for=""> <strong>Cuenta contable</strong></label>
                            <select name="cuenta" class="chosen-select form-control" id="">
                             @foreach ($cuentas as $cuenta)
                                 @if ($cuenta->clasificacion != null)
                                 <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->nombre_cuenta }}</option>
                                 @endif
                             @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for=""><strong>Debe</strong></label>
                            <input value="0" name="debe" type="number" step="0.01" min="0.01" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for=""><strong>Haber</strong></label>
                            <input value="0" name="haber" type="number" step="0.01" min="0.01" class="form-control">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for=""><strong>Concepto</strong></label>
                            <textarea name="concepto" class="form-control" rows="10"></textarea>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar </button>
                        </div>
                    </div>
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
                $('#correlativo').val( (int)msg.pivot.correlativo + 1);

            }).fail(function(jqXHR, textStatus, errorThrown) { // Función que se ejecuta si algo ha ido mal
                // Mostramos en consola el mensaje con el error que se ha producido
                $("#consola").html("The following error occured: " + textStatus + " " + errorThrown);
            });
        }

        $(document).ready(function() {
            $("select[name=periodo]").change(function() {
                correlativo();
                //$('input[name=periodo]').val($(this).val());
            });

        });

        $(document).ready(function() {
            $("select[name=tipo]").change(function() {
                correlativo();
                //$('input[name=periodo]').val($(this).val());
            });

        });
    </script>

<script>
    $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
    })
</script>

</x-app-layout>
