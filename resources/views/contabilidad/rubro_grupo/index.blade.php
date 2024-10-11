<x-app-layout>
    <x-slot:title>
        Grupos para el Rubro: {{ $rubro->rubro }}
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contabilidad.rubros.index') }}">Rubros</a></li>
            <li class="breadcrumb-item active" aria-current="page">Grupos</li>
        </ol>
    </div>
    
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createGrupoModal" title="Agregar Grupo">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Grupos del Rubro: {{ $rubro->rubro }}</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Signo</th>
                            <th scope="col" width="160px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grupos as $key => $grupo)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $grupo->grupo }}</td>
                            <td>{{ $grupo->signo }}</td>
                            <td class="text-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editGrupoModal{{ $grupo->id }}" title="Editar">
                                    <i class="fa-solid fa-pen-to-square text-success"></i>
                                </a>

                                <a href="{{ route('contabilidad.grupo.cuentaContable.index', ['rubro' => $rubro->id, 'grupo' => $grupo->id]) }}" title="cuentasContable">
                                    <i class="fa-solid fa-tags text-primary"></i>
                                </a>

                                <form id="form{{ $grupo->id }}" action="{{ route('contabilidad.grupos.destroy', $grupo->id) }}" method="post" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" onclick="confirmDelete('form{{ $grupo->id }}', '¿Desea eliminar el grupo?');" title="Eliminar" class="btn btn-link p-0">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                        <!-- Modal para editar grupo -->
                        <div class="modal fade" id="editGrupoModal{{ $grupo->id }}" tabindex="-1" aria-labelledby="editGrupoModalLabel{{ $grupo->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editGrupoModalLabel{{ $grupo->id }}">Editar Grupo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('contabilidad.grupos.update', $grupo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="grupo" class="form-label">Grupo</label>
                                                <input type="text" class="form-control" id="grupo" name="grupo" value="{{ $grupo->grupo }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="signo" class="form-label">Signo</label>
                                                <select class="form-select" id="signo" name="signo" required>
                                                    <option value="+" {{ $grupo->signo == '+' ? 'selected' : '' }}>+</option>
                                                    <option value="-" {{ $grupo->signo == '-' ? 'selected' : '' }}>-</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para crear grupo -->
    <div class="modal fade" id="createGrupoModal" tabindex="-1" aria-labelledby="createGrupoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGrupoModalLabel">Agregar Grupo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('contabilidad.grupos.store', $rubro->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="grupo" class="form-label">Grupo</label>
                            <input type="text" class="form-control" id="grupo" name="grupo" required>
                        </div>
                        <div class="mb-3">
                            <label for="signo" class="form-label">Signo</label>
                            <select class="form-select" id="signo" name="signo" required>
                                <option value="+">+</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(formId, message) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
</x-app-layout>
