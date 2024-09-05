<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Crear sub grupo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="crearform" action="{{ route('contabilidad.subGrupoResultado.store', ['utilidad_id' => $utilidad_id, 'grupo_id' => $grupo_id]) }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="sub_grupo">Sub grupo</label>
                        <input type="text" class="form-control" name="sub_grupo" id="sub_grupo" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 text-white">Guardar</button>
                </form>
            </div>

        </div>
    </div>
</div>