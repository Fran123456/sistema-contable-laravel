<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

    <x-slot:title>
      Crear cuenta contable
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contabilidad.cuentas-contables.index') }}">Catalogo de cuentas contables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear cuenta contable</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Agregar cuenta contable</h5>

                <form method="post" action="{{ route('contabilidad.cuentas-contables.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""><strong>Codigo</strong> </label>
                            <input type="text" name="codigo" required class="form-control">
                        </div>
                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""> <strong>Nombre cuenta</strong> </label>
                            <input type="text" name="nombre" required class="form-control">
                        </div>
                        <div class="col-md-4 mt-3 mb-2">
                            <label for=""> <strong>Cuenta padre</strong> </label>
                            <select  name="padre" data-placeholder="Seleccione la cuenta padre"
                                class="form-control chosen-select">
                                @foreach ($cuentas as $cuenta)
                                    <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} {{ $cuenta->nombre_cuenta }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <label for=""> <strong>Nivel de la cuenta</strong> </label>
                            <select required name="nivel" data-placeholder="Seleccione el nivel"
                                class="form-control chosen-select">
                                @foreach ($niveles as $nivel)
                                    <option value="{{ $nivel->id }}">{{ $nivel->nivel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for=""> <strong>Clasificación de la cuenta</strong> </label>
                            <select required name="clasificacion" data-placeholder="Seleccione la clasificación"
                                class="form-control chosen-select">
                                @foreach ($clasificacion as $cl)
                                    <option value="{{ $cl->id }}">{{ $cl->clasificacion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for=""> <strong>Activo</strong> </label>
                            <select required name="activo" data-placeholder="Seleccione si es activo o no"
                                class="form-control chosen-select">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for=""> <strong>Tipo de cuenta</strong> </label>
                            <select required name="tipo_cuenta" data-placeholder="Seleccione si es activo o no"
                                class="form-control chosen-select">
                                <option selected disabled value="">Seleccione...</option>
                                <option value="acreedora">Acreedora</option>
                                <option value="deudadora">Deudora</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-4 mb-1">
                            <button style="color: white" type="submit" class="btn btn-success"> <i
                                    class="fas fa-save"></i></button>
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
