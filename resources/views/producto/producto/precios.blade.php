<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <form method="post" action="{{ route('producto.guardarTipoPrecio', ['id' => $data?->id ?? 0]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for=""> <strong>Tipo precio</strong> </label>
                            <select name="precio" id="" class="form-control">
                                @foreach ($precios as $pre)
                                    <option value="{{ $pre->id }}">{{ $pre->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for=""><strong>Precio</strong></label>
                            <input name="precio_numerico" type="number" step="0.01" class="form-control"
                                value="0">
                        </div>
                        <div class="col-md-12 mt-1 mb-3 mt-4">
                            <button type="submit" @if ($data?->id == null) disabled @endif
                                class="btn btn-primary"><i class='fas fa-check-circle'></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                @if ($data?->tiposPrecios)
                    @if (count($data->tiposPrecios) > 0)
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="70">#</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col" width="200">Precio</th>
                                    <th scope="col" width="80">Estado</th>
                                    <th width="60"><i class="fas fa-trash"></i></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data->tiposPrecios as $key => $item)
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->tipo }}</td>
                                    <td>{{ number_format($item->pivot->precio, 2) }}</td>
                                    <td>
                                        @if ($item->pivot->estado == true)
                                            <a href="{{ route('producto.estadoTipoPrecio', $data->id) }}?tipo_id={{ $item->id }}&estado={{ $item->pivot->estado }}"
                                                class="btn btn-success"> Activo</a>
                                        @else
                                            <a href="{{ route('producto.estadoTipoPrecio', $data->id) }}?tipo_id={{ $item->id }}&estado={{ $item->pivot->estado }}"
                                                class="btn btn-danger"> Desactivo</a>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('producto.eliminarTipoPrecio', $data->id) }}?tipo_id={{ $item->id }}"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></a>

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
