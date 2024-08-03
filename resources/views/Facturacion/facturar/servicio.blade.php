<div class="row">
 <div class="col-md-12">
    <h5>Servicio: {{ $itemObj->nombre }}</h5>
    <h6>Codigo: {{ $itemObj->codigo }} </h6>

 </div>
 <div class="col-md-12">
    <form action="{{ route('facturacion.postItemsFactura') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mt-2">
                <label for=""> <strong>Precio (modificable)</strong> </label>
                <input required type="number" step="0.01" name="precio" class="form-control"  id="precioInput">
            </div>
            <div class="col-md-6 mt-2">
                <label for=""> <strong>Cantidad</strong> </label>
                <input required type="number" step="1" min="1" value="1" name="cantidad" class="form-control">
            </div>
            @if ($ov->documentos[0]->tipoDocumento?->id ==1 || $ov->documentos[0]->tipoDocumento?->id ==2)
            <div class="col-md-12 mt-2">
                <label for="S"> <strong>Iva</strong> </label>
                <select name="iva" id=""  class="form-control">
                  <option value="1" >SI</option>
                  <option value="0">NO</option>
                </select>
             </div>
            @endif

            <div class="col-md-6 mt-2">
                <label for=""><strong>Tipo descuento</strong></label>
                <select required class="form-control" name="tipo_descuento" id="tipo_descuento">
                    <option value="0">Sin descuento</option>
                    <option value="$">Cantidad en $</option>
                    <option value="%">Porcentaje %</option>
                </select>
            </div>
            
            <div class="col-md-6 mt-2">
                <strong><label for="" id="descuento_label">Descuento</label></strong>
                <input required class="form-control" type="number" value="0" step="0.01" name="descuento" id="descuento" min="0.01">
            </div>
            <input type="hidden" value="{{ $ov->documentos[0]->id }}" name="doc_id">
            <input type="hidden" value="{{ $ov->cliente_id }}" name="cliente_id">
            <input type="hidden" value="{{ $ov->id }}" name="facturacion_id">
            <input type="hidden" value="{{ $tipo }}" name="tipo">
            <input type="hidden" value="{{ $itemObj->id }}" name="itemId">
            <div class="col-md-12 mt-2 text-end">
                <button type="submit" class="btn btn-success">Agrgear</button>
            </div>
        </div>
     </form>
 </div>
</div>
<script src="{{ asset('assets/js/facturarIndividual.js') }}"></script>