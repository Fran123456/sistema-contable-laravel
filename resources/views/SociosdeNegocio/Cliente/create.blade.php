<x-app-layout>
    <x-chosen></x-chosen>
    <x-slot:title>
        Crear cliente
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.cliente.index')}}">Cliente</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear cliente</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('socios.cliente.index') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_nombre"><strong>Nombre</strong></label>
                            <input type="text" name="nombre" required class="form-control">
                            @error('nombre')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_apellido"><strong> Apellido </strong></label>
                            <input type="text" name="apellido" required class="form-control">
                            @error('apellido')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_nit"><strong> NIT </strong></label>
                            <input type="text" name="nit" required class="form-control">
                            @error('nit')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_dui"><strong> DUI </strong></label>
                            <input type="text" name="dui" required class="form-control">
                            @error('dui')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_correo"><strong> Correo electrónico </strong></label>
                            <input type="text" name="correo" required class="form-control">
                            @error('correo')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_clasificacion"><strong>Clasificación del cliente</strong></label>
                            <select id="clasificacion_cliente" name="clasificacion_cliente_id" required class="form-control">
                                <option value="0" selected disabled>Seleccionar opción</option>
                                @foreach($clasificacion as $clasificacion)
                                    <option value="{{$clasificacion->id}}">{{$clasificacion->tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="tipo_cliente"><strong>Tipo de cliente</strong></label>
                            <select required id="tipo_cliente" name="tipo_cliente" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($tipoCliente as $tipo)
                                    <option value="{{$tipo}}">{{$tipo}}</option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="magnitud_cliente"><strong>Magnitud del cliente</strong></label>
                            <select required id="magnitud_cliente" name="magnitud_cliente" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($magnitudCliente as $magnitud)
                                    <option value="{{$magnitud}}">{{$magnitud}}</option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_direccion"><strong> Dirección </strong></label>
                            <input type="text" name="direccion" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_giro"><strong>Giro del negocio </strong></label>
                            <input type="text" name="giro_negocio" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_nrc"><strong> NRC </strong></label>
                            <input type="text" name="nrc" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_telefono"><strong> Teléfono </strong></label>
                            <input type="text" name="telefono" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_celular"><strong> Celular </strong></label>
                            <input type="text" name="celular" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_observaciones"><strong> Observaciones </strong></label>
                            <input type="text" name="observaciones" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_pais"><strong> País </strong></label>
                                <select  id="pais" name="pais_id" class="form-control">
                                    <option value="0" selected disabled>Seleccionar opción</option>
                                    @foreach($paises as $pais)
                                        <option value="{{ $pais->id }}">{{ $pais->pais }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_departamento"><strong> Departamento </strong></label>
                                <select id="departamento" name="departamento_id" class="form-control">
                                <!-- Opciones de departamentos que se cargarán dinámicamente con jQuery -->
                                </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_distrito"><strong> Distrito </strong></label>
                                <select id="distrito" name="distrito_id" class="form-control">
                                <!-- Opciones de distritos que se cargarán dinámicamente con jQuery -->
                                </select>
                        </div>
                        <div>
                            {{-- Obtenemos el id del usuario --}}
                            <input type="hidden" name="usuario_creo_id" value="{{$usuario_creo->id}}"  class="form-control">
                        </div>
                        <div>
                            <input type="hidden" name="empresa_id" value="{{$usuario_creo->empresa_id}}"class="form-control">
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
        $(document).ready(function () {
            $('#pais').on('change',function () {
                var paisId = $(this).val();
                $.ajax({
                    url: '/socios/obtener-departamentos/' + paisId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#departamento').empty();
                        $('#departamento').append("<option value=''>Selecciona un departamento</option>");
                        $.each(data, function (key, value) {
                            $('#departamento').append('<option value="'+ value.id +'">' + value.departamento + '</option>');
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
            // Obtenemos los distritos correspodientes a cada departamento
            $('#departamento').on('change',function () {
                var departamentoId = $(this).val();
                $.ajax({
                    url: '/socios/obtener-distritos/' + departamentoId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#distrito').empty();
                        $('#distrito').append("<option value=''>Selecciona un cargo</option>");
                        $.each(data, function (key, value) {
                            $('#distrito').append('<option value="'+ value.id +'">' + value.distrito + '</option>');
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

</x-app-layout>
