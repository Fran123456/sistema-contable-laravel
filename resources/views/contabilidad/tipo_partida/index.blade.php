<x-app-layout>

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <form method="post" action="{{ route('contabilidad.tipos-de-partida.store') }}">
        <div class="row">
            <div class="col-md-6   mt-2 mb-21">
                <label for="">Tipo partida</label>
                @csrf
                <input name="tipo" required type="text" class="form-control">
            </div>
            <div class="col-md-6 mt-2 mb-2">
                <label for="">Descripción</label>
                <input name="des"  type="text" class="form-control">
            </div>
            <div class="col-md-12 mb-3">
                <button class="btn btn-primary mb-2" style="color:white;" type="submit"> <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
      
      
    </form>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Tipos de partida</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Descripción</th>
                            <th width="50" class="text-center" scope="col">Estado</th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipos as $key => $item)
                            <tr class="  @if ($item->activo==false) table-danger @endif">

                                <th scope="row">{{ $key + 1 }}</th>

                                <td>{{ $item->tipo }} </td>
                                <td>{{ $item->descripcion }} </td>
                                <td>
                                    <form id="form{{ $item->id }}p"
                                        action="{{ route('contabilidad.tipos-de-partida.update', $item->id) }}"
                                        method="post">
                                        @method('PUT')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}p','¿Desea modificar el estado del tipo de partida?')"
                                            class="btn @if ($item->activo) btn-success @else btn-danger @endif "
                                            type="button">
                                            @if ($item->activo)
                                                <i class="fas fa-check-circle"></i>
                                            @else
                                                <i class="fas fa-times"></i>
                                            @endif
                                        </button>
                                    </form>
                                </td>

                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('contabilidad.tipos-de-partida.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el tipo de partida?')"
                                            class="btn @if ($item->activo) btn-success @else btn-danger @endif "
                                            type="button" ><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
