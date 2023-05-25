<div class="row">
    <h5>Detalle de la partida</h5>
    <div class="col-md-5 mt-2">
        <label for=""> <strong>Cuenta contable</strong></label>
        <select name="cuenta" class="chosen-select form-control" id="">
            @foreach ($cuentas as $cuenta)
                @if ($cuenta->clasificacion != null)
                    <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} -
                        {{ $cuenta->nombre_cuenta }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-md-2 mt-2">
        <label for=""><strong>Debe</strong></label>
        <input value="0" name="debe" type="number" id="debe" step="0.01" min="0.00"
            class="form-control">
    </div>
    <div class="col-md-2 mt-2">
        <label for=""><strong>Haber</strong></label>
        <input value="0" name="haber" type="number" id="haber" step="0.01" min="0.00"
            class="form-control">
    </div>
    <div class="col-md-3 mt-2">
        <label for=""><strong>Fecha</strong></label>
        <input required value="@isset($partida){{  Help::dateByYear($partida->fecha_contable,'-') }}@endisset" name="fecha_detalle" type="date"
            class="form-control">
    </div>
    <div class="col-md-12 mt-3">
        <label for=""><strong>Concepto</strong></label>
        <textarea name="concepto_detalle" class="form-control" rows="10"></textarea>
    </div>
    <div class="col-md-12 mt-3">
        <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar </button>
    </div>
</div>

<script>
    $(document).ready(function(){
	$("input[name=haber]").change(function(){
         if($('#haber').val() > 0 ){
            $('#debe').prop('readonly', true);
         }else{
            $('#debe').prop('readonly', false);
         }
	});

    $("input[name=debe]").change(function(){
        if($('#debe').val() > 0 ){
            $('#haber').prop('readonly', true);
         }else{
            $('#haber').prop('readonly', false);
         }
	});

});
</script>
