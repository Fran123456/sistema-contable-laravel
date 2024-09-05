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
                        <label for="sub_grupo">Cuentas contables</label>
                        <select name="cuenta_id" id="editcuenta_id" class="form-control" required>
                            <option value="">Seleccione una ópcion</option>
                            @foreach ($cuentasContables as $item)
                                <option value="{{$item->id}}">{{$item->codigo}} - {{$item->nombre_cuenta}}</option>
                            @endforeach
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
        $('.edit-button').on('click', function () {
            let id = $(this).data('id');
            let subGrupo_id = $(this).data('sub_grupo_id');
            let grupo_id = $(this).data('grupo_id');
            let utilidad_id = $(this).data('utilidad-id');
            let cuenta_id = $(this).data('cuenta-id');
            // alert(subGrupo_id)

        // Llenar los campos del modal con los datos seleccionados
        $("#editcuenta_id").val(cuenta_id);

        // Configurar la acción del formulario con la URL correcta
        $('#editForm').attr('action', '{{ route("contabilidad.cuentaResultado.update", ["utilidad_id" => ":utilidad_id","grupo_id" => ":grupo_id", "sub_grupo_id" => ":sub_grupo_id", "id" => ":id"]) }}'
            .replace(':utilidad_id', utilidad_id)
            .replace(':grupo_id', grupo_id)
            .replace(':sub_grupo_id', subGrupo_id)
            .replace(':id', id));
    });
    });
</script>