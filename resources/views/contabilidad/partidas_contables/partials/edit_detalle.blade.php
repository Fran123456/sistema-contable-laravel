


<table class="table table-sm" id="detalles" >
    <thead>
        <tr>
            <th width="40" scope="col">#</th>
            <th scope="col" width="150">Codigo</th>
            <th scope="col" >Cuenta</th>
            <th scope="col">Concepto</th>
            <th class="text-center" scope="col">Debe</th>
            <th class="text-center" scope="col">Haber</th>
            <th class="text-center" scope="col" width="120">Fecha</th>
           
            <th width="50" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="4" scope="row"></th>  
            <td class="text-end"> <strong>{{ number_format($partida->debe,2) }}</strong> </td>
            <td class="text-end"> <strong>{{ number_format($partida->haber,2) }}</strong> </td>
            <th colspan="2" scope="row"></th> 
        </tr>
        @foreach ($partida->detalles as $key => $item)

            <tr class="  @if ($item->debe >0) table-danger @else table-success @endif">
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $item->cuentaContable->codigo }} </td>
                <td>{{ $item->cuentaContable->nombre_cuenta }} </td>
                <td>{{ $item->concepto }} </td>
                <td class="text-end">{{ number_format($item->debe,2) }} </td>
                <td class="text-end">{{ number_format($item->haber,2) }} </td>
                <td class="text-center">{{  Help::date($item->fecha_contable) }}</td>
                <td class="text-center">
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id}}"
                        class="btn btn-warning btn-edit" type="button">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td class="text-center">
                    <form id="form{{ $item->id }}"
                        action="{{ route('contabilidad.eliminarDetallePartida', $item->id) }}"
                        method="post">
                        @method('DELETE')
                        @csrf
                        <button
                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el detalle de la partida?')"
                            class="btn @if ($item->cerrada) btn-success @else btn-danger @endif "
                            type="button"><i class="fas fa-trash"></i></button>
                    </form>
                </td>

                <!-- Modal de editar -->
                <div class="modal fade" id="modalEditar{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar detalle partida</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- Datos del formulario --}}
                            <form action="{{ route('contabilidad.actualizarDetallePartida', $item->id) }}" method="POST">
                                @method('POST')
                                @csrf
                                <div class="col-md-12 mt-2">
                                    <label for="" class="row"> <strong>Cuenta contable</strong></label>
                                    <select name="cuenta" class="row chosen-select form-select" id="" data-dropdown-parent="#modalEditar{{ $item->id }}">
                                        @foreach ($cuentas as $cuenta)
                                        @if ($cuenta->clasificacion != null)
                                        <option value="{{ $cuenta->codigo }}" @if ($cuenta->codigo == $item->cuentaContable->codigo) selected @endif>
                                            {{ $cuenta->codigo }} - {{ $cuenta->nombre_cuenta }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for=""><strong>Concepto</strong></label>
                                    <input name="concepto_detalle" type="text" class="form-control" rows="10"
                                        value="{{ $item->concepto }}"></input>
                                </div>  
                                <div class="col-md-12 mt-2">
                                    <label for=""><strong>Debe</strong></label>
                                    <input name="debe" type="number" id="debe{{ $item->id }}" step="0.01" min="0.00"
                                        class="form-control"
                                        value="{{ $item->debe }}">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for=""><strong>Haber</strong></label>
                                    <input name="haber" type="number" id="haber" step="0.01" min="0.00"
                                        class="form-control"
                                        value="{{ $item->haber }}">
                                </div>

                                {{-- <div class="col-md-12 mt-2">
                                    <label for=""><strong>Fecha</strong></label>
                     <input required value="{{  Help::dateByYear($item->fecha_contable,'-') }}" name="fecha_detalle" id="fecha_detalle{{ $item->id}}" type="date"
                                             class="form-control">
                                    </div> --}}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">Modificar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </tr>
        @endforeach


    </tbody>
</table>


<script>
    $(document).ready(function() {
        // Manejadores de eventos para los campos "Debe" y "Haber" dentro de cada modal
        $('div[id^="modalEditar"]').each(function() {
            var modal = $(this);
            var debeInput = modal.find('input[name="debe"]');
            var haberInput = modal.find('input[name="haber"]');

            haberInput.on('input', function() {
                if ($(this).val() > 0) {
                    debeInput.prop('readonly', true);
                } else {
                    debeInput.prop('readonly', false);
                }
            });

            debeInput.on('input', function() {
                if ($(this).val() > 0) {
                    haberInput.prop('readonly', true);
                } else {
                    haberInput.prop('readonly', false);
                }
            });

            // Inicializa el estado de los campos cuando el modal se abre
            modal.on('shown.bs.modal', function() {
                if (haberInput.val() > 0) {
                    debeInput.prop('readonly', true);
                } else {
                    debeInput.prop('readonly', false);
                }

                if (debeInput.val() > 0) {
                    haberInput.prop('readonly', true);
                } else {
                    haberInput.prop('readonly', false);
                }
            });
        });
    });
</script>



<!-- CSS personalizado -->
<style>
    .chosen-container {
        width: 100% !important;
    }
    .chosen-container-single .chosen-single {
        height: calc(1.5em + .75rem + 2px);
        line-height: calc(1.5em + .75rem + 2px);
        border-radius: .25rem;
    }
    .chosen-container .chosen-results li.highlighted {
        background-color: #007bff; /* Color de fondo para el ítem seleccionado */
        color: #fff; /* Color de texto para el ítem seleccionado */
    }
    .chosen-container .chosen-results {
        max-height: 200px; /* Altura máxima del dropdown */
        overflow-y: auto; /* Scroll en caso de que la lista sea larga */
    }
</style>

<script>
    $(document).ready(function() {
        $("#periodo").change(function() {
            obtenerUltimoDiaDelMes();
        });
    });

    
    function obtenerUltimoDiaDelMes() {
        var codigo = $('#periodo option:selected').html();
        var f = codigo.substring(2, 6)+'-'+codigo.substring(0, 2) +"-01";//fecha inicial
        var ff = codigo.substring(2, 6)+'-'+codigo.substring(0, 2) +"-01 00:00:00"; //fecha inicial con hora
        const fechaFin = new Date(ff);
        let final = new Date(fechaFin.getFullYear(), fechaFin.getMonth() + 1, 0);
        const mes = final.getMonth() + 1;
        const dia = final.getDate();
        const formateadafinal  =  `${final.getFullYear()}-${(mes < 10 ? '0' : '').concat(mes)}-${(dia < 10 ? '0' : '').concat(dia)}`;

        var fechaActual = new Date(ff); // Fecha actual
        var ultimoDiaDelMes = formateadafinal;
        var dateInput = $("#fecha");
        dateInput.prop('max', ultimoDiaDelMes);
        dateInput.prop('min', f);
       // dateInput.prop('value', f);

        var dateInput2 = $("#fecha_detalle");
        dateInput2.prop('max', ultimoDiaDelMes);
        dateInput2.prop('min', f);
       // dateInput2.prop('value', f);
        dateInput2.val($("#fecha").val());
        var dateInput3 = $("#fecha_detalle{{ $item->id}}");
        dateInput3.prop('max', ultimoDiaDelMes);
        dateInput3.prop('min', f);
        alert("2")
    }

</script>

<!-- Inicialización de Chosen -->
<script>
    $(document).ready(function() {
        $('#modalEditar{{ $item->id }}').on('shown.bs.modal', function () {
            $('.chosen-select').chosen({
                width: '100%'
            });
            obtenerUltimoDiaDelMes();

        });
    });
</script>