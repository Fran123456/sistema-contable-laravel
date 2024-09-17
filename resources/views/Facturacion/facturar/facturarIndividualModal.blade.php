<!-- Modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-2 text-end" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color:white">
    Facturar documento
  </button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Facturar documento</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('facturacion.facturar') }}" method="post">
        <div class="modal-body text-start">
         @csrf
             <div>
                <label for=""> <strong>Fecha</strong> </label>
                <input type="date" required name="fecha_facturar" type="fecha" class="form-control">
             </div>
             <br>
             <!-- <div>
                <label for=""> <strong>Agregar a Libro</strong> </label>
                <select name="agregar" id="" class="form-control">
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
             </div> -->
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" style="color:white">Facturar</button>
        </div>

 
            <input type="hidden" value="{{ $ov->documentos[0]->id }}" name="doc">
            <input type="hidden" value="{{ $ov->cliente_id }}" name="cliente">
            <input type="hidden" value="{{ $ov->id }}" name="facturacion">
    </form>
      </div>
    </div>
  </div>