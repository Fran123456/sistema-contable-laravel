<div class="row">
    <div class="col-md-3 mt-2">
        <label for=""> <strong>Periodo</strong></label>
        <select class="form-control" id="periodo"  name="" readonly id="">
            <option value="">{{  $partida->periodo->codigo  }}</option>
        </select>
     <!--   <input type="text" class="form-control" id="periodo"  readonly value="{{ $partida->periodo->codigo }}">-->
    </div>

    <div class="col-md-3 mt-2">
        <label for=""> <strong>Tipo de partida</strong></label>
        <input type="text" class="form-control" readonly value="{{ $partida->tipoPartida->tipo }}">
    </div>

    <div class="col-md-3 mt-2">
        <label for=""> <strong>Fecha  </strong></label>
        <input required type="date" class="form-control"id="fecha"
        value="{{Help::dateByYear($partida->fecha_contable,'-')}}" name="fecha">
    </div>


    <div class="col-md-3 mt-2">
        <label for=""> <strong>Correlativo</strong></label>
        <input type="text" name="correlativo" id="correlativo" value="{{ $partida->correlativo }}"
            class="form-control" readonly>
    </div>

    <div class="col-md-12 mt-2 ">
        <label for=""> <strong>Concepto</strong></label>
        <textarea name="concepto_cabecera" class="form-control" rows="10">{{ $partida->concepto }}</textarea>

    </div>
    <div class="col-md-12 mt-3">
        <button class="btn btn-warning" type="submit"><i class="fas fa-edit"></i></button>
    </div>
</div>
