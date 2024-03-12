<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Editar clasificacion de cliente
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.clasificacion.index')}}">Clasificacion de cliente</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar clasificacion cliente</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('socios.clasificacion.update', $tipo) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="socios_clasificacion"> <strong>Tipo de cliente</strong> </label>
                            <input type="text" name="tipo" class="form-control" value="{{$tipo->tipo}}" required>
                            @error('tipo')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="socios_descripcion"> <strong>Descripción</strong> </label>
                            <input type="text" name="descripcion" class="form-control" value="{{$tipo->descripcion}}">
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