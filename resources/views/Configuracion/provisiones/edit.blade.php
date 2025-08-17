<x-app-layout>
    <x-slot:title>
        Editar una provision
      </x-slot>

      <x-slot:subtitle>
      </x-slot>


    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('configuracion.provisiones.index') }}">Provisiones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Provision</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <form method="post" action="{{ route('configuracion.provisiones.update', $provision->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""><strong>Empresa</strong> </label>
                            <select name="empresa" id="empresa" required class="form-control">
                                <option value="">Seleccione una empresa</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}" {{ isset($provision) && $provision->empresa_id == $empresa->id ? 'selected' : '' }}>
                                        {{ $empresa->empresa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                    
                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""><strong>Tipo Provision</strong> </label>
                            <select name="tipo_provision" class="form-control" required>
                                <option value="aguinaldo" @if ($provision->tipo_provision == 'aguinaldo') selected @endif>Aguinaldo</option>
                                <option value="vacaciones" @if ($provision->tipo_provision == 'vacaciones') selected @endif>Vacaciones</option>
                                <option value="indemnización" @if ($provision->tipo_provision == 'indemnización') selected @endif>Indemnización</option>
                            </select>
                        </div>
                  
                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""><strong>Porcentaje</strong> </label>
                            <input type="text" name="porcentaje"  value="{{ $provision->porcentaje }}" class="form-control" max="10">
                        </div>
                    
                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""><strong>Fecha Inicio</strong> </label>
                            <input type="date" name="fecha_inicio"  value="{{ $provision->fecha_inicio }}" class="form-control" max="10">
                        </div>
                    
                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""><strong>Fecha Fin</strong> </label>
                            <input type="date" name="fecha_fin"  value="{{ $provision->fecha_fin }}" class="form-control" max="10">
                        </div>

                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""><strong>Descripcion</strong> </label>
                            <input type="text" name="descripcion"  value="{{ $provision->descripcion }}" class="form-control" max="10">
                        </div>

                        <div class="col-md-4 mt-3 mb-2" id="contrato_field">
                            <label for="tipo_empleado"><strong>Tipo Empleado</strong></label>
                            <select name="tipo_empleado" id="tipo_empleado" class="form-control">
                                <option value="">Seleccione un tipo de contrato</option>
                                @foreach ($tipos_empleado as $tipo)
                                    <option value="{{ $tipo->id }}" {{ isset($provision) && $provision->tipo_contrato_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->tipo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""><strong>Estado</strong> </label>
                            <select name="estado" class="form-control">
                                <option value="1" @if ($provision->estado) selected @endif>Activo</option>
                                <option value="0" @if (!$provision->estado) selected @endif>Inactivo</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 mt-4 mb-1">
                            <button style="color: white" type="submit" class="btn btn-warning">
                                <i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                </form>



            </div>

        </div>

    </div>

    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>

</x-app-layout>
