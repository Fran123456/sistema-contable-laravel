<x-app-layout>
    
    <x-chosen></x-chosen>
    <x-select2></x-select2>
   <x-slot:title>
       Crear contacto
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
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
                <form action="{{route('socios.contacto.store') }}" method="post" enctype="multipart/form-data" id="observacionForm">
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
                            <select required id="cargo_id" name="cargo_id" class="form-select select2">
                                <option value="">Selecciona una opción</option>
                                @foreach ($cargos as $cargo)
                                    <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="tipo_contrato"> <strong>Tipo de contrato</strong></label>
                            <select required id="tipo_contrato" name="tipo_contrato" class="form-select select2">
                                <option value="">Selecciona una opción</option>
                                <option value="Pasante">Pasante</option>
                                <option value="Servicios profesionales">Servicios profesionales</option>
                                <option value="Consultor">Consultor</option>
                                <option value="Planilla">Planilla</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2 mb-12">
                            <label for="estado"> <strong>Estado</strong></label>
                            <select required id="estado" name="estado" class="form-select select2" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Ingresado">Ingresado</option>
                                <option value="Ingresado-Recomendado">Ingresado/Recomendado</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Proceso de seleccion">En proceso de selección</option>
                                <option value="Descartado">Descartado</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2 mb-6">
                            <label for="cv"><strong>CV</strong></label>
                            <input class="form-control" type="file" name="cv" id="cv" accept="application/pdf">
                        </div>

                        <div class="col-md-6 mt-2 mb-12">
                            <label for="pais_id"> <strong>Pais</strong></label>
                            <select required id="pais_id" name="pais_id" class="form-select select2">
                                <option value="">Selecciona una opción</option>
                                @foreach ($paises as $pais)
                                    <option value="{{$pais->id}}">{{$pais->pais}}</option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-12 mt-2 mb-12">
                            <label for="portafolio"> <strong>Portafolio</strong> </label>
                            <input type="text" name="portafolio" class="form-control">
                            @error('portafolio')
                                {{$message}}
                            @enderror
                        </div>


                       
                        <div class="col-md-12 mt-2 mb-12">
                            <label for="medio_contacto"> <strong>Anexo</strong> </label>
                            <div id="editor" class="form-control"></div>
                            <input type="hidden" name="anexo" id="anexo">
                        </div> 

                       
                        
                       
                        <div>
                            <input type="hidden" name="persona_encuentra_id" value="{{$usuario->id}}"  class="form-control">                       
                        </div>
                        <div>
                            <input type="hidden" name="empresa_id" value="{{$usuario->empresa_id}}"  class="form-control">                       
                        </div>
                        <br>
                        <br>
                        <div class="col-md-12 mt-4 mb-1">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script>
        $('.select2').each(function() {
            $(this).select2({ theme: "bootstrap-5",dropdownParent: $(this).parent()});
        });

        document.addEventListener("DOMContentLoaded", function() {

            // Se inicializa el richText
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            // El contenido del richText se pasa a un input
            document.querySelector('#observacionForm').onsubmit = function() {
                const content = quill.root.innerHTML;
                document.querySelector('#anexo').value = content;
            };
        });
    </script>

</x-app-layout>