<x-app-layout>



    <x-slot:title>
        Partidas Automaticas
    </x-slot>
    <x-slot:subtitle>
    </x-slot>


    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Partidas Automaticas</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Partidas</h5>

                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Titulos</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Cuenta</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partidas as $partida)
                            <tr>
                                <td>{{ $partida->titulo }}</td>
                                <td>{{ $partida->descripcion }}</td>
                                <td>
                                    {{ $partida->cuentaContable ? $partida->cuentaContable->codigo . ' - ' . $partida->cuentaContable->nombre_cuenta : 'No asignada' }}
                                </td>
                                <td>
                                    <i class="fas fa-edit text-success" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $partida->id }}" style="cursor: pointer;"></i>
                                </td>
                            </tr>

                            <!-- Modal edit -->
                            <div class="modal fade" id="editModal-{{ $partida->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel-{{ $partida->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-{{ $partida->id }}">Editar
                                                cuenta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('partidasAutomaticas.update', $partida->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="cuenta_id" class="form-label">Cuenta Contable</label>
                                                    <select class="form-select select2"
                                                        id="cuentaID{{$partida->id}}" name="cuenta_id">
                                                        <option selected disabled>Seleccione</option>
                                                        @foreach ($cuentas as $cuenta)
                                                            <option value="{{ $cuenta->id }}"
                                                                @if ($cuenta->id == $partida->cuenta_id) selected @endif>
                                                                {{ $cuenta->codigo }} - {{ $cuenta->nombre_cuenta }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                aria-label="Close">Cerrar</button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check-circle"></i> Aceptar
                                            </button>
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <script>
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
