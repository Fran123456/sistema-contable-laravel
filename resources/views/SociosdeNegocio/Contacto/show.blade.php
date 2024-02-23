<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Ver contacto
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.contacto.index')}}">Contactos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ver contacto</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12 text-end mb-2">
        <a class="btn btn-success " href="{{Storage::url($contacto->cv)}}" target="_blank" title="Ver CV">Ver CV</a>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="contacto_nombre"> <strong>Nombre</strong> </label>
                        <input type="text" name="nombre" class="form-control" readonly value="{{$contacto->nombre}}" required>
                        @error('nombre')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="contacto_apellido"> <strong>Apellido</strong> </label>
                        <input type="text" name="apellido" class="form-control" readonly value="{{$contacto->apellido}}" required>
                        @error('apellido')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="contacto_correo"> <strong>Correo electrónico</strong> </label>
                        <input type="text" name="correo" class="form-control" readonly value="{{$contacto->correo}}">
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="contacto_telefono"> <strong>Teléfono</strong> </label>
                        <input type="text" name="telefono" class="form-control" readonly value="{{$contacto->telefono}}"required>
                        @error('telefono')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="medio_contacto"> <strong>Medio de contacto</strong> </label>
                        <input type="text" name="contactado_en" class="form-control" readonly value="{{$contacto->contactado_en}}">
                    </div>                      
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="cargo"> <strong>Cargo</strong></label>
                        <select required id="cargo_id" name="cargo_id" class="form-control" readonly value="{{$contacto->cargo_id}}">
                            <option value="">Selecciona una opción</option>
                            @foreach ($cargos as $cargo)
                                <option value="{{$cargo->id}}" @if ($cargo->id == $contacto->cargo_id) selected @endif>{{$cargo->cargo}}</option>                                                                      
                            @endforeach    
                        </select>
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="tipo_contrato"> <strong>Tipo de contrato</strong></label>
                        <select id="tipo_contrato" name="tipo_contrato" class="form-control" readonly value="{{$contacto->tipo_contrato}}">
                            <option value="">Selecciona una opción</option>
                            <option value="Pasante" {{$contacto->tipo_contrato === 'Pasante' ? 'selected' : ' '}}>Pasante</option>
                            {{-- Si es true devuelve el valor y si es false devuelve una cadena vacia --}}
                            <option value="Servicios profesionales" {{$contacto->tipo_contrato === 'Servicios profesionales' ? 'selected' : ' '}}>Servicios profesionales</option>
                            <option value="Consultor" {{$contacto->tipo_contrato === 'Consultor' ? 'selected' : ' '}}>Consultor</option>
                            <option value="Planilla" {{$contacto->tipo_contrato === 'Planilla' ? 'selected' : ' '}}>Planilla</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2 mb-12">
                        <label for="estado"> <strong>Estado</strong></label>
                        <select id="estado" name="estado" class="form-control" readonly value="{{$contacto->estado}}" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Ingresado" {{$contacto->estado === 'Ingresado' ? 'selected' : ' '}}>Ingresado</option>
                            <option value="Inactivo" {{$contacto->estado === 'Inactivo' ? 'selected' : ' '}}>Inactivo</option>
                            <option value="Proceso de seleccion" {{$contacto->estado === 'Proceso de seleccion' ? 'selected' : ' '}}>En proceso de selección</option>
                            <option value="Descartado" {{$contacto->estado === 'Descartado' ? 'selected' : ' '}}>Descartado</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>