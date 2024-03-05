<x-app-layout>

    <x-slot:title>
        Editar AFP
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rrhh.afp.index') }}">AFP</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar AFP</li>
            </ol>
        </nav>
    </div>


    <div class="col-md-12 mb-3">
        <x-badge titulo="Editar AFP" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('rrhh.afp.update', $afp->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
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

                        {{-- AFP --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="afp">AFP</label><span class="text-danger">*</span>
                                <input name="afp" id="afp" value="{{ old('afp') ?: $afp->afp }}" type="text" class="form-control" max="90" required>
                            </div>
                        </div>

                        {{-- porcentaje empleador y empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="porciento_empleador">Porcentaje empleador</label><span class="text-danger">*</span>
                                <input class="form-control" id="porciento_empleador" name="porciento_empleador" type="number" step="0.01" min="0" value="{{ old('porciento_empleador') ?? $afp->porciento_empleador }}" required>
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="porciento_empleado">Porcentaje empleado</label><span class="text-danger">*</span>
                                <input class="form-control" id="porciento_empleado" name="porciento_empleado" type="number" step="0.01" min="0" value="{{ old('porciento_empleado') ?? $afp->porciento_empleado }}" required>
                            </div>
                        </div>

                        {{-- BOTON DE ENVIAR --}}
                        <div class="col-md-12 mb-3 mt-3">
                            <button class="btn btn-primary mb-2" style="color:white;" type="submit"> <i class="fas fa-save"></i>
                            </button>
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
