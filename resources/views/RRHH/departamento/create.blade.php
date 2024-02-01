<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Crear departamento
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="/rrhh/departamento">Departamentos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear departamento</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('rrhh.departamento.store') }}" method="post"> 
                    @csrf       
                    <div class="row">
                        <div class="col-md-8 mt-2">
                            <label for=""> <strong>Departamento</strong></label>
                            <input type="text" name="departamento"  required class="form-control">
                            @error('departamento')
                                {{$message}}
                            @enderror 
                        </div>
                                                
                        <div class="col-md-4 mt-2">
                            <label for=""> <strong>Area</strong></label>
                            <select required id="area_id" name="area_id" class="form-control" id="">
                                @foreach ($areas as $area)
                                    <option value="{{$area->id}}">{{$area->area}}</option>                                                                      
                                @endforeach    
                            </select>
                        </div>
                        <div>
                            <input type="hidden" name="empresa_id" value="{{$empresa_id}}"  class="form-control">                       
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