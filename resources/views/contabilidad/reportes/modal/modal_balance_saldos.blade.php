<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="balance_comprobacion" tabindex="-1"  aria-labelledby="balance_comprobacion" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">BALANCE DE COMPROBACIÓN</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <form action="{{ route('contabilidad.reporteBalanceComprobacion') }}" method="get" target="_blank">
            <div class="row">

              <div class="col-md-12 mt-2">
                <label for="">Cuenta inicio</label>
                <select class="form-control select2" style="width: 100%" name="cuentai" id="">
                  @foreach ($cuentas as $item)
                      <option value="{{ $item->id }}">{{ $item->codigo }} {{ $item->nombre_cuenta }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12 mt-2">
                <label for="">Cuenta final</label>
                <select class="form-control select2" style="width: 100%" name="cuentaf" id="">
                  @foreach ($cuentas as $item)
                      <option value="{{ $item->id }}">{{ $item->codigo }} {{ $item->nombre_cuenta }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12 mt-3">
                <LABEL>Fecha inicio</LABEL>
                <input type="date" required name="fechai" class="form-control">
              </div>

              <div class="col-md-12 mt-3">
                <LABEL>Fecha fin</LABEL>
                <input type="date" required name="fechaf" class="form-control">
              </div>



              <div class="col-md-12">
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <input class="btn btn-primary" style="color: white" type="submit" name="excel" value="excel">

                  <input class="btn btn-primary" style="color: white" type="submit" name="pdf" value="PDF">

                </div>
              </div>
             </div>
           </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    //$.fn.modal.Constructor.prototype.enforceFocus = function() {};

    /* $(document).ready(function() {
        $('.select22').select2(
           {
            dropdownParent: $('#balance_comprobacion .modal-content')
           }
        );
    });*/
   </script>
