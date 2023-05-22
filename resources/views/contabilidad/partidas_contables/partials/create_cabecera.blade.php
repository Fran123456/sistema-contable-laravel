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
            @if (isset($periodos[0])) value="{{ $periodos[0]->tiposPartida()->first()->pivot->correlativo + 1 }}" @endif
            class="form-control" readonly>
    </div>

    <div class="col-md-12 mt-2 ">
        <label for=""> <strong>Concepto</strong></label>
        <textarea name="concepto_cabecera" class="form-control" rows="10"></textarea>

    </div>
</div>