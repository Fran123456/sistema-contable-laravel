<x-app-layout>
    <x-slot:title>
        Lista de Facturaciones
        </x-slot>
        <x-slot:subtitle>
            </x-slot>

            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Facturación</li>
                </ol>
            </div>
            <div class="col-md-12">
                <x-alert></x-alert>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Facturación</h5>

                        <table class="table table-sm" id="datatable-responsive">
                            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#clienteModal">
                                <i class="fas fa-file-invoice-dollar"></i> Facturar sin cotización
                            </button>
                            <thead>
                                <tr>
                                    <th scope="col">Orden</th>
                                    <th scope="col">Fecha de Facturación</th>
                                    <th scope="col">Monto a Facturar</th>
                                    <th scope="col">Monto Facturado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facturaciones as $facturacion)
                                <tr>
                                    <td>{{ $facturacion->codigo }}</td>
                                    <td>{{ $facturacion->fecha_facturacion }}</td>
                                    <td>{{ $facturacion->monto_facturar }}</td>
                                    <td>{{ $facturacion->monto_facturado }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="clienteModalLabel">Registro de factura</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('facturacion.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="cliente-select" class="form-label">Cliente:</label>
                                    <select class="form-select w-100" id="cliente-select" name="cliente_id">
                                        <option></option>
                                        @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tipo-documento-select" class="form-label">Tipo de documento:</label>
                                    <select class="form-select w-100" id="tipo-documento-select" name="tipo_documento_id">
                                        <option></option>
                                        @foreach ($tiposDocumento as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success w-100"><i class="fas fa-check-circle"></i> Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <style>
                .modal-content {
                    border-radius: 8px;
                }

                .modal-header {
                    border-bottom: 1px solid #dee2e6;
                    padding: 1rem 1.5rem;
                }

                .modal-body {
                    padding: 1.5rem;
                }

                .form-label {
                    display: block;
                    margin-bottom: 0.5rem;
                }

                .btn-success {
                    background-color: #28a745;
                    border-color: #28a745;
                }

                .btn-success:hover {
                    background-color: #218838;
                    border-color: #1e7e34;
                }

                .w-100 {
                    width: 100% !important;
                }

                .select2-container--default .select2-selection--single {
                    height: calc(2.25rem + 2px);
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    border: 1px solid #ced4da;
                    border-radius: 0.375rem;
                    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }

                .select2-container--default .select2-selection--single .select2-selection__rendered {
                    line-height: calc(2.25rem + 2px);
                }

                .select2-container .select2-dropdown {
                    border-radius: 0.375rem;
                }
            </style>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#datatable-responsive').DataTable();
                    $('#cliente-select, #tipo-documento-select').select2({
                        placeholder: 'Seleccione una opción',
                        dropdownParent: $('#clienteModal'),
                        allowClear: true,
                        closeOnSelect: false,
                        width: '100%'
                    });
                });
            </script>

</x-app-layout>