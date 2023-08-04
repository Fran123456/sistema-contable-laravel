<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="libro_diario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">REPORTE LIBRO DIARIO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <form action="{{ route('contabilidad.reporteLibroDiario') }}" method="get" target="_blank">
            <div class="row">
              <div class="col-md-12">
                <LABEL>Fecha inicio</LABEL>
                <input type="date" name="fechai" class="form-control">
              </div>

              <div class="col-md-12 mt-3">
                <LABEL>Fecha fin</LABEL>
                <input type="date" name="fechaf" class="form-control">
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
