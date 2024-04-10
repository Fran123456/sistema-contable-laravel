<x-app-layout>
    <x-chosen></x-chosen>
    <x-slot:title>
        Editar configuración
     </x-slot>

    <x-slot:subtitle>
    </x-slot>
   
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contabilidad.configuracion') }}">Configuración contable</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar configuración</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('contabilidad.updateConfiguracion', $data->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <h5>Configuración contable:  {{ Help::codigoPartida($data)  }} </h5>
                    <div class="row">
                        <div class="col-md-5 mt-2">
                            <label for=""> <strong>Cuenta contable</strong></label>
                            <select name="cuenta" class="chosen-select form-control" id="">
                                @foreach ($cuentas as $cuenta)
                                    @if ($cuenta->clasificacion != null)
                                        <option value="{{ $cuenta->id }}">{{ strval($cuenta->codigo) }} -
                                            {{ $cuenta->nombre_cuenta }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for=""><strong>Código</strong></label>
                            <input value="{{$data->codigo}}" name="codigo" type="text" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for=""><strong>Balance</strong></label>
                            <input value="{{$data->balance}}" name="balance" type="text" class="form-control" readonly>
                        </div>
                        <div class="col-md-5 mt-2">
                            <label for=""><strong>Grupo</strong></label>
                            <input value="{{$data->grupo}}" name="balance" type="text" class="form-control" readonly>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar </button>
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
