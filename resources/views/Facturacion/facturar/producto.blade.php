<div class="row">
    <div class="col-md-4">
        <h5>producto: {{ $itemObj->producto }}</h5>
        <h6>Codigo: {{ $itemObj->codigo }} </h6>
        <p>
            @if ($itemObj->imagen == null)
                 <img src="/assets/images/notfound.png" alt="">
            @endif
        </p>

       
    </div>
    <div class="col-md-8">
       <form action="{{ route('facturacion.postItemsFactura') }}" method="post">
        @csrf
         <div class="row">
            <div class="col-md-12">
                <label for=""><strong>Precios</strong></label>
                <select required class="form-select" name="precios" id="preciosSelect">
                    <option selected disabled value="">Seleccione...</option>
                    @foreach ( $itemObj->tiposPrecios as $pre)
                        <option value="{{ $pre->id }}"> {{ $pre->tipo }} ${{ number_format($pre->pivot->precio ,2)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mt-2">
                <label for=""> <strong>Precio (modificable)</strong> </label>
                <input required type="number" step="0.01" name="precio" class="form-control"  id="precioInput">
            </div>
            <div class="col-md-6 mt-2">
                <label for=""> <strong>Cantidad</strong> </label>
                <input required type="number" step="1" min="1" value="1" name="cantidad" class="form-control">
            </div>
            
            
            @if ($ov->documentos[0]->tipoDocumento?->id ==1 || $ov->documentos[0]->tipoDocumento?->id ==3)
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

            <div class="col-md-6 mt-2 mr-4 ml-4">
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="sujeto">
                <label class="form-check-label" for="flexCheckDefault">
                  <strong>Venta no sujeta</strong>
                </label>
              </div>
            <div class="col-md-12 mt-2 text-end">
                <button type="submit" class="btn btn-success">Agregar</button>
            </div>

            <input type="hidden" name="sugerido" id="sugerido" value="0">
            <input type="hidden" value="{{ $ov->documentos[0]->id }}" name="doc_id">
            <input type="hidden" value="{{ $ov->cliente_id }}" name="cliente_id">
            <input type="hidden" value="{{ $ov->id }}" name="facturacion_id">
            <input type="hidden" value="{{ $tipo }}" name="tipo">
            <input type="hidden" value="{{ $itemObj->id }}" name="itemId">
         </div>
       </form>
    </div>
</div>


<script>
    // Obtener el select y el input por su ID
    const preciosSelect = document.getElementById('preciosSelect');
    const precioInput = document.getElementById('precioInput');
    const sug = document.getElementById('sugerido');
    // Agregar un evento de cambio al select
    preciosSelect.addEventListener('change', function() {
        // Obtener el valor del option seleccionado
        const selectedOption = this.options[this.selectedIndex];
        const selectedText = selectedOption.text.split('$')[1]; // Obtener solo el precio
        // Actualizar el valor del input con el precio
        precioInput.value = parseFloat(selectedText);
        sug.value = parseFloat(selectedText);
    });
</script>
<script src="{{ asset('assets/js/facturarIndividual.js') }}"></script>