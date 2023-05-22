<div class="row">
    <h5>Detalle de la partida</h5>
    <div class="col-md-4 mt-2">
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
    <div class="col-md-4 mt-2">
        <label for=""><strong>Debe</strong></label>
        <input value="0" name="debe" type="number" step="0.01" min="0.00"
            class="form-control">
    </div>
    <div class="col-md-4 mt-2">
        <label for=""><strong>Haber</strong></label>
        <input value="0" name="haber" type="number" step="0.01" min="0.00"
            class="form-control">
    </div>
    <div class="col-md-12 mt-3">
        <label for=""><strong>Concepto</strong></label>
        <textarea name="concepto" class="form-control" rows="10"></textarea>
    </div>
    <div class="col-md-12 mt-3">
        <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar </button>
    </div>
</div>