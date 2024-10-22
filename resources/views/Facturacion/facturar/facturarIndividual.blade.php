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
                <div class="text-end">
                    @if ($doc->estado_facturacion_id != 2)
                        @if (count($doc->detalles) > 0)
                            @include('facturacion.facturar.facturarIndividualModal')
                        @endif
                    @else
                        <h3> <strong>FACTURADO</strong></h3>
                    @endif

                </div>
                <h5>Documento: {{ $ov->documentos[0]->tipoDocumento?->tipo }}</h5>
                <h5>Orden Venta: {{ $ov->codigo }}</h5>
                <h6>Cliente: {{ $ov->cliente->nombre }} {{ $ov->cliente->apellido }}</h6>
                <p>
                    Dui: {{ $ov->cliente->dui ?? 'Sin documento' }} <br>
                    Nit: {{ $ov->cliente->nit ?? 'Sin documento' }} <br>
                    Correo: {{ $ov->cliente->correo ?? 'Sin correo' }} <br>
                    Tipo cliente: {{ $ov->cliente->tipo_cliente ?? 'Sin clasificación' }} <br>
                    Forma de pago: {{ $ov->documentos[0]->formaPago?->valor ?? 'Sin clasificación' }}

                </p>
            </div>
        </div>
    </div>
    <br>

    @if ($doc->estado_facturacion_id != 2)
        <div class="col-md-12">
            <div class="card">
                <!-- Button trigger modal -->

                <div class="card-body">
                    <h5>Documento: {{ $ov->documentos[0]->tipoDocumento?->tipo }}</h5>

                    <form action="{{ route('facturacion.agregarItemsFactura', $ov->id) }}" method="get">
                        <div class="row">
                            <div class="col-md-9">
                                <label for=""> <strong>Items</strong> </label>
                                <select class="form-select w-100" id="items" name="items">
                                    <option selected disabled>Seleccione...</option>
                                    @foreach ($servicios as $ser)
                                        <option value="S-{{ $ser->id }}">{{ $ser->codigo }} -
                                            {{ $ser->nombre }}
                                        </option>
                                    @endforeach

                                    @foreach ($productos as $pro)
                                        <option value="P-{{ $pro->id }}">{{ $pro->codigo }} -
                                            {{ $pro->producto }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <div>
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
    @endif


    <br>

    @if ($itemObj)
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">


                    @if ($tipo == 'P')
                        @include('facturacion.facturar.producto')
                    @endif

                    @if ($tipo == 'S')
                        @include('facturacion.facturar.servicio')
                    @endif



                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <br>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                @include('facturacion.facturar.listar')

            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
    
                    <h4>Resumen</h4>
                    <table class=" table" >
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SUMAS</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>VENTA NO SUJETA</td>
                                <td class="text-end"><label style="font-weight: bold;margin:0;">$&nbsp;</label><label
                                        style="font-weight: bold;margin:0;" class="float-right">{{ $ov->documentos[0]->noSujeto() }}</label></td>
                            </tr>
                            <tr>
                                <td>VENTA EXENTA</td>
                                <td class="text-end"><label style="font-weight: bold;margin:0;">$&nbsp;</label><label
                                        style="font-weight: bold;margin:0;" class="float-right">{{ $ov->documentos[0]->excentas() }}</label></td>
                            </tr>
                            <tr>
                                <td>VENTA GRAVADAS</td>
                                <td class="text-end"> <label style="font-weight: bold;margin:0;">$&nbsp;</label><label
                                        style="font-weight: bold;margin:0;" class="float-right">{{ $ov->documentos[0]->gravadas() }}</label></td>
                            </tr>
                            <tr>
                                <td>IVA</td>
                                <td class="text-end"><label style="font-weight: bold;margin:0;">$&nbsp;</label><label
                                        style="font-weight: bold;margin:0;" class="float-right"> 
                                        {{ $ov->documentos[0]->iva() }}
                                        </label></td>
                            </tr>
                            <tr>
                                <td>SUB-TOTAL</td>
                                <td class="text-end"><label style="font-weight: bold;margin:0;">$&nbsp;</label><label
                                        style="font-weight: bold;margin:0;" class="float-right">{{ $ov->documentos[0]->subTotal() }}</label></td>
                            </tr>
                            <tr>
                                <td>(+) IVA PERCIBIDO</td>
                                <td class="text-end"><label style="font-weight: bold;margin:0;">$&nbsp;</label><label
                                        style="font-weight: bold;margin:0;" class="float-right">0.00</label></td>
                            </tr>
                            <tr>
                                <td>(-) IVA RETENIDO</td>
                                <td class="text-end"><label style="font-weight: bold;margin:0;">$&nbsp;</label><label
                                        style="font-weight: bold;margin:0;" class="float-right">{{ $ov->documentos[0]->ivaRetenido() }}</label></td>
                            </tr>
                            
                            <tr>
                                <td>VENTA TOTAL</td>
                                <td class="text-end"><label style="font-weight: bold;margin:0;">$&nbsp;</label><label
                                        style="font-weight: bold;margin:0;" class="float-right">{{ $ov->documentos[0]->total() }}</label></td>
                            </tr>
                        </tbody>
                    </table>
    
    
                </div>
            </div>
        </div>

        @if ($partidas && count($partidas))
        <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th class="col-md-3">Fecha</th>
                                    <th class="col-md-3">Concepto</th>
                                    <th class="col-md-1">Debe</th>
                                    <th class="col-md-1">Haber</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partidas as $item)
                                    <tr>
                                        <td>{{ date('Y-m-d', strtotime($item->fecha_contable)) }}</th>
                                        <td>{{$item->concepto}}</th>
                                        <td>{{$item->debe}}</th>
                                        <td>{{$item->haber}}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
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
