<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Facturacion Electronica Express
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Facturacion Electronica Express</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('pos.facturacionexpress.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label for="pos_tipo_documento"> <strong>Tipo de documento</strong> </label>
                            <input type="text" name="tipo_documento" class="form-control" required>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="pos_cliente"> <strong>Cliente</strong> </label>
                            <select name="cliente_id" class="chosen-select form-control" id="">
                                @foreach ($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mt-4 mb-1">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
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