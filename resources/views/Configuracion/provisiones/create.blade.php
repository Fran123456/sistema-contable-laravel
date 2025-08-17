<x-app-layout>

    <x-slot:title>
        Agregar Provision
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('configuracion.provisiones.index') }}">Provisiones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear Provisiones</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('configuracion.provisiones.store') }}">
                    <div class="row">
                        @csrf
                        <div class="col-md-4   mt-2 mb-21">
                            <label for="">Empresa</label>
                            <select name="empresa" id="empresa" required class="form-control">
                                <option value="">Seleccione una empresa</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->empresa }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4   mt-2 mb-21">
                            <label for="">Tipo Provision</label>
                            <select name="tipo_provision" class="form-control" required>
                                <option value="aguinaldo">Aguinaldo</option>
                                <option value="vacaciones">Vacaciones</option>
                                <option value="indemnización">Indemnización</option>
                            </select>
                        </div>

                        <div class="col-md-4   mt-2 mb-21">
                            <label for="">Porcentaje</label>
                            <input name="porcentaje" type="number" min="0" max="100" step="0.01" class="form-control" required>
                        </div>

                        <div class="col-md-4   mt-2 mb-21">
                            <label for="">Fecha Inicio</label>
                            <input name="fecha_inicio" type="date" class="form-control" required>
                        </div>

                        <div class="col-md-4   mt-2 mb-21">
                            <label for="">Fecha Fin</label>
                            <input name="fecha_fin" type="date" class="form-control" required>
                        </div>

                        <div class="col-md-4   mt-2 mb-21">
                            <label for="">Descripcion</label>
                            <input name="descripcion" type="text" class="form-control">
                        </div>

                        <div class="col-md-4   mt-2 mb-21">
                            <label for="">Tipo Empleado</label>
                            <select name="tipo_empleado" id="tipo_empleado" class="form-control" required>
                                <option value="">Seleccione un tipo de empleado</option>
                                @foreach ($tipos_empleado as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4   mt-2 mb-21">
                            <label for="">Estado</label>
                            <select name="estado" id="estado" class="form-control" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3 mt-3">
                            <button class="btn btn-primary mb-2" style="color:white;" type="submit"> <i
                                    class="fas fa-save"></i>
                            </button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</x-app-layout>
