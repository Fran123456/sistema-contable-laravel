<x-app-layout>
    <x-chosen></x-chosen>
    <x-slot:title>
        Crear puesto
    </x-slot>
    
    <x-slot:subtitle>
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="/rrhh/puesto">Puesto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear puesto</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('rrhh.puesto.store') }}" method="post"> 
                    @csrf       
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label for=""> <strong>Cargo</strong></label>
                            <input type="text" name="cargo"  required class="form-control">
                            @error('cargo')
                                {{$message}}
                            @enderror 
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="area"><strong>Area</strong></label>
                                <select  id="area" name="area_id" class="form-control">
                                    <!-- Opciones para las áreas, ya cargadas al cargar la página -->
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="departamento"><strong>Departamento</strong></label>
                                <select  id="departamento" name="departamento_id" class="form-control">
                                <!-- Opciones de departamentos que se cargarán dinámicamente con jQuery -->
                                </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for=""> <strong>Activo</strong></label>
                            <select required id="activo" name="activo" class="form-control">
                                <option value="1">Activo</option>                                     
                                <option value="0">Inactivo</option>                                     
                            </select>
                        </div>
                        <div>
                            <input type="hidden" name="empresa_id" value="{{$empresa_id}}"  class="form-control">                       
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
            // Manejar el cambio en el select de áreas
            $('#area').on('change',function () {
                var areaId = $(this).val(); // Obtener el ID del área seleccionada
                // Realizar una solicitud AJAX para obtener los departamentos
                $.ajax({
                    url: '/rrhh/obtener-departamentos/' + areaId, // Ruta para obtener departamentos según el área
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Limpiar y llenar el select de departamentos con los datos recibidos
                        $('#departamento').empty();
                        $.each(data, function (key, value) {
                            $('#departamento').append('<option value="'+ value.id +'">' + value.departamento + '</option>');
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