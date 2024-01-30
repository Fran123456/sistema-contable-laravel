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
                <li class="breadcrumb-item"><a href="/rrhh/periodo-planilla/index">Periodos Planilla</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Periodo Planilla</li>
            </ol>
        </nav>
    </div>


    <div class="col-md-12 mb-3">
        <x-badge titulo="Editar periodo planilla" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('rrhh.periodoPlanilla.update', $periodo->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12">
                            <x-errors></x-errors>
                        </div>

                        <div class=" row ">
                            <label for="empleado">Periodo Planilla</label>
                        </div>

                        {{-- year mes --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="year">Año</label>
                                <input name="year" id="year" required type="number" class="form-control"
                                    max="2024" value="{{ $periodo->year }}">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="mes">Mes</label>
                                <select name="mes" id="mes" class="form-control" required>
                                    <option value="1" @if ($periodo->mes == 1) selected @endif>Enero
                                    </option>
                                    <option value="2" @if ($periodo->mes == 2) selected @endif>Febrero
                                    </option>
                                    <option value="3" @if ($periodo->mes == 3) selected @endif>Marzo
                                    </option>
                                    <option value="4" @if ($periodo->mes == 4) selected @endif>Abril
                                    </option>
                                    <option value="5" @if ($periodo->mes == 5) selected @endif>mayo
                                    </option>
                                    <option value="6" @if ($periodo->mes == 6) selected @endif>Junio
                                    </option>
                                    <option value="7" @if ($periodo->mes == 7) selected @endif>Julio
                                    </option>
                                    <option value="8" @if ($periodo->mes == 8) selected @endif>Agosto
                                    </option>
                                    <option value="9" @if ($periodo->mes == 9) selected @endif>Septiembre
                                    </option>
                                    <option value="10" @if ($periodo->mes == 10) selected @endif>Octubre
                                    </option>
                                    <option value="11" @if ($periodo->mes == 11) selected @endif>Noviembre
                                    </option>
                                    <option value="12" @if ($periodo->mes == 12) selected @endif>Diciembre
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- tipo_periodo periodo_dias activo --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="tipo_periodo">Tipo Periodo</label>
                                <select name="tipo_periodo" id="tipo_periodo" class="form-control" required>
                                    <option value="mensual" @if ($periodo->tipo_periodo == 'mensual') selected @endif>Mensual
                                    </option>
                                    <option value="quincenal" @if ($periodo->tipo_periodo == 'quincenal') selected @endif>
                                        Quincenal</option>
                                </select>
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="periodo_dias">Periodo Dias</label>
                                <select name="periodo_dias" id="periodo_dias" class="form-control" required>
                                    <option value="01-15" @if ($periodo->periodo_dias == '01-15') selected @endif>01 - 15
                                    </option>
                                    <option value="16-30" @if ($periodo->periodo_dias == '16-30') selected @endif>16 - 30
                                    </option>
                                </select>
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="activo">Activo</label>
                                <select name="activo" id="activo" class="form-control" required>
                                    <option value="true" @if ($periodo->activo == true) selected @endif>Activo
                                    </option>
                                    <option value="false" @if ($periodo->activo == false) selected @endif>No Activo
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class=" row ">
                            <select class="form-control" name="opcion_1">
                                <option value="1">Opción 1</option>
                                <option value="2">Opción 2</option>
                            </select>

                            <select name="opcion_2">
                                @if ($opcion_1 == 1)
                                    <option value="1">Opción 1</option>
                                @else
                                    <option value="1">Opción 1</option>
                                    <option value="2">Opción 2</option>
                                @endif
                            </select>

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
