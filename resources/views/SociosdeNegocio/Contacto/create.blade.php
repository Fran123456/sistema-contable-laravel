<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Crear contacto
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.contacto.index')}}">Contactos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear contacto</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('socios.contacto.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="contacto_nombre"> <strong>Nombre</strong> </label>
                            <input type="text" name="nombre" class="form-control" required>
                            @error('nombre')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="contacto_apellido"> <strong>Apellido</strong> </label>
                            <input type="text" name="apellido" class="form-control" required>
                            @error('apellido')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="contacto_correo"> <strong>Correo electrónico</strong> </label>
                            <input type="text" name="correo" class="form-control">
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="contacto_telefono"> <strong>Teléfono</strong> </label>
                            <input type="text" name="telefono" class="form-control" required>
                            @error('telefono')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="medio_contacto"> <strong>Medio de contacto</strong> </label>
                            <input type="text" name="contactado_en" class="form-control">
                        </div>                      
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="cargo"> <strong>Cargo</strong></label>
                            <select required id="cargo_id" name="cargo_id" class="form-control">
                                <option value="">Selecciona una opción</option>
                                @foreach ($cargos as $cargo)
                                    <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="tipo_contrato"> <strong>Tipo de contrato</strong></label>
                            <select id="tipo_contrato" name="tipo_contrato" class="form-control">
                                <option value="">Selecciona una opción</option>
                                <option value="Pasante">Pasante</option>
                                <option value="Servicios profesionales">Servicios profesionales</option>
                                <option value="Consultor">Consultor</option>
                                <option value="Planilla">Planilla</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="estado"> <strong>Estado</strong></label>
                            <select id="estado" name="estado" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Ingresado">Ingresado</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Proceso de seleccion">En proceso de selección</option>
                                <option value="Descartado">Descartado</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-2 mb-12">
                            <label for="cv"><strong>CV</strong></label>
                            <input class="form-control" type="file" name="cv" id="cv" accept="application/pdf">
                        </div>
                        <div>
                            <input type="hidden" name="persona_encuentra_id" value="{{$usuario->id}}"  class="form-control">                       
                        </div>
                        <div class="col-md-12 mt-4 mb-1">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>