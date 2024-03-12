<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Ver proveedor
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.proveedores.index')}}">Proveedores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ver proveedores</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedor_nombre"> <strong>Nombre</strong> </label>
                        <input type="text" name="nombre" class="form-control" readonly value="{{$proveedor->nombre}}" required>
                        @error('nombre')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedor_giro"> <strong>Giro</strong> </label>
                        <input type="text" name="giro" class="form-control" readonly value="{{$proveedor->giro}}" required>
                        @error('giro')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_num_registro"> <strong>Número de registro</strong> </label>
                        <input type="text" name="numero_registro" class="form-control"  readonly value="{{$proveedor->numero_registro}}" required>
                        @error('numero_registro')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_nit"> <strong>NIT</strong> </label>
                        <input type="text" name="nit" class="form-control"  readonly value="{{$proveedor->nit}}" required>
                        @error('nit')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_tipo"><strong>Tipo de proveedor</strong></label>
                        <select required id="tipo_proveedor" name="tipo_proveedor" class="form-control" readonly required>
                            <option value="">Selecciona una opción</option>
                            @foreach ($tipoProveedor as $tipo)
                                <option value="{{$tipo}}" @if ($tipo == $proveedor->tipo_proveedor) selected @endif>{{$tipo}}</option>                                                                      
                            @endforeach    
                        </select>
                    </div>
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_personalidad"><strong>Tipo de personalidad</strong></label>
                        <select required id="tipo_personalidad" name="tipo_personalidad" class="form-control" readonly required>
                            <option value="">Selecciona una opción</option>
                            @foreach ($tipoPersonalidad as $personalidad)
                                <option value="{{$personalidad}}" @if ($personalidad == $proveedor->tipo_personalidad) selected @endif>{{$personalidad}}</option>                                                                      
                            @endforeach    
                        </select>
                    </div>
                    
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_forma_pago"> <strong>Forma de pago</strong></label>
                        <select id="forma_pago" name="forma_pago" class="form-control"  readonly required>
                            <option value="">Selecciona una opción</option>
                            <option value="Credito" {{$proveedor->forma_pago === 'Credito' ? 'selected' : ' '}}>Crédito</option>
                            <option value="Contado" {{$proveedor->forma_pago === 'Contado' ? 'selected' : ' '}}>Contado</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_telefono"> <strong>Teléfono</strong> </label>
                        <input type="text" name="telefono" class="form-control" value="{{$proveedor->telefono}}" readonly required>
                        @error('telefono')
                            {{$message}}
                        @enderror
                    </div>                    
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_direccion"><strong>Dirección</strong></label>
                        <input type="text" name="direccion" class="form-control" value="{{$proveedor->direccion}}" readonly required>
                        @error('direccion')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_correo"><strong>Correo</strong></label>
                        <input type="text" name="correo" class="form-control" value="{{$proveedor->correo}}" readonly required>
                    </div>
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_celular"><strong>Celular</strong></label>
                        <input type="text" name="celular" class="form-control" readonly value="{{$proveedor->celular}}">
                    </div>
                    <div class="col-md-4 mt-2 mb-12">
                        <label for="proveedores_pais"><strong>País</strong></label>
                        <select required id="pais" name="pais" class="form-control" readonly required>
                            <option value="">Selecciona una opción</option>
                            @foreach ($pais as $pais)
                            <option value="{{$pais->id}}" @if ($pais->id == $pais->id) selected @endif>{{$pais->pais}}</option>                                                                      
                            @endforeach    
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>