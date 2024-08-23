<x-app-layout>
    <x-slot:title>
        Configuración Rubro General
        </x-slot>
        <x-slot:subtitle>
            </x-slot>

            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Configuración Rubro General</li>
                </ol>
            </div>
            <div class="col-md-12">
                <x-alert></x-alert>
            </div>

            <div class="col-md-12">
                <form action="{{ route('contabilidad.rubros.index') }}" method="get">
                    <div class="row">
                    </div>
                </form>
                <br>
            </div>

            <div class="col-md-12 text-end mb-4">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createRubroModal" title="Agregar Rubro">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Rubros</h5>
                        <table class="table table-sm" id="datatable-responsive">
                            <thead>
                                <tr>
                                    <th scope="col" width="40">#</th>
                                    <th scope="col">Rubro</th>
                                    <th scope="col">Signo</th>
                                    <th scope="col" width="160px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rubros as $key => $rubro)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $rubro->rubro }}</td>
                                    <td>{{ $rubro->signo }}</td>

                                    <td class="text-center">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editRubroModal{{ $rubro->id }}" title="Editar">
                                            <i class="fa-solid fa-pen-to-square text-success"></i>
                                        </a>

                                        <form id="form{{ $rubro->id }}" action="{{ route('contabilidad.rubros.destroy', $rubro->id) }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" onclick="confirmDelete('form{{ $rubro->id }}', '¿Desea eliminar el rubro?');" title="Eliminar" class="btn btn-link p-0">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal para editar rubro -->
                                <div class="modal fade" id="editRubroModal{{ $rubro->id }}" tabindex="-1" aria-labelledby="editRubroModalLabel{{ $rubro->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editRubroModalLabel{{ $rubro->id }}">Editar Rubro</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('contabilidad.rubros.update', $rubro->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="rubro" class="form-label">Rubro</label>
                                                        <input type="text" class="form-control" id="rubro" name="rubro" value="{{ $rubro->rubro }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="signo" class="form-label">Signo</label>
                                                        <select class="form-select" id="signo" name="signo" required>
                                                            <option value="+" {{ $rubro->signo == '+' ? 'selected' : '' }}>+</option>
                                                            <option value="-" {{ $rubro->signo == '-' ? 'selected' : '' }}>-</option>
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

            <div class="modal fade" id="createRubroModal" tabindex="-1" aria-labelledby="createRubroModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createRubroModalLabel">Agregar Rubro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('contabilidad.rubros.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="rubro" class="form-label">Rubro</label>
                                    <input type="text" class="form-control" id="rubro" name="rubro" required>
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
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(formId).submit();
                        }
                    });
                }
            </script>
</x-app-layout>