<!-- Modal -->
<div class="modal fade" id="incapacidades_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">INCAPACIDADES REPORTES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{-- route('contabilidad.libroDiarioMayor') --}}" method="get" target="_Blank">
                    <div class="row">

                        <div class="col-md-12 mt-2 mb-12">
                            <label class="float-start">Incapacidad</LABEL>
                            <select class="chosen-select form-select" name="id_incapacidad" id="id_incapacidad">
                                @foreach ($periodos as $key => $item)
                                    @if ( $item->activo === 1)
                                        <option value="{{ $item->id }}">{{ $item->mes_string }} - {{ $item->year }} {{ $item->tipo_periodo }} {{ $item->periodo_dias }}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input class="btn btn-primary" style="color: white" type="submit" name="excel"
                                    value="excel">
                                <input class="btn btn-primary" style="color: white" type="submit" name="pdf"
                                    value="PDF">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
