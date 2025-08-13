<x-app-layout>

    <x-slot:title>
        Editar Empresa
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
                <li class="breadcrumb-item"><a href="{{ route('rrhh.empleado.index') }}">Configuracion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar empresa</li>
            </ol>
        </nav>
    </div>


    <div class="col-md-12 mb-3">
        <x-badge titulo="Editar empresa" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('configuracion.gestionempresas.update', $empresa->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <x-errors></x-errors>
                        </div>
                        <div class="col-md-12">
                            <x-alert></x-alert>
                        </div>

                        

                        {{-- nombre y nit de la empresa--}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="nombres">Nombres</label><span class="text-danger">*</span>
                                <input name="nombre_empresa" id="nombre_empresa" value="{{ $empresa->nombre_empresa }}" required
                                    type="text" class="form-control" max="300">
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="">NIT</label><span class="text-danger">*</span>
                                <input name="nit" id="nit" value="{{ $empresa->nit }}" placeholder="0000-000000-000-0" required
                                    type="text" class="form-control" max="300">
                            </div>
                        </div>

                        {{-- nrc y direccion --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="">NRC</label>
                                <input name="nrc" id="nrc" value="{{ $empresa->nrc }}" type="text"
                                    class="form-control" max="200">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="">Dirección</label><span class="text-danger">*</span>
                                <input class="form-control" name="direccion" id="direccion" value="{{ $empresa->direccion }}"
                                    type="text" max="200" required>
                            </div>
                        </div>

                        {{-- email, telefono de la empresa --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="">Correo de la empresa</label>
                                <input name="email" id="email_empresa"
                                    value="{{ $empresa->email }}" type="email" class="form-control"
                                    max="200">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="direccion">Teléfono</label><span class="text-danger">*</span>
                                <input name="telefono_empresa" id="telefono" value="{{ $empresa->telefono_empresa }}" type="phone"
                                    class="form-control" max="200">
                            </div>
                        </div>

                        {{-- representante legal y telefono del representante --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="correo_empresarial">Representante legal</label>
                                <input name="representante_legal" id="repre_legal"
                                    value="{{ $empresa->representante_legal }}" type="text" class="form-control"
                                    max="200">
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="direccion">Teléfono representante legal</label><span class="text-danger">*</span>
                                <input name="telefono_repre_legal" id="telefono_repre_legal" value="{{ $empresa->telefono_repre_legal }}" type="phone"
                                    class="form-control" max="200">
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="edad">Responsable del contrato</label><span class="text-danger">*</span>
                                <input name="responsable_contrato" id="responsable_contrato" value="{{ $empresa->responsable_contrato }}" type="text"
                                    class="form-control" required>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="edad">Fecha del contrato</label><span class="text-danger">*</span>
                                <input name="fecha_contrato" id="fecha_contrato" value="{{ \Carbon\Carbon::parse($empresa->fecha_contrato)->format('Y-m-d') }}" type="date"
                                    class="form-control" required>
                            </div>

                            <div class=" col-md-4 mt-2 mb-12 ">
                                <label for="">Estado</label><span class="text-danger">*</span>
                                <select name="estado_id" id="estado" class="form-select" required>
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado->id }}" {{ $empresa->estado_id == $estado->id ? 'selected' : '' }}>
                                            {{ $estado->estado }}
                                        </option>
                                    @endforeach
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
        document.getElementById('nit').addEventListener('input', function(e) {
        
        let input = e.target;
        let value = input.value.replace(/\D/g, ''); // Solo números
        
        
        if (value.length > 0) {
            value = value.match(new RegExp('.{1,15}'))[0]; 
            
            
            let formatted = '';
            if (value.length > 0) formatted = value.substring(0, 4);
            if (value.length > 4) formatted += '-' + value.substring(4, 10);
            if (value.length > 10) formatted += '-' + value.substring(10, 13);
            if (value.length > 13) formatted += '-' + value.substring(13, 14);
            
            input.value = formatted;
        }
        });
    </script>


</x-app-layout>
