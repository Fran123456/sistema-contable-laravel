<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

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
        <input required type="date"  class="form-control" id="fecha" name="fecha">
    </div>


    <div class="col-md-3 mt-2">
        <label for=""> <strong>Correlativo</strong></label>
        <input type="text" name="correlativo" id="correlativo"
            @if (isset($periodos[0])) value="{{ $periodos[0]->tiposPartida()->first()->pivot->correlativo + 1 }}" @endif
            class="form-control" readonly>
    </div>

    <div class="col-md-12 mt-2 ">
        <label for=""> <strong>Concepto</strong></label>
        <textarea name="concepto_cabecera" class="form-control" rows="10"></textarea>

    </div>
</div>
<script>
        $(document).ready(function() {
            $("#periodo").change(function() {
                obtenerUltimoDiaDelMes();
            });
        });

        obtenerUltimoDiaDelMes();
    
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
            console.log(ultimoDiaDelMes)
            dateInput.prop('max', ultimoDiaDelMes);
            dateInput.prop('min', f);
            dateInput.prop('value', f);
            dateInput.prop('max', ultimoDiaDelMes);
        }
        
        
      
</script>