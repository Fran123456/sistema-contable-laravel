<x-app-layout>

    <x-slot:title>
        Agregar Ingreso
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
                <li class="breadcrumb-item"><a href="/">RRHH</a></li>
                <li class="breadcrumb-item"><a href="/rrhh/ingreso">Ingreso</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Ingreso</li>
            </ol>
        </nav>
    </div>


    <div class="col-md-12 mb-3">
        <x-badge titulo="Nuevo Ingreso" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('rrhh.ingreso.store') }}" method="post" enctype="form-data">
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

                        {{-- Empleado, Planilla y Tipo Ingreso --}}
                        <div class=" row ">
                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="empleado">Empleado</label><span class="text-danger">*</span>
                                <select name="empleado" id="empleado" class=" chosen-select form-select " required>
                                    @foreach ($empleados as $key => $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('empleado') == $item->id || $loop->first) selected @endif>{{ $item->codigo }} -
                                            {{ $item->nombre_completo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="planilla">planilla</label><span class="text-danger">*</span>
                                <select name="planilla" id="planilla" class=" chosen-select form-select " required>
                                    @foreach ($planillas as $key => $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('planilla') == $item->id || $loop->first) selected @endif>{{ $item->mes_string }} -
                                            {{ $item->year }} {{ $item->tipo_periodo }} {{ $item->periodo_dias }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="tipo_ingreso">Tipo Ingreso</label><span class="text-danger">*</span>
                                <select name="tipo_ingreso" id="tipo_ingreso" class=" chosen-select form-select "
                                    required>
                                    @foreach ($tiposIngreso as $key => $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('tipo_ingreso') == $item->id || $loop->first) selected @endif>{{ $item->tipo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        {{-- salarios --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="cantidad">Cantidad</label><span class="text-danger">*</span>
                                <input class="form-control" id="cantidad" name="cantidad" type="number"step="0.01"
                                    min="0" value="{{ old('salario') }}" required>
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="fecha">Fecha</label><span
                                    class="text-danger">*</span>
                                <input type="date" name="fecha" id="fecha"
                                    value="{{ old('fecha') }}" class="form-control" required />
                            </div>
                        </div>

                        {{-- Descripcion --}}
                        <div class=" row ">
                            <div class=" col-md-8 mt-2 mb-12 ">
                                <label for="descripcion">Descripcion</label>
                                <input name="descripcion" id="descripcion" value="{{ old('descripcion') }}" type="text"
                                    class="form-control">
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
