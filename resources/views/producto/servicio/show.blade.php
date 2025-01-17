<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
        Ver servicio
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('producto.servicio.index')}}">Sercicios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ver servicio</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="codigo"> <strong>Codigo</strong> </label>
                            <input type="text" name="codigo" class="form-control" value="{{$servicio->codigo}}" disabled>
                            @error('codigo')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="nombre"> <strong>Nombre</strong> </label>
                            <input type="text" name="nombre" class="form-control" value="{{$servicio->nombre}}" disabled >
                            @error('nombre')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="cuenta_contable_ingreso"> <strong>cuenta ingreso</strong> </label>
                            <select id="" name="cuenta_contable_ingreso" class="chosen-select form-select" disabled>
                                <option value="">Selecciona una opción</option> 
                                 @foreach ($cuentas as $cuenta)
                                     <option @if ($servicio->cuenta_contable_ingreso == $cuenta->id) selected @endif value="{{$cuenta->id}}">{{$cuenta->codigo . ' - ' . $cuenta->nombre_cuenta}}</option>
                                 @endforeach
                             </select>
                            @error('cuenta_contable_ingreso')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="cuenta_contable_costo"> <strong>cuenta costo</strong> </label>
                            <select id="" name="cuenta_contable_costo" class="chosen-select form-select" disabled>
                                <option value="">Selecciona una opción</option> 
                                 @foreach ($cuentas as $cuenta)
                                     <option @if ($servicio->cuenta_contable_costo == $cuenta->id) selected @endif value="{{$cuenta->id}}">{{$cuenta->codigo . ' - ' . $cuenta->nombre_cuenta}}</option>
                                 @endforeach
                             </select>
                            @error('cuenta_contable_costo')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="cuenta_contable_ingreso_exterior"> <strong>cuenta ingreso exterior</strong> </label>
                            <select id="" name="cuenta_contable_ingreso_exterior" class="chosen-select form-select" disabled>
                                <option value="">Selecciona una opción</option> 
                                 @foreach ($cuentas as $cuenta)
                                     <option @if ($servicio->cuenta_contable_ingreso_exterior == $cuenta->id) selected @endif value="{{$cuenta->id}}">{{$cuenta->codigo . ' - ' . $cuenta->nombre_cuenta}}</option>
                                 @endforeach
                             </select>
                            @error('cuenta_contable_ingreso_exterior')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="cuenta_contable_costo_exterior"> <strong>cuenta costo exterior</strong> </label>
                            <select id="" name="cuenta_contable_costo_exterior" class="chosen-select form-select" disabled>
                                <option value="">Selecciona una opción</option> 
                                 @foreach ($cuentas as $cuenta)
                                     <option @if ($servicio->cuenta_contable_costo_exterior == $cuenta->id) selected @endif value="{{$cuenta->id}}">{{$cuenta->codigo . ' - ' . $cuenta->nombre_cuenta}}</option>
                                 @endforeach
                             </select>
                            @error('cuenta_contable_costo_exterior')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-12 mt-4 mb-1">
                            <a href="{{ route('producto.servicio.index') }}" class="btn btn-danger" style="color:aliceblue" type="submit">Regresar</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
</x-app-layout>