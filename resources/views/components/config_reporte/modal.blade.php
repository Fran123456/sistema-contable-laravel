<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="rpt{{ $r->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $r->reporte }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div class="row">
             @foreach ($r->campos as $campo)
                 
             @include('components.config_reporte.campos')

             @endforeach
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button style="color: white" type="button" class="btn btn-primary">PDF</button>
          <button style="color: white" type="button" class="btn btn-primary">EXCEL</button>
        </div>
      </div>
    </div>
  </div>