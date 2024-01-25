<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <x-slot:title>
        Crear Balance Empresa
    </x-slot>

    <x-slot:subtitle>
        Balance Contabilidad
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a>Contabilidad</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear Balance Empresa</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 mb-3">
        <x-badge titulo="Nuevo Balance" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('contabilidad.balance.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <x-errors></x-errors>
                        </div>

                        <div class=" row ">
                            <label for="">Balance</label>
                        </div>

                        {{-- titulo y descripcion empleado --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="titulo">Título</label><span class="text-danger">*</span>
                                <input name="titulo" id="titulo" value="{{ old('titulo') }}" type="text" class="form-control" max="255" required>
                            </div>
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="descripcion">Descripción</label><span class="text-danger">*</span>
                                <input name="descripcion" id="descripcion" value="{{ old('descripcion') }}" type="text" class="form-control" max="255">
                            </div>
                        </div>

                        {{-- campo y valor --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="campo">Campo</label>
                                <input name="campo" id="campo" value="{{ old('campo') }}" type="text" class="form-control" max="255" required>
                            </div>

                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="valor">Valor</label><span class="text-danger">*</span>
                                <input class="form-control" name="valor" id="valor" value="{{ old('valor') }}" type="phone" max="255" required>
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

</x-app-layout>
