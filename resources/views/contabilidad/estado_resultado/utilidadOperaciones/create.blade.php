
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Crear Utilidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="crearform" action="{{ route('contabilidad.utilidadOperaciones.store',['utilidad_id'=>$utilidad_id]) }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="utilidad_operar_id">Operación</label>
                        <select name="utilidad_operar_id" id="utilidad_operar_id" class="form-control" required>
                            <option value="">Seleccione una opcion</option>
                            @foreach ($utilidades as $item)
                                <option value="{{$item->id}}">{{$item->utilidad}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="signo">Signo</label>
                        <select name="signo" id="signo" class="form-control" required>
                            <option value="">Seleccione una opación</option>
                            <option value="+">+</option>
                            <option value="-">-</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 text-white">Guardar</button>
                </form>
            </div>

        </div>
    </div>
</div>
