<x-app-layout>
    <x-slot:title>
        Lista de Facturaciones
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('facturacion.index') }}">Facturación</a></li>
            <li class="breadcrumb-item active" aria-current="page">Documento</li>
        </ol>
    </div>
   

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Orden Venta: {{ $ov->codigo }}</h5>
                <h6>Cliente: {{ $ov->cliente->nombre }} {{ $ov->cliente->apellido }}</h6>
                <p>
                    Dui: {{ $ov->cliente->dui ?? 'Sin documento' }} <br>
                    Nit: {{ $ov->cliente->nit ?? 'Sin documento' }} <br>
                    Correo: {{ $ov->cliente->correo ?? 'Sin correo' }} <br>
                    Tipo cliente: {{ $ov->cliente->tipo_cliente ?? 'Sin clasificación' }}

                </p>
            </div>
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Documento: {{ $ov->documentos[0]->tipoDocumento?->tipo }}</h5>

                <form action="{{ route('facturacion.agregarItemsFactura', $ov->id) }}" method="get">
                    <div class="row">
                        <div class="col-md-9">
                            <label for=""> <strong>Items</strong> </label>
                            <select class="form-select w-100" id="items" name="items">
                                <option selected disabled>Seleccione...</option>
                                @foreach ($servicios as $ser)
                                    <option value="S-{{ $ser->id }}">{{ $ser->codigo }} - {{ $ser->nombre }}
                                    </option>
                                @endforeach

                                @foreach ($productos as $pro)
                                    <option value="P-{{ $pro->id }}">{{ $pro->codigo }} - {{ $pro->producto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <div >
                                <button class="btn btn-success mr-2 ml-2 pr-2 pl-2">Buscar</button>
                            <a href="{{ route('facturacion.agregarItemsFactura', $ov->id) }}"
                                class="btn btn-warning mr-2 ml-2 pr-2 pl-2">Limpiar</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            
                            
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <br>

    @if ($itemObj)
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    

                    @if ($tipo =="P")
                    @include('facturacion.facturar.producto')
                    @endif

                    @if ($tipo =="S")
                    @include('facturacion.facturar.servicio')
                    @endif


                    
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                @include('facturacion.facturar.listar')
 
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#items').select2({
                placeholder: 'Seleccione una opción',
                //dropdownParent: $('#clienteModal'),
                allowClear: true,
                closeOnSelect: true,
                width: '100%'
            });
        });
    </script>


</x-app-layout>
