<x-app-layout>

    <x-slot:title>
        Agregar Permiso
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
                <li class="breadcrumb-item"><a href="/rrhh/permiso">Permisos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Permisos</li>
            </ol>
        </nav>
    </div>


    <div class="col-md-12 mb-3">
        <x-badge titulo="Nuevo Permisos" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('rrhh.permisos.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <x-errors></x-errors>
                            <div class="col-md-12">
                                <x-alert></x-alert>
                            </div>
                        </div>

                        <div class=" row ">
                            <label for="">Permiso</label>
                        </div>

                        {{-- incapacidad periodo --}}
                        <div class=" row ">

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="empleado_id">Empleado</label><span class="text-danger">*</span>
                                <select name="empleado_id" id="empleado_id" class=" chosen-select form-select " required>
                                    @foreach ($empleados as $key => $item )
                                        <option value="{{ $item->id }}" @if( old('empleado_id') == $item->id || $loop->first ) selected @endif>{{ $item->codigo }} - {{ $item->nombre_completo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="periodo_planilla_id">Perido Planilla</label><span class="text-danger">*</span>
                                <select name="periodo_planilla_id" id="periodo_planilla_id" class="form-select" required>
                                    @foreach ($periodosPlanillas as $key => $item )
                                        <option value="{{ $item->id }}" @if( old('periodo_planilla_id') == $item->id || $loop->first ) selected @endif>{{ $item->mes_string }} - {{ $item->year }} {{ $item->tipo_periodo }} {{ $item->periodo_dias }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        {{-- salarios --}}
                        <div class=" row ">

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="fecha_inicio">Fecha de inicio</label><span class="text-danger">*</span>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') ?: date('Y-m-d') }}" class="form-control" required />
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="tipo_permiso_id">Tipo permiso</label><span class="text-danger">*</span>
                                <select name="tipo_permiso_id" id="tipo_permiso_id" class="form-select" required>
                                    @foreach ($tipoPermisos as $key => $item )
                                        <option value="{{ $item->id }}" @if( old('tipo_permiso_id') == $item->id || $loop->first ) selected @endif>{{ $item->tipo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="cantidad">Cantidad</label><span class="text-danger">*</span>
                                <input class="form-control" name="cantidad" id="cantidad" type="number" min="1" value="{{ old('cantidad') ?: 1 }}" required>
                            </div>

                        </div>

                        <div id="descripcion_row" class=" row d-none">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="descripcion">Descripción</label>
                                <input class="form-control" id="descripcion" name="descripcion" type="text" value="{{ old('descripcion') ?: ' ' }}">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener referencias a los select
            const tipoPermiso = document.getElementById('tipo_permiso_id');
            const descripcionRow = document.getElementById('descripcion_row');
            const descripcion = document.getElementById('descripcion');

            tipoPermiso.addEventListener('change', function() {
                let permiso = tipoPermiso.options[tipoPermiso.selectedIndex].textContent;

                if( permiso.toLowerCase() === 'otros' || permiso.toLowerCase() === 'otro' ){
                    descripcionRow.classList.remove('d-none');
                    descripcion.value = '';
                } else {
                    descripcionRow.classList.add('d-none');
                }
            });

        });
    </script>
</x-app-layout>
