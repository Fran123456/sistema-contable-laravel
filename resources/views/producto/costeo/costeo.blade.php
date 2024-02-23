<div class="card">
    <div class="card-header">
        <h3 class="card-title">Costeo</h3>
        <div class="card-toolbar">

        </div>
    </div>


    <div class="card-body">
        <!--<form action="">-->
        <div class="row">

            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-hover ">
                    <thead>
                        <tr class="fw-bold fs-6 ">
                            <th scope="col">Item</th>
                            <th>Cantidad</th>
                            <th scope="col" width="150">Venta</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @php
                            $venta = 0;
                            $costo = 0;
                            $profit = 0;
                        @endphp
                        @foreach ($completa->detalles as $c)
                            @php
                                $venta = $c->monto_real + $venta;
                                $costo = $c->costo + $costo;
                            @endphp

                            @if ($c->facturado !== 'NO APLICA')
                                <tr @if ($c->costo == null)  @endif>
                                    <th scope="row">
                                        @if ($c->producto_id !== null)
                                            <label for=""> <strong>{{ $c->producto->producto }}</strong>
                                                {{ $c->producto->codigo }}</label>
                                        @endif

                                        @if ($c->combo_id !== null)
                                            <label for=""> <strong>{{ $c->combo->combo }}</strong>
                                                {{ $c->combo->codigo }}</label>
                                        @endif

                                        @if ($c->servicio_id !== null)
                                            <label for=""> <strong>{{ $c->servicio->serv_name }}</strong>
                                                {{ $c->servicio->service_cod }} </label>
                                        @endif
                                    </th>
                                    <th>{{ $c->cantidad }}</th>
                                    <td style="text-align:right">{{ $c->monto_real }}</td>
                                    <form action="{{ route('costeo.actualizarCosto', $c->id) }}" method="post">
                                        <td>
                                            @method('PUT')
                                            @csrf
                                            @if ($c->producto_id !== null)
                                                <input class="form-control" name="costo{{ $c->id }}" readonly
                                                    required value="{{ $c->costo }}" style="text-align:right"
                                                    type="number">
                                            @endif

                                            @if ($c->servicio_id !== null)
                                                <input class="form-control" name="costo{{ $c->id }}" required
                                                    value="{{ $c->costo }}" style="text-align:right"
                                                    type="number">
                                            @endif

                                            @if ($c->combo_id !== null)
                                                <input class="form-control" name="costo{{ $c->id }}" readonly
                                                    required value="{{ $c->costo }}" style="text-align:right"
                                                    type="number">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $c->estadoCosteo->tipo ?? '-' }}
                                        </td>

                                        @if ($c->servicio_id !== null)
                                            <td><button type="submit" class="btn btn-primary"><i
                                                        class="fas fa-edit"></i></button></td>
                                        @else
                                            <td></td>
                                        @endif

                                    </form>
                                </tr>
                            @endif
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align:right">{{ number_format($venta, 2) }}</td>
                            <td style="text-align:right">{{ number_format($costo, 2) }}</td>
                            <td></td>
                            <td></td>
                        </tr>


                        @php
                        $costoExtra = 0;
                        $extras = $completa
                            ->detalles()
                            ->where('facturado', 'NO APLICA')
                            ->get();
                       @endphp


                        @if (count($extras) > 0)
                            <tr style="height: 60px;">
                            <td style="vertical-align: middle;" colspan="6" class="text-center"> <strong>COSTOS
                                    EXTRA</strong> </td>

                            </tr>
                            @foreach ($extras as $item)
                                <tr>
                                    <td>{{ $item->obs }}</td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"> <input style="text-align:right" readonly
                                            type="number" class="form-control"
                                            value="{{ number_format($item->costo, 2) }}"> </td>
                                    <td> {{ $item->estadoCosteo->tipo ?? '-' }}</td>
                                    <td></td>
                                </tr>

                                @php
                                    $costoExtra = $item->costo + $costoExtra;
                                @endphp
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:right;"> {{ number_format($costoExtra, 2) }}</td>
                                <td></td>
                                <td> </td>
                            </tr>
                        @endif

                       {{--
                         <tr>
                            <td colspan="3" class="text-right" style="text-align:right;">Total</td>
                            <td style="text-align:right;">
                                <strong>{{ number_format($costoExtra + $costo, 2) }}</strong>
                            </td>
                            <td></td>
                            <td> </td>
                        </tr>--}}


                    </tbody>
                </table>
            </div>
            <div class="col-md-12 d-flex">
                <h5>Profit: <strong>{{ number_format($venta - $costo - $costoExtra, 2) }}</strong></h5>
                <br>

            </div>
            <div class="col-md-12">
                <a href="{{ route('reportePdfCosteo', $completa->id) }}" target="_blank"
                    class="btn btn-danger ml-auto">Descargar PDF <i class="fas fa-file-pdf"></i></a>
            </div>



        </div>
        <!--</form>-->
    </div>
</div>
