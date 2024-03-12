<x-app-layout>
    <x-chosen></x-chosen>
    <x-slot:title>
        Ver cliente
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.cliente.index')}}">Cliente</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ver cliente</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12 text-end mb-2">
        <a class="btn btn-success @if($cliente->activo) disabled @endif" href="{{route('socios.habilitarCliente', $cliente->id)}}" title="Habilitar cliente">Habilitar</a>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_nombre"><strong>Nombre</strong></label>
                            <input type="text" name="nombre" readonly value="{{$cliente->nombre}}" required class="form-control">
                            @error('nombre')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_apellido"><strong> Apellido </strong></label>
                            <input type="text" name="apellido" readonly value="{{$cliente->apellido}}" required class="form-control">
                            @error('apellido')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_nit"><strong> NIT </strong></label>
                            <input type="text" name="nit" readonly value="{{$cliente->nit}}" required class="form-control">
                            @error('nit')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_dui"><strong> DUI </strong></label>
                            <input type="text" name="dui" readonly value="{{$cliente->dui}}" required class="form-control">
                            @error('dui')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_correo"><strong> Correo electrónico </strong></label>
                            <input type="text" name="correo" readonly value="{{$cliente->correo}}" required class="form-control">
                            @error('correo')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_clasificacion"><strong>Clasificación del cliente</strong></label>
                            <select id="clasificacion_cliente" name="clasificacion_cliente_id" class="form-control" readonly required>
                                <option value="0" selected disabled>Seleccionar opción</option>
                                @foreach($clasificacion as $clasificacion)
                                    <option value="{{$clasificacion->id}}" @if ($clasificacion->id == $cliente->clasificacion_cliente_id) selected @endif>
                                        {{$clasificacion->tipo}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="tipo_cliente"><strong>Tipo de cliente</strong></label>
                            <select required id="tipo_cliente" name="tipo_cliente" class="form-control" readonly required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($tipoCliente as $tipo)
                                    <option value="{{$tipo}}" @if ($tipo == $cliente->tipo_cliente) selected @endif>
                                        {{$tipo}}
                                    </option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="magnitud_cliente"><strong>Magnitud del cliente</strong></label>
                            <select required id="magnitud_cliente" name="magnitud_cliente" class="form-control" readonly required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($magnitudCliente as $magnitud)
                                    <option value="{{$magnitud}}" @if ($magnitud == $cliente->magnitud_cliente) selected @endif>
                                        {{$magnitud}}
                                    </option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_direccion"><strong> Dirección </strong></label>
                            <input type="text" name="direccion" value="{{$cliente->direccion}}" readonly class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_giro"><strong>Giro del negocio </strong></label>
                            <input type="text" name="giro_negocio" value="{{$cliente->giro_negocio}}" readonly class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_nrc"><strong> NRC </strong></label>
                            <input type="text" name="nrc" value="{{$cliente->nrc}}" readonly class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_telefono"><strong> Teléfono </strong></label>
                            <input type="text" name="telefono" value="{{$cliente->telefono}}" readonly class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_celular"><strong> Celular </strong></label>
                            <input type="text" name="celular" value="{{$cliente->celular}}" readonly class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_observaciones"><strong> Observaciones </strong></label>
                            <input type="text" name="observaciones" value="{{$cliente->observaciones}}" readonly class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_pais"><strong> País </strong></label>
                                <select  id="pais" name="pais_id" class="form-control" readonly>
                                    <option value="0" selected disabled>Seleccionar opción</option>
                                    @foreach($paises as $pais)
                                        <option value="{{ $pais->id }}" @if ($pais->id == $cliente->pais_id) selected @endif>
                                            {{ $pais->pais }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_departamento"><strong> Departamento </strong></label>
                                <select id="departamento" name="departamento_id" class="form-control" readonly >
                                <!-- Opciones de departamentos que se cargarán dinámicamente con jQuery -->
                                <option value="{{ $departamento }}" {{ $cliente->departamento_id == $departamento ? 'selected' : '' }} >
                                    {{ $cliente->departamento->departamento}}
                                </option>
                                </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="cliente_distrito"><strong> Distrito </strong></label>
                                <select id="distrito" name="distrito_id" class="form-control" readonly >
                                <!-- Opciones de distritos que se cargarán dinámicamente con jQuery -->
                                <option value="{{ $distrito }}" {{ $cliente->distrito_id == $distrito ? 'selected' : '' }} >
                                    {{ $cliente->distrito->distrito}}
                                </option>
                                </select>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</x-app-layout>
