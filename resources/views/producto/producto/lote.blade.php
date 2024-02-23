<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <form method="post" action="{{ route('producto.guardarLote', ['id' => $data?->id ?? 0]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for=""> <strong>Lote y más</strong> </label>


                        </div>
                        <div class="col-md-12 mt-3">
                            <label for=""><strong>Requiere lote</strong></label>
                            <select class="form-select" name="requiere_lote" id="requiere_lote">
                                @if ($data?->requiere_lote==1)
                                <option value="0">NO</option>
                                <option selected value="1">SI</option>
                                @else
                                <option selected value="0">NO</option>
                                <option value="1">SI</option>
                                @endif
                            </select>

                        </div>
                        <div class="col-md-12 mt-3">
                            <label for=""><strong>Requiere fecha vencimiento</strong></label>
                            <select class="form-select" name="requiere_vencimiento" id="requiere_vencimiento">
                                @if ($data?->requiere_vencimiento==1)
                                <option value="0">NO</option>
                                <option selected value="1">SI</option>
                                @else
                                <option selected value="0">NO</option>
                                <option value="1">SI</option>
                                @endif

                            </select>

                        </div>
                        <div class="col-md-12 mt-1 mb-3 mt-4">
                            <button type="submit" @if ($data?->id == null) disabled @endif
                                class="btn btn-primary"><i class='fas fa-check-circle'></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>


    </div>
</div>
