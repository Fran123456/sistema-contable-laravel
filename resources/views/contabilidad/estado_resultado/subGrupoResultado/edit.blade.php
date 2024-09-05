<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar sub grupo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="sub_grupo">Grupo</label>
                        <input type="text" class="form-control" name="sub_grupo" id="editsubgrupo" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 text-white">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.edit-button').on('click', function () {
        let id = $(this).data('id');
        let subGrupo = $(this).data('sub_grupo');
        let grupo_id = $(this).data('grupo_id');
        let utilidad_id = $(this).data('utilidad-id');

        // Llenar los campos del modal con los datos seleccionados
        $("#editsubgrupo").val(subGrupo);

        // Configurar la acción del formulario con la URL correcta
        $('#editForm').attr('action', '{{ route("contabilidad.subGrupoResultado.update", ["utilidad_id" => ":utilidad_id","grupo_id" => ":grupo_id", "id" => ":id"]) }}'
            .replace(':utilidad_id', utilidad_id)
            .replace(':grupo_id', grupo_id)
            .replace(':id', id));
    });
    });
</script>