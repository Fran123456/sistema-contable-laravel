<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Crear cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="crearform" action="{{ route('contabilidad.cuentaResultado.store', ['utilidad_id' => $utilidadSeleccionada->id, 'grupo_id' => $grupo->id, $subGrupo->id]) }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="sub_grupo">Cuentas contables</label>
                        <select name="cuenta_id" id="cuenta_id" class="form-control" required>
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