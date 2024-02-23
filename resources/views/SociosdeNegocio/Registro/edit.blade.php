<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Editar cargo
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.registro.show', $registro->contacto->id)}}">Observaciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar cargo</li>
        </ol>

    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('socios.registro.update', $registro) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-12">
                            <label for="socios_registro"> <strong>Observación</strong> </label>
                            <textarea name="observacion" class="form-control" requiredcols="30" rows="10">{{$registro->observacion}}</textarea>
                            @error('observacion')
                                {{$message}}
                            @enderror
                        </div>
                        <input type="hidden" name="contacto_id" id="contacto_id" value="{{$contactoId}}">
                        <div class="col-md-12 mt-3 mb-3 ">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>