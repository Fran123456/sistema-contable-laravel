<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Crear proveedor
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.proveedores.index')}}">Proveedores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear proveedores</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('socios.proveedores.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-12">
                            <label for="proveedor_nombre"> <strong>Nombre</strong> </label>
                            <input type="text" name="nombre" class="form-control" required>
                            @error('nombre')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedor_giro"> <strong>Giro</strong> </label>
                            <input type="text" name="giro" class="form-control" required>
                            @error('giro')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedores_num_registro"> <strong>Número de registro (NRC)</strong> </label>
                            <input type="text" name="numero_registro" class="form-control" >
                            @error('numero_registro')
                            {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedores_nit"> <strong>NIT</strong> </label>
                            <input type="text" name="nit" class="form-control" >
                            @error('nit')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="dui" class="form-label"><strong>DUI</strong></label>
                            <input type="text" name="dui" id="dui" class="form-control">
                            @error('dui')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedores_tipo"><strong>Tipo de proveedor</strong></label>
                            <select required id="tipo_proveedor" name="tipo_proveedor" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($tipoProveedor as $tipo)
                                    <option value="{{$tipo}}">{{$tipo}}</option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedores_personalidad"><strong>Tipo de personalidad</strong></label>
                            <select required id="tipo_personalidad" name="tipo_personalidad" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($tipoPersonalidad as $personalidad)
                                    <option value="{{$personalidad}}">{{$personalidad}}</option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                      
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedores_forma_pago"> <strong>Forma de pago</strong></label>
                            <select id="forma_pago" name="forma_pago" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Credito">Crédito</option>
                                <option value="Contado">Contado</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedores_telefono"> <strong>Teléfono</strong> </label>
                            <input type="text" name="telefono" class="form-control" >
                            @error('telefono')
                                {{$message}}
                            @enderror
                        </div>                    
                        <div class="col-md-8 mt-2 mb-12">
                            <label for="proveedores_direccion"><strong>Dirección</strong></label>
                            <input type="text" name="direccion" class="form-control" >
                            @error('direccion')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedores_correo"><strong>Correo</strong></label>
                            <input type="text" name="correo" class="form-control" >
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedores_celular"><strong>Celular</strong></label>
                            <input type="text" name="celular" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2 mb-12">
                            <label for="proveedores_pais"><strong>País</strong></label>
                            <select required id="pais_id" name="pais_id" class="form-control" >
                                <option value="">Selecciona una opción</option>
                                @foreach ($pais as $pais )
                                    <option value="{{$pais->id}}">{{$pais->pais}}</option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <input type="hidden" name="empresa_id" value="{{ Help::empresa() }}">
                        <div class="col-md-12 mt-4 mb-1">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>