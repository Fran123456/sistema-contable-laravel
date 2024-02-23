<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Crear cargo
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.cargo.index')}}">Cargos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear cargo</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('socios.cargo.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label for="socios_cargo"> <strong>Cargo</strong> </label>
                            <input type="text" name="cargo" class="form-control" required>
                            @error('cargo')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-8 mt-2">
                            <label for="cargo_descripcion"> <strong>Descripción</strong> </label>
                            <textarea name="descripcion" class="form-control" rows="10"></textarea>
                        </div>
                        <div class="col-md-12 mt-4 mb-1">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>