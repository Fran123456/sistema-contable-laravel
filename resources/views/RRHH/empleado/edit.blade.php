<x-app-layout>

    <x-slot:title>
        Editar empleado
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/rrhh/empleado">Empleados</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar empleado</li>
            </ol>
        </nav>
    </div>


    <div class="col-md-12 mb-3">
        <x-badge titulo="Editar empleado" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <div class="text-start">
            <h6>Ficha de: {{ $empleado->nombre_completo }} </h6>
        </div>
        <form action="{{ route('rrhh.empleado.update', $empleado->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12">
                            <x-errors></x-errors>
                        </div>

                        <div class=" row ">
                            <label for="empleado">Empleado</label>
                        </div>

                        {{-- Foto del empleado --}}
                        @if( $foto )
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="foto">Foto</label>
                            </div>
                        </div>
                        <div class=" row ">
                                <div class=" col-md-12 mt-2 mb-12 ">
                                    <img src="data:image/*;base64, {{ $foto }}" alt="Imagen empleado" style=" max-width:400px; max-height:300px;">
                                </div>
                        </div>
                        @endif

                        {{-- Subir foto para actualizar --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="foto">Subir foto empleado</label>
                                <input class="form-control" type="file" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg">
                            </div>
                        </div>

                        {{-- nombre y apellido empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="nombres">Nombres</label><span class="text-danger">*</span>
                                <input name="nombres" id="nombres"  type="text" class="form-control" max="300" value="{{ old('nombres') ?: $empleado->nombres }}" required>
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="apellidos">Apellidos</label><span class="text-danger">*</span>
                                <input name="apellidos" id="apellidos"  type="text" class="form-control" max="300" value="{{ old('apellidos') ?: $empleado->apellidos }}" required>
                            </div>
                        </div>

                        {{-- correo personal telefono empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="correo">Correo personal</label>
                                <input name="correo" id="correo" type="text" class="form-control" max="200" value="{{ old('correo') ?: $empleado->correo }}">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="telefono">Teléfono</label><span class="text-danger">*</span>
                                <input class="form-control" name="telefono" id="telefono" type="text" max="200"  value="{{ old('telefono') ?: $empleado->telefono }}" required>
                            </div>
                        </div>

                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="correo_empresarial">Correo empresarial</label>
                                <input name="correo_empresarial" id="correo_empresarial" type="text" class="form-control" max="200" value="{{ old('correo_empresarial') ?: $empleado->correo_empresarial }}">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="direccion">Dirección</label><span class="text-danger">*</span>
                                <input name="direccion" id="direccion" type="text" class="form-control" max="200" value="{{ old('direccion') ?: $empleado->direccion }}" required>
                            </div>
                        </div>

                        {{-- edad  sexo y estado del empleado --}}
                        <div class="row">
                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="edad">Edad</label><span class="text-danger">*</span>
                                <input name="edad" id="edad" type="text" class="form-control" pattern="^[0-9]+$" max="2"  value="{{ old('edad') ?: $empleado->edad }}" required>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="sexo">Sexo</label><span class="text-danger">*</span>
                                <select name="sexo" id="sexo" class="form-select"  required>
                                    <option value="Masculino" @if( (old('sexo') == null && $empleado->sexo == "Masculino") || old('sexo') == "Masculino" ) selected @endif>Masculino</option>
                                    <option value="Femenino" @if( (old('sexo') == null && $empleado->sexo == "Femenino") || old('sexo') == "Femenino" ) selected @endif>Femenino</option>
                                </select>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="estado">Estado Activo</label><span class="text-danger">*</span>
                                <select name="estado" id="estado" class="form-select" required>
                                    <option value="1" @if( (old('estado') == null && $empleado->activo == 1) || old('estado') == '1') selected @endif>Activo</option>
                                    <option value="0" @if( (old('estado') == null && $empleado->activo == 0) || old('estado') == '0') selected @endif>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        {{-- codigo y tipo empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="codigo">Código</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" id="codigo" name="codigo" value="{{ old('codigo') ?: $empleado->codigo }}" required>
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="tipo_empleado">Tipo Empleado</label><span class="text-danger">*</span>
                                <select name="tipo_empleado" id="tipo_empleado" class="form-select" required>
                                    @foreach ($tipoEmpleado as $key => $item )
                                        <option value="{{ $item->id }}" @if( ( old('tipo_empleado') == null && $empleado->tipo_empleado_id == $item->id ) || old('tipo_empleado') == $item->id ) selected @endif>{{ $item->tipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- salarios --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="salario">Salario</label><span class="text-danger">*</span>
                                <input class="form-control" type="number" id="salario" name="salario" value="{{ old('salario') ?: $empleado->salario }}" required>
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="salario_diario">Salario diario</label><span class="text-danger">*</span>
                                <input class="form-control" type="number" id="salario_diario" name="salario_diario" value="{{ old('salario_diario') ?: $empleado->salario_diario }}" required>
                            </div>
                        </div>

                        {{-- fecha de nacimiento e ingreso --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="fecha_nacimiento">Fecha de nacimiento</label><span class="text-danger">*</span>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') ?: $empleado->fecha_nacimiento }}" required>
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="fecha_ingreso">Fecha de ingreso</label><span class="text-danger">*</span>
                                @csrf
                                <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso') ?: $empleado->fecha_ingreso }}" required>
                            </div>
                        </div>


                        <div class="row">
                            {{-- boton de guardado --}}
                            <div class="col-md-12 mb-3 mt-3">
                                <button class="btn btn-primary mb-2" style="color:white;" type="submit"> <i
                                        class="fas fa-save"></i>
                                </button>
                            </div>
                        </div>

                </div>
            </div>
        </form>
    </div>
    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>


</x-app-layout>

