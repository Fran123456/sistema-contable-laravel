<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Crear area
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="/rrhh/areas">Areas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear areas</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('rrhh.area.store') }}" method="post"> 
                    @csrf       
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for=""> <strong>Area</strong></label>
                            <input type="text" name="area"  required class="form-control">
                            @error('area')
                                {{$message}}
                            @enderror
                        </div>
                                                
                        <div class="col-md-3 mt-2">
                            <label for=""> <strong>Activo</strong></label>
                            <select required id="activo" name="activo" class="form-control" id="">
                                <option value="1">Activo</option>                                     
                                <option value="0">Inactivo</option>                                     
                            </select>
                        </div>
                        <div>
                            <input type="hidden" name="empresa_id" value="{{ $empresa_id }}" required class="form-control">                       
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