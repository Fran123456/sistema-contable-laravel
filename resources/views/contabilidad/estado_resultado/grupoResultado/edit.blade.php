<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Utilidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT') <!-- Asegúrate de utilizar el método correcto -->
                    <div class="form-group">
                        <label for="grupo">Grupo</label>
                        <input type="text" class="form-control" name="grupo" id="editgrupo" required>
                    </div>
                    <div class="form-group">
                        <label for="signo">Signo</label>
                        <select name="signo" id="editsigno" class="form-control" required>
                            <option value="">Seleccione una opción</option>
                            <option value="+" {{ old('signo') == '+' ? 'selected' : '' }}>+</option>
                            <option value="-" {{ old('signo') == '-' ? 'selected' : '' }}>-</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 text-white">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modalEdit').on('click', function () {
            let id = $(this).data('id');
            let grupo = $(this).data('grupo');
            let signo = $(this).data('signo');
            let utilidad_id = $(this).data('utilidad-id');

            $("#editsigno").val(signo)
            $("#editgrupo").val(grupo)
            $('#editForm').attr('action', '{{ route("contabilidad.grupoResultado.update", ["utilidad_id" => ":utilidad_id", "id" => ":id"]) }}'
                .replace(':utilidad_id', utilidad_id)
                .replace(':id', id));
        });
    });
</script>
