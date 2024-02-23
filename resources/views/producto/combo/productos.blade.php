<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12" id="producto">


                <form method="get" action="{{ route('productocombos.create') }}#producto">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for=""> <strong>Producto</strong> </label>
                            <select name="producto" class="form-control" required>

                                @foreach ($productos as $pro)
                                    @if ($producto?->id == $pro->id)
                                        <option selected value="{{ $pro->id }}">
                                            {{ $pro->codigo . ' - ' . $pro->producto }}</option>
                                    @else
                                        <option value="{{ $pro->id }}">{{ $pro->codigo . ' - ' . $pro->producto }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($edit == 1)
                                <input type="hidden" name="edit" value="1">
                            @endif



                            <input type="hidden" name="id" value="{{ $data?->id }}">
                            <button type="submit" @if ($data?->id == null) disabled @endif
                                @if ($validate) disabled @endif class="btn btn-primary mt-2"><i class='fas fa-check-circle'></i> Validar
                                producto</button>
                        </div>

                        <div class="col-md-6 mt-1 mb-3">
                            @include('producto.combo.producto')
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                @if ($producto)
                    @if (count($producto->tiposPrecios) > 0 && count($producto->categorias) > 0)
                        <div class="alert alert-success">
                            <strong>¿Desea Agregar el producto al combo?</strong>
                            <form action="{{ route('producto.guardarProducto', ['id' => $data?->id ?? 0]) }}"
                                method="post">
                                @csrf
                                @if ($edit == 1)
                                    <input type="hidden" name="edit" value="1">

                                @endif
                                <input type="hidden" name="producto_save" value="{{ $producto->id }}">
                                <input type="hidden"  name="precio" value="" id="precio_f">
                                <label for="">Cantidad</label> <input type="number" min="1" step="1" value="1" required name="cantidad_f"  id="cantidad_f">
                                <input type="hidden"  name="valor_real" value="1" id="valor_real">
                                <input type="hidden"  name="tipo_precio" value="" id="precio_t">
                                <button @if ($validate) disabled @endif type="submit" id="btn_f"
                                     class="btn btn-warning mt-2">Si</button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-warning mt-2">
                            <strong>¡Opps! No se puede agregar el producto porque no tiene categorias o precios
                                asociados</strong>
                        </div>
                    @endif
                @endif

            </div>


            <div class="col-md-12">

                @if ($validate)
                <div class="alert alert-danger">
                    <strong>¡Opps! El combo no se puede editar porque ya se esta utilizando en una cotización.
                        <a href="/DetalleCotizacionInicial/{{ $validateCombo->id }}">clic para ver la cotización {{ $validateCombo->codigo_cotizacion }}</a>
                    </strong>
                </div>
                @endif

                @if (isset($data->productos))
                    @if (count($data->productos) > 0)
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="30">#</th>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Producto</th>
                                    <th  scope="col">Precio Venta</th>
                                    <th>Categorias</th>
                                    <th scope="col" width="130">Imagen</th>
                                    <th width="40">Estado</th>
                                    <th class="text-center" scope="col" width="40"><i class="fas fa-trash"></i>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->productos as $key => $item)
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->codigo }}</td>
                                    <td>{{ $item->producto }}</td>
                                    <td>{{ number_format($item->pivot->precio_venta, 2) }}</td>
                                    <td>
                                        @foreach ($item->categorias as $categoria)
                                            <span class="badge bg-primary text-light"> {{ $categoria->categoria }}
                                            </span>
                                        @endforeach
                                    </td>
                                    @php
                                        $url = 'default.png';
                                        if ($item->imagen != null) {
                                            $url = $item->imagen;
                                        }
                                    @endphp
                                    <td> <img width="100" height="70" class="img-thumbnail"
                                            src="{{ asset('productos/' . $url) }}" alt=""> </td>
                                    <td>
                                        @if ($item->pivot->estado == true)
                                            @if ($validate)
                                                <button disabled class="btn btn-success">Activo</button>
                                            @else
                                                <a href="{{ route('producto.estadoProductoCombo', $data->id) }}?producto_id={{ $item->id }}&estado={{ $item->pivot->estado }}"
                                                    class="btn btn-success"> Activo</a>
                                            @endif
                                        @else
                                            @if ($validate)
                                                <button disabled class="btn btn-success">Activo</button>
                                            @else
                                                <a href="{{ route('producto.estadoProductoCombo', $data->id) }}?producto_id={{ $item->id }}&estado={{ $item->pivot->estado }}"
                                                    class="btn btn-danger"> Desactivo</a>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($validate)
                                        <button disabled class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        @else
                                        <a href="{{ route('producto.eliminarProductoCombo', $data->id) }}?producto_id={{ $item->id }}"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger">
                            <strong>¡Opps! Parece que no tienes ningun precio registrado.</strong>
                        </div>
                    @endif
                @endif
            </div>
        </div>


    </div>
</div>
