<x-app-layout>
    <x-chosen></x-chosen>
    <x-slot:title>
        Editar cliente
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('socios.cliente.index') }}">Cliente</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar cliente</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('socios.cliente.update', $cliente) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_nombre"><strong>Nombre</strong></label>
                            <input type="text" name="nombre" value="{{ $cliente->nombre }}" required
                                class="form-control">
                            @error('nombre')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_apellido"><strong> Apellido </strong></label>
                            <input type="text" name="apellido" value="{{ $cliente->apellido }}" required
                                class="form-control">
                            @error('apellido')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_nit"><strong> NIT </strong></label>
                            <input type="text" name="nit" value="{{ $cliente->nit }}" required
                                class="form-control">
                            @error('nit')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_dui"><strong> DUI </strong></label>
                            <input type="text" name="dui" value="{{ $cliente->dui }}" required
                                class="form-control">
                            @error('dui')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_correo"><strong> Correo electrónico </strong></label>
                            <input type="text" name="correo" value="{{ $cliente->correo }}" required
                                class="form-control">
                            @error('correo')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_clasificacion"><strong>Clasificación del cliente</strong></label>
                            <select id="clasificacion_cliente" name="clasificacion_cliente_id" required
                                class="form-control">
                                <option value="0" selected disabled>Seleccionar opción</option>
                                @foreach ($clasificacion as $clasificacion)
                                    <option value="{{ $clasificacion->id }}"
                                        @if ($clasificacion->id == $cliente->clasificacion_cliente_id) selected @endif>
                                        {{ $clasificacion->tipo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="tipo_cliente"><strong>Tipo de cliente</strong></label>
                            <select required id="tipo_cliente" name="tipo_cliente" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($tipoCliente as $tipo)
                                    <option value="{{ $tipo }}"
                                        @if ($tipo == $cliente->tipo_cliente) selected @endif>
                                        {{ $tipo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="magnitud_cliente"><strong>Magnitud del cliente</strong></label>
                            <select required id="magnitud_cliente" name="magnitud_cliente" class="form-control"
                                required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($magnitudCliente as $magnitud)
                                    <option value="{{ $magnitud }}"
                                        @if ($magnitud == $cliente->magnitud_cliente) selected @endif>
                                        {{ $magnitud }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mt-2 mb-12">
                            <label for="cliente_direccion"><strong> Dirección </strong></label>
                            <textarea name="direccion" class="form-control" style="height: 90px">{{ $cliente->direccion }}</textarea>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_giro"><strong>Giro del negocio </strong></label>
                            <input type="text" name="giro_negocio" value="{{ $cliente->giro_negocio }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_nrc"><strong> NRC </strong></label>
                            <input type="text" name="nrc" value="{{ $cliente->nrc }}" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_telefono"><strong> Teléfono </strong></label>
                            <input type="text" name="telefono" value="{{ $cliente->telefono }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_celular"><strong> Celular </strong></label>
                            <input type="text" name="celular" value="{{ $cliente->celular }}" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_observaciones"><strong> Observaciones </strong></label>
                            <input type="text" name="observaciones" value="{{ $cliente->observaciones }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_pais"><strong> País </strong></label>
                            <select id="pais" name="pais_id" class="form-control">
                                <option value="0" selected disabled>Seleccionar opción</option>
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}"
                                        @if ($pais->id == $cliente->pais_id) selected @endif>
                                        {{ $pais->pais }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_departamento"><strong> Departamento </strong></label>
                            <select id="departamento" name="departamento_id" class="form-control">
                                <!-- Opciones de departamentos que se cargarán dinámicamente con jQuery -->
                                <option value="{{ $departamento }}"
                                    {{ $cliente->departamento_id == $departamento ? 'selected' : '' }}>
                                    {{ $cliente->departamento->departamento }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_distrito"><strong> Distrito </strong></label>
                            <select id="distrito" name="distrito_id" class="form-control">
                                <!-- Opciones de distritos que se cargarán dinámicamente con jQuery -->
                                <option value="{{ $distrito }}"
                                    {{ $cliente->distrito_id == $distrito ? 'selected' : '' }}>
                                    {{ $cliente->distrito->distrito }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_distrito"><strong>Actividad economica </strong></label>
                            <select id="actividad_economica" name="actividad_economica" class="form-control select2">
                                <option value="">Selecciona una opción</option>
                                @foreach ($actividadesEconomicas as $actividad)
                                    <option value="{{ $actividad->codigo }}" @if ($actividad->codigo == $cliente->actividad_economica) selected @endif >{{ $actividad->valor }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="hidden" name="empresa_id"
                                value="{{ $cliente->empresa_id }}"class="form-control">
                        </div>
                        <div class="col-md-12 mt-4 mb-1">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Al cargar la página, seleccionar automáticamente el país y el departamento guardados
            var paisId = $('#pais').val();
            var departamentoId = $('#departamento').val();
            var distritoId = $('#distrito').val();

            // Si hay un país seleccionado, cargar los departamentos correspondientes
            if (paisId) {
                cargarDepartamentos(paisId);
            }

            // Si el usuario cambia el pais, se muestran los departamentos correspondientes
            $('#pais').on('change', function() {
                var paisId = $(this).val();
                cargarDepartamentos(paisId);
            });

            // Hace el cambio de departamento y muestra sus distritos correspondientes
            $('#departamento').on('change', function() {
                var departamentoId = $(this).val();
                obtenerDistritos(departamentoId, distritoId);
            });

            // Función para cargar los departamentos según el país seleccionado
            function cargarDepartamentos(paisId) {
                $.ajax({
                    url: '/socios/obtener-departamentos/' + paisId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#departamento').empty();
                        $('#departamento').append(
                            "<option value=''>Selecciona un departamento</option>");
                        $.each(data, function(key, value) {
                            var selected = (value.id == departamentoId) ? 'selected' : '';
                            $('#departamento').append('<option value="' + value.id + '" ' +
                                selected + '>' + value.departamento + '</option>');
                        });

                        // Obtener los distritos del departamento seleccionado
                        obtenerDistritos(departamentoId, distritoId);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            // Función para obtener los distritos del departamento seleccionado
            function obtenerDistritos(departamentoId, distritoId) {
                $.ajax({
                    url: '/socios/obtener-distritos/' + departamentoId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#distrito').empty();
                        $('#distrito').append("<option value=''>Selecciona un distrito</option>");
                        $.each(data, function(key, value) {
                            var selected = (value.id == distritoId) ? 'selected' : '';
                            $('#distrito').append('<option value="' + value.id + '" ' +
                                selected + '>' + value.distrito + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            $('.select2').each(function() {
                $(this).select2({
                    theme: "bootstrap-5",
                    dropdownParent: $(this).parent()
                });
            });
        });
    </script>

</x-app-layout>
