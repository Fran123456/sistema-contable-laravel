<x-app-layout>

    <x-slot:title>
        Agregar Empleado
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
                <li class="breadcrumb-item"><a href="/users">Empleados</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear empleado</li>
            </ol>
        </nav>
    </div>


    <div class="col-md-12 mb-3">
        <x-badge titulo="Nuevo empleado" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('rrhh.empleado.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <x-errors></x-errors>
                        </div>

                        <div class=" row ">
                            <label for="">Empleado</label>
                        </div>

                        {{-- nombre y apellido empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="nombres">Nombres</label><span class="text-danger">*</span>
                                <input name="nombres" id="nombres" value="{{ old('nombres') }}" required type="text" class="form-control" max="300">
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="apellidos">Apellidos</label><span class="text-danger">*</span>
                                <input name="apellidos" id="apellidos" value="{{ old('apellidos') }}" required type="text" class="form-control" max="300">
                            </div>
                        </div>

                        {{-- correo personal telefono empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="correo">Correo personal</label>
                                <input name="correo" id="correo" value="{{ old('correo') }}" type="text" class="form-control" max="200">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="telefono">Teléfono</label><span class="text-danger">*</span>
                                <input class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}" type="phone" max="200" required>
                            </div>
                        </div>

                        {{-- correo institucional y direccion empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="correo_empresarial">Correo empresarial</label>
                                <input name="correo_empresarial" id="correo_empresarial" value="{{ old('correo_empresarial') }}" type="text" class="form-control" max="200">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="direccion">Dirección</label><span class="text-danger">*</span>
                                <input name="direccion" id="direccion" value="{{ old('direccion') }}" type="text" class="form-control" max="200">
                            </div>
                        </div>

                        {{-- edad  sexo y estado del empleado --}}
                        <div class="row">
                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="edad">Edad</label><span class="text-danger">*</span>
                                <input name="edad" id="edad" value="{{ old('edad') }}" type="text" class="form-control" pattern="^[0-9]+$" max="2" required>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="sexo">Sexo</label><span class="text-danger">*</span>
                                <select name="sexo" id="sexo" class="form-select" required>
                                    <option value="Masculino" @if( old('sexo') == 'Masculino') selected @endif>Masculino</option>
                                    <option value="Femenino" @if( old('sexo') == 'Femenino') selected @endif>Femenino</option>
                                </select>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="estado">Estado Activo</label><span class="text-danger">*</span>
                                <select name="estado" id="estado" class="form-select" required>
                                    <option value="1" selected @if( old('estado') == '1') selected @endif>Activo</option>
                                    <option value="0" @if( old('estado') == '0') selected @endif>Inactivo</option>
                                </select>
                            </div>
                        </div>


                        {{-- fecha de nacimiento e ingreso --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="fecha_nacimiento">Fecha de nacimiento</label><span class="text-danger">*</span>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control" required />
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="fecha_ingreso">Fecha de ingreso</label><span class="text-danger">*</span>
                                <input type="date" name="fecha_ingreso" id="fecha_ingreso" value="{{ old('fecha_ingreso') }}" class="form-control" required />
                            </div>
                        </div>

                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12">
                                <label for="anuncio">Los campos con un <span class="text-danger">*</span> son obligatorios.</label>
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