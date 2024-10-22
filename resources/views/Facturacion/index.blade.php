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
        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <!-- cambio 1: Mensaje de error para fechas inválidas -->
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Facturación</h5>

                <!-- Formulario de filtro por fecha -->
                <form action="{{ route('facturacion.index') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                value="{{ request('fecha_inicio') }}" required>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"
                                value="{{ request('fecha_fin') }}" required>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary w-100 text-white"><i
                                    class="fas fa-filter"></i></button>
                        </div>
                    </div>
                </form>

                <table class="table table-sm" id="datatable-responsive">
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                        data-bs-target="#clienteModal">
                        <i class="fas fa-file-invoice-dollar"></i> Facturar sin cotización
                    </button>
                    <thead>
                        <tr>
                            <th scope="col">Orden</th>
                            <th scope="col">Fecha de Facturación</th>
                            <th scope="col">Monto a Facturar</th>
                            <th scope="col">Monto Facturado</th>
                            <th scope="col">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facturaciones as $facturacion)
                            <!-- Aplicar clase 'table-danger' si el campo anulado es true -->
                            <tr class="{{ $facturacion->anulado ? 'table-danger' : '' }}">
                                <td>{{ $facturacion->codigo }}</td>
                                @if ($facturacion->fecha_facturacion == null)
                                    <td>Sin asignar</td>
                                @else
                                    <td>{{ \Carbon\Carbon::parse($facturacion->fecha_facturacion)->format('d-m-Y') ?? 'Sin asignar' }}
                                    </td>
                                @endif
                                <td>{{ $facturacion->monto_facturar }}</td>
                                <td>{{ $facturacion->monto_facturado }}</td>
                                <td>{{ $facturacion->estado?->estado }}</td>
                                <td>
                                    <a href="{{ route('facturacion.agregarItemsFactura', $facturacion->id) }}">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </a>
                                    <!-- Si el campo 'anulado' es true, no mostrar el botón de anulación -->
                                    @if (!$facturacion->anulado)
                                        <i class="fas fa-times-circle text-success" data-bs-toggle="modal"
                                            data-bs-target="#anularModal-{{$facturacion->id}}" style="cursor: pointer;"></i>
                                    @endif
                                </td>

                                <!-- Modal anulado -->
                                <div class="modal fade" id="anularModal-{{$facturacion->id}}" tabindex="-1"
                                    aria-labelledby="anularModalLabel-{{$facturacion->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="clienteModalLabel">Anular documento</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('facturacion.anular') }}" method="POST">

                                                <div class="modal-body">
                                                    @csrf
                                                    <p class="text-center">
                                                        ¿Esta seguro de anular el documento seleccionado?
                                                    </p>
                                                    <input type="hidden" name="idFacturacion" id="facturacionId"
                                                        value="{{ $facturacion->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                                                    <button type="success" class="btn btn-success">
                                                        <i class="fas fa-check-circle"></i>
                                                        Aceptar
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
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

                        <div class="mb-3">
                            <label for="forma-pago-select" class="form-label">Forma de pago:</label>
                            <select class="form-select w-100" id="forma-pago-select" name="tipo_pago_id">
                                <option></option>
                                @foreach ($formaPago as $valor)
                                    <option value="{{ $valor->id }}">{{ $valor->valor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100"><i class="fas fa-check-circle"></i>
                            Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cliente-select, #tipo-documento-select').select2({
                placeholder: 'Seleccione una opción',
                dropdownParent: $('#clienteModal'),
                allowClear: true,
                closeOnSelect: true,
                width: '100%'
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#cliente-select, #tipo-documento-select, #forma-pago-select').select2({
                        placeholder: 'Seleccione una opción',
                        dropdownParent: $('#clienteModal'),
                        allowClear: true,
                        closeOnSelect: true,
                        width: '100%'
            });
        });
    </script>

</x-app-layout>
