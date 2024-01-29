<x-app-layout>

    <x-slot:title>
        Ver empleado
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
        <form>
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

                        {{-- nombre y apellido empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="nombres">Nombres</label>
                                <input name="nombres" id="nombres" readonly type="text" class="form-control" max="300" value="{{ $empleado->nombres }}">
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="apellidos">Apellidos</label>
                                <input name="apellidos" id="apellidos" readonly type="text" class="form-control" max="300" value="{{ $empleado->apellidos }}">
                            </div>
                        </div>

                        {{-- correo personal telefono empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="correo">Correo personal</label>
                                <input name="correo" id="correo" readonly type="text" class="form-control" max="200" value="{{ $empleado->correo }}">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="telefono">Teléfono</label>
                                <input class="form-control" name="telefono" id="telefono" readonly type="text" max="200" value="{{ $empleado->telefono }}">
                            </div>
                        </div>

                        {{-- correo institucional y direccion empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="correo_empresarial">Correo empresarial</label>
                                <input name="correo_empresarial" id="correo_empresarial" readonly type="text" class="form-control" max="200" value="{{ $empleado->correo_empresarial }}">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="direccion">Dirección</label>
                                <input name="direccion" id="direccion" readonly type="text" class="form-control" max="200" value="{{ $empleado->direccion }}">
                            </div>
                        </div>

                        {{-- edad  sexo y estado del empleado --}}
                        <div class="row">
                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="edad">Edad</label>
                                <input name="edad" id="edad" readonly type="text" class="form-control" pattern="^[0-9]+$" max="2" value="{{ $empleado->edad }}">
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="sexo">Sexo</label>
                                <select name="sexo" id="sexo" disabled class="form-select">
                                    <option value="Masculino" @if($empleado->sexo == 'Masculino') selected @endif>Masculino</option>
                                    <option value="Femenino" @if($empleado->sexo == 'Femenino') selected @endif>Femenino</option>
                                </select>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="estado">Estado Activo</label>
                                <select name="estado" id="estado" disabled class="form-select">
                                    <option value="1" @if($empleado->activo == 1) selected @endif>Activo</option>
                                    <option value="0" @if($empleado->activo == 0) selected @endif>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        {{-- codigo y tipo empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="codigo">Código</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" id="codigo" name="codigo" value="{{ old('codigo') ?: $empleado->codigo }}" readonly>
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="tipo_empleado">Tipo Empleado</label><span class="text-danger">*</span>
                                <select name="tipo_empleado" id="tipo_empleado" class="form-select" disabled>
                                    @foreach ($tipoEmpleado as $key => $item )
                                        <option @if( $empleado->tipo_empleado_id == $item->id ) selected @endif>{{ $item->tipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- fecha de nacimiento e ingreso --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                <input type="date" name="fecha_nacimiento" readonly id="fecha_nacimiento" class="form-control" value="{{ $empleado->fecha_nacimiento }}">
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="fecha_ingreso">Fecha de ingreso</label>
                                @csrf
                                <input type="date" name="fecha_ingreso" readonly id="fecha_ingreso" class="form-control" value="{{ $empleado->fecha_ingreso }}">
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

