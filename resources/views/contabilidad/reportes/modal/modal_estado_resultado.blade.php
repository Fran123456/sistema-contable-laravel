
<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="estado_resultado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">REPORTE ESTADO DE RESULTADO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <form action="{{route('contabilidad.reporteEstadoResultadoNuevo')}}" method="get" target="_blank">
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
                  <button style="color: white" type="submit" class="btn btn-primary" name="formato" value="pdf">PDF</button>
                  <button style="color: white" type="submit" class="btn btn-primary" name="formato" value="excel">EXCEL</button>
                </div>
              </div>
             </div>
           </form>
        </div>
      </div>
    </div>
  </div>
