<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <x-slot:title>
        Editar Balance Empresa
    </x-slot>

    <x-slot:subtitle>
        Balance Contabilidad
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a>Contabilidad</a></li>
            <li class="breadcrumb-item"><a>Balance</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Balance Empresa</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <div class="col-md-12 mb-3">
        <x-badge titulo="Editar Balance" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('contabilidad.balance.update', $balance->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <x-errors></x-errors>
                        </div>

                        <div class=" row ">
                            <label for="">Editar Balance</label>
                        </div>

                        {{-- titulo y descripcion empleado --}}
                        <div class=" row ">
                            <div class=" col-md-12 mt-2 mb-12 ">
                                <label for="titulo">Título</label>
                                <input name="titulo" id="titulo" value="{{ $balance->titulo }}" type="text"
                                    class="form-control" max="255" readonly>
                            </div>
                        </div>

                        <div class=" row ">
                            <div class=" col-md-12 mt-2 mb-12 ">
                                <label for="descripcion">Descripción</label>
                                <input name="descripcion" id="descripcion" value="{{ $balance->descripcion }}"
                                    type="text" class="form-control" max="255" readonly>
                            </div>
                        </div>

                        {{-- valor campo de texto --}}
                        <div class=" row ">
                            <div class=" col-md-6 mt-2 mb-12 ">
                                <label for="valor_text">Valor</label>
                                @if (!$balance->valor)
                                    <input class="form-control" name="valor" id="valor"
                                        value="{{ old('valor_text') ?: $balance->valor }}" type="phone"
                                        max="255">
                                @else
                                <div class="col-md-12 mt-2 mb-12">
                                    <select name="valor" class="form-select">
                                        @foreach ($opciones as $key => $item)
                                            <option name="valor_select" value="{{ $item->id }}"
                                                @if ((old('valor_select') == null && $balance->valor == $item->id) || old('valor_select') == $item->id) selected @endif>
                                                {{ $tipo == 'cuenta' ? $item->nombre_cuenta : $item->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
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
