<x-app-layout>
    <x-slot:title>
        Serial Facturación
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Serial Facturación</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal" title="Crear">
            <i class="fa-solid fa-circle-plus"></i>
        </button>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Seriales de Facturación</h5>

                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Tipo de Documento</th>
                            <th scope="col">Serial</th>
                            <th scope="col">Correlativo Inicial</th>
                            <th scope="col">Último Correlativo</th>
                            <th scope="col">Activo</th>
                            <th scope="col" width="160px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($seriales as $key => $serial)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $serial->tipoDocumento->tipo }}</td>
                                <td>{{ $serial->serial }}</td>
                                <td>{{ $serial->correlativo_inicial }}</td>
                                <td>{{ $serial->ultimo_correlativo }}</td>
                                <td>{{ $serial->activo ? 'Sí' : 'No' }}</td>
                                <td class="text-center">
                                    <a href="#" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal-{{ $serial->id }}" 
                                        title="Editar" >
                                        <i class="fas fa-edit fa-lg"></i>
                                    </a>
                                    <form id="form{{ $serial->id }}" action="{{ route('serial-facturacion.destroy', $serial->id) }}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" 
                                            onclick="if(confirm('form{{ $serial->id }}','¿Desea eliminar este serial de facturación?')) { event.preventDefault(); this.closest('form').submit(); }" 
                                            title="Eliminar" class="mx-0.5">
                                            <i class="fas fa-trash fa-lg" style="color: #f43e3e"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Serial -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Crear Serial de Facturación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('serial-facturacion.store') }}" method="post" id="serial">
                    @csrf
                    <div class="modal-body">
                        <!-- Campos del formulario -->
                        <div class="mb-3">
                            <label for="tipo_documento_id" class="form-label">Tipo de Documento</label>
                            <select name="tipo_documento_id" class="form-control" required>
                                <option value="" disabled selected>Seleccionar</option>
                                @foreach($tiposDocumento as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="serial" class="form-label">Serial</label>
                            <input type="text" class="form-control" name="serial" required>
                        </div>
                        <div class="mb-3">
                            <label for="correlativo_inicial" class="form-label">Correlativo Inicial</label>
                            <input type="number" class="form-control" name="correlativo_inicial" id="correlativo_inicial" required>
                        </div>
                        <input type="hidden" name="ultimo_correlativo" id="ultimo_correlativo" required>
                        <input type="hidden" name="empresa_id" value="{{ Help::empresa() }}">
                        <div class="mb-3">
                            <label for="activo" class="form-label">Activo</label>
                            <select name="activo" class="form-control" required>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Serial -->
    @foreach ($seriales as $serial)
        <div class="modal fade" id="editModal-{{ $serial->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $serial->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel-{{ $serial->id }}">Editar Serial de Facturación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('serial-facturacion.update', $serial->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <!-- Campos del formulario -->
                            <div class="mb-3">
                                <label for="tipo_documento_id" class="form-label">Tipo de Documento</label>
                                <select name="tipo_documento_id" class="form-control" required>
                                    <option value="" disabled selected>Seleccionar</option>
                                    @foreach($tiposDocumento as $tipo)
                                        <option value="{{ $tipo->id }}" @if($serial->tipo_documento_id == $tipo->id) selected @endif>
                                            {{ $tipo->tipo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="serial" class="form-label">Serial</label>
                                <input type="text" class="form-control" name="serial" value="{{ $serial->serial }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="correlativo_inicial" class="form-label">Correlativo Inicial</label>
                                <input type="number" class="form-control" name="correlativo_inicial" value="{{ $serial->correlativo_inicial }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ultimo_correlativo" class="form-label">Último Correlativo</label>
                                <input type="number" class="form-control" name="ultimo_correlativo" value="{{ $serial->ultimo_correlativo }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="activo" class="form-label">Activo</label>
                                <select name="activo" class="form-control" required>
                                    <option value="1" @if($serial->activo) selected @endif>Sí</option>
                                    <option value="0" @if(!$serial->activo) selected @endif>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const correlativoInicial = document.getElementById('correlativo_inicial');
            const ultimoCorrelativo = document.getElementById('ultimo_correlativo');

            if (correlativoInicial) {
                correlativoInicial.addEventListener('input', function() {
                    ultimoCorrelativo.value = correlativoInicial.value;
                });
            }
        });
    </script>

</x-app-layout>
