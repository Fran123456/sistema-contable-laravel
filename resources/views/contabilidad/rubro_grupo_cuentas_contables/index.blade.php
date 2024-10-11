<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <x-slot:title>
        Cuentas Contables Asociadas
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contabilidad.rubros.index') }}">Rubros</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contabilidad.rubros.index') }}">Grupos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cuenta Contable Asociadas</li>

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
                <h5>Cuentas Contables Asociadas</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Cuenta Contable</th>
                            <th scope="col">Numero Cuenta</th>
                            <th scope="col">Signo</th>
                            <th scope="col">Saldo</th>
                            <th scope="col" width="160px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rubroCuentas as $key => $rubroCuenta)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $rubroCuenta->cuenta->codigo }} - {{ $rubroCuenta->cuenta->nombre_cuenta }}</td>
                                <td>{{ $rubroCuenta->numero_cuenta }}</td>
                                <td>{{ $rubroCuenta->signo }}</td>
                                <td>{{ $rubroCuenta->saldo }}</td>
                                <td class="text-center">
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#editGrupoModal{{ $rubroCuenta->id }}" title="Editar">
                                        <i class="fa-solid fa-pen-to-square text-success"></i>
                                    </a>

                                    <form id="form{{ $rubroCuenta->id }}"
                                        action="{{ route('contabilidad.grupo.cuentaContable.destroy', $rubroCuenta->id) }}"
                                        method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button"
                                            onclick="confirmDelete('form{{ $rubroCuenta->id }}', '¿Desea eliminar la cuenta asociada?');"
                                            title="Eliminar" class="btn btn-link p-0">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal para editar -->
                            <div class="modal fade" id="editGrupoModal{{ $rubroCuenta->id }}" tabindex="-1"
                                aria-labelledby="editGrupoModalLabel{{ $rubroCuenta->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editGrupoModalLabel{{ $rubroCuenta->id }}">
                                                Editar Grupo {{$rubroCuenta->id}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form
                                            action="{{ route('contabilidad.grupo.cuentaContable.update', $rubroCuenta->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="numero_cuenta{{ $rubroCuenta->id }}"
                                                        class="form-label">Numero Cuenta</label>
                                                    <input type="text" class="form-control"
                                                        id="numero_cuenta{{ $rubroCuenta->id }}" name="numero_cuenta"
                                                        value="{{ $rubroCuenta->numero_cuenta }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="signo{{ $rubroCuenta->id }}"
                                                        class="form-label">Signo</label>
                                                    <select class="form-select" id="signo{{ $rubroCuenta->id }}"
                                                        name="signo">
                                                        <option value="+"
                                                            {{ $rubroCuenta->signo == '+' ? 'selected' : '' }}>+
                                                        </option>
                                                        <option value="-"
                                                            {{ $rubroCuenta->signo == '-' ? 'selected' : '' }}>-
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="saldo{{ $rubroCuenta->id }}"
                                                        class="form-label">Saldo</label>
                                                    <input type="number" class="form-control"
                                                        id="saldo{{ $rubroCuenta->id }}" name="saldo"
                                                        value="{{ $rubroCuenta->saldo }}" step="0.01">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cuenta_id{{ $rubroCuenta->id }}"
                                                        class="form-label">Cuenta contable</label>
                                                    <select class="form-select select2"
                                                        id="cuenta_id{{ $rubroCuenta->id }}" name="cuenta_id" required>
                                                        <option selected disabled>Seleccionar</option>
                                                        @foreach ($cuentasContables as $cuenta)
                                                            <option value="{{ $cuenta->id }}"
                                                                {{ $rubroCuenta->cuenta_id == $cuenta->id ? 'selected' : '' }}>
                                                                {{ $cuenta->codigo }} - {{ $cuenta->nombre_cuenta }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar
                                                    cambios</button>
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

    <!-- Modal para crear -->
    <div class="modal fade" id="createGrupoModal" tabindex="-1" aria-labelledby="createGrupoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGrupoModalLabel">Asociar cuenta contable</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form
                    action="{{ route('contabilidad.grupo.cuentaContable.store', ['rubro' => $rubro_id, 'grupo' => $grupo_id]) }}"
                    method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="numero_cuenta" class="form-label">Numero Cuenta</label>
                            <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="signo" class="form-label">Signo</label>
                            <select class="form-select" id="signo" name="signo" required>
                                <option value="+">+</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="saldo" class="form-label">Saldo</label>
                            <input type="number" class="form-control" id="saldo" name="saldo" required>
                        </div>
                        <div class="mb-3">
                            <label for="cuenta_id" class="form-label">Cuenta contable</label>
                            <select class="form-select select2" id="cuenta_id" name="cuenta_id" required>
                                <option selected disabled>Seleccionar</option>
                                @foreach ($cuentasContables as $cuenta)
                                    <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} -
                                        {{ $cuenta->nombre_cuenta }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" value="{{ $grupo_id }}" name="grupo_id" hidden>
                        </div>
                        <div class="mb-3">
                            <input type="text" value="{{ $rubro_id }}" name="rubro_id" hidden>
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

        $(document).ready(function() {
            $('.select2').each(function() {
                $(this).select2({
                    theme: "bootstrap-5",
                    dropdownParent: $(this).parent()
                });
            });
        });
    </script>
</x-app-layout>
