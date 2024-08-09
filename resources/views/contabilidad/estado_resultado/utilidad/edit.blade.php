
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Utilidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <div class="form-group">
                        <label for="utilidad">Utilidad</label>
                        <input type="text" class="form-control" id="utilidadEdit" name="utilidad" required>
                        <input type="hidden" class="form-control" id="id" name="id">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                </form>
            </div>

        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: `/contabilidad/utilidades/${id}`,
                    method: 'GET',
                    success: function(data) {
                        $('#utilidadEdit').val(data.utilidad);
                        $('#id').val(id);
                    },
                    error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);

                    }
                });
            });

            $('#editForm').on('submit', function(event) {
            event.preventDefault();
            let id = $('#id').val();
            $.ajax({
                url: `/contabilidad/utilidades/${id}`,
                method: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        // Redireccionar a la página del índice
                        window.location.href = "{{ route('contabilidad.utilidades.create') }}";
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al modificar utilidad:', error);
                }
            });
            });
        });
    </script>