<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('producto.guardarCategoriaInterna', ['id' => $data?->id??0]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label><strong>Categorias</strong></label>
                    <select class="form-control" name="categoria" id="">
                        @foreach ($categorias as $cate)
                            <option value="{{ $cate->id }}">{{ $cate->categoria }}</option>
                        @endforeach
                    </select>
                    <button @if ($data?->id==null)
                        disabled
                    @endif type="submit" class="btn btn-warning mt-4"> Guardar</button>
                </div>
                <div class="col-md-8 mt-4">
                    @if ($data?->categorias)
                    @if (count($data->categorias) == 0)
                    <div class="alert alert-danger">
                        <strong>¡Opps! Parece que no tienes ninguna categoria asociada</strong>
                    </div>
                @else
                    <ul class="list-group list-group-horizontal">
                        @foreach ($data->categorias as $item)
                            <li style="font-size: 15px;" class="list-group-item">{{ $item->categoria }} <a
                                    href="{{ route('producto.eliminarCategoriaInterna', $data->id) }}?categoria_id={{ $item->id }}"><span
                                        style="font-size: 15px; color:aliceblue"
                                        class="badge bg-danger">X</span></a> </li>
                        @endforeach
                    </ul>
                @endif
                    @endif

                </div>
            </div>

        </form>

    </div>
</div>
