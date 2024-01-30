<x-app-layout>

    <x-slot:title>
        Agregar Periodo Planilla
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
                <li class="breadcrumb-item"><a href="/rrhh/periodo-planilla">Periodo Planilla</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Periodo Planilla</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-12 mb-3">
        <x-badge titulo="Nuevo Periodo Planilla" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('rrhh.periodoPlanilla.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <x-errors></x-errors>
                        </div>
                        <div class="col-md-12">
                            <x-alert></x-alert>
                        </div>

                        <div class=" row ">
                            <label for="empleado">Periodo Planilla</label>
                        </div>

                        {{-- year mes --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="year">Año</label>
                                {{-- <input name="year" id="year" type="number" class="form-control" min="2024" value="{{ old('year') }}" > --}}
                                @php
                                    $anioActual = date('Y');
                                @endphp
                                <select name="year" id="year" class="form-control" required>
                                    @for ($anio = 2024; $anio <= $anioActual; $anio++)
                                        <option value="{{ $anio }}" @if ( $anio == $anioActual ) selected @endif>{{ $anio }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="mes">Mes</label>
                                <select name="mes" id="mes" class="form-control" required>
                                    <option value="1" @if (old('mes') == 1) selected @endif>Enero
                                    </option>
                                    <option value="2" @if (old('mes') == 2) selected @endif>Febrero
                                    </option>
                                    <option value="3" @if (old('mes') == 3) selected @endif>Marzo
                                    </option>
                                    <option value="4" @if (old('mes') == 4) selected @endif>Abril
                                    </option>
                                    <option value="5" @if (old('mes') == 5) selected @endif>mayo
                                    </option>
                                    <option value="6" @if (old('mes') == 6) selected @endif>Junio
                                    </option>
                                    <option value="7" @if (old('mes') == 7) selected @endif>Julio
                                    </option>
                                    <option value="8" @if (old('mes') == 8) selected @endif>Agosto
                                    </option>
                                    <option value="9" @if (old('mes') == 9) selected @endif>Septiembre
                                    </option>
                                    <option value="10" @if (old('mes') == 10) selected @endif>Octubre
                                    </option>
                                    <option value="11" @if (old('mes') == 11) selected @endif>Noviembre
                                    </option>
                                    <option value="12" @if (old('mes') == 12) selected @endif>Diciembre
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- tipo_periodo periodo_dias activo --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="tipo_periodo">Tipo Periodo</label>
                                <select name="tipo_periodo" id="tipo_periodo" class="form-control" required>
                                    <option value="mensual" @if (old('tipo_periodo') == 'mensual') selected @endif>Mensual
                                    </option>
                                    <option value="quincenal" @if (old('tipo_periodo') == 'quincenal') selected @endif>
                                        Quincenal</option>
                                </select>
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="periodo_dias">Periodo Dias</label>
                                <select name="periodo_dias" id="periodo_dias" class="form-control" required>

                                    @if (old('tipo_periodo') == 'quincenal')
                                        <option value="01-15" @if (old('periodo_dias') == '01-15') selected @endif>01 -
                                            15</option>
                                        <option value="16-30" @if (old('periodo_dias') == '16-30') selected @endif>16 -
                                            30</option>
                                    @else
                                        <option value="01-30" @if (old('periodo_dias') == '01-30' || !old('periodo_dias')) selected @endif>01 -
                                            30</option>
                                    @endif
                                </select>
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="activo">Activo</label>
                                <select name="activo" id="activo" class="form-control" required>
                                    <option value='true' @if (old('activo') == 'true') selected @endif>Activo
                                    </option>
                                    <option value='false' @if (old('activo') == 'false') selected @endif>No Activo
                                    </option>
                                </select>
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
            const tipoPeriodo = document.getElementById('tipo_periodo');
            const periodoDias = document.getElementById('periodo_dias');

            // periodoDias.selectedIndex = 0;

            // Manejar el evento change del primer select
            tipoPeriodo.addEventListener('change', function() {
                // Limpiar las opciones actuales del segundo select
                periodoDias.innerHTML = '';

                // Obtener el valor seleccionado del primer select
                let opcionSeleccionada = tipoPeriodo.value;

                // Agregar las opciones al segundo select según la opción seleccionada en el primero
                if (opcionSeleccionada === 'mensual') {
                    // Agregar una opción específica si se selecciona la primera opción
                    let opcion = document.createElement('option');
                    opcion.value = '01-30';
                    opcion.text = '01 - 30';
                    periodoDias.appendChild(opcion);

                    // Deshabilitar el segundo select y seleccionar automáticamente la opción
                    // periodoDias.selectedIndex = 0;
                    // periodoDias.disabled = true;

                } else if (opcionSeleccionada === 'quincenal') {
                    // Agregar dos opciones si se selecciona la segunda opción
                    let opcion1 = document.createElement('option');
                    opcion1.value = '01-15';
                    opcion1.text = '01 - 15';
                    periodoDias.appendChild(opcion1);

                    let opcion2 = document.createElement('option');
                    opcion2.value = '16-30';
                    opcion2.text = '16 - 30';
                    periodoDias.appendChild(opcion2);

                    // Habilitar el segundo select
                    periodoDias.disabled = false;
                }
            });
        });
    </script>

</x-app-layout>
