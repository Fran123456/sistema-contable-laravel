<x-app-layout>
    <x-slot:title>
        Lista de categorias
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categorias de productos</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>


    <div class="col-md-12">
        <form action="{{route('producto.categoria.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12 mt-2">
                    <label for="socios_clasificacion"> <strong>Categoria</strong> </label>
                    <input type="text" name="categoria" class="form-control" required>
                   
                </div>
                
                <div class="col-md-12 mb-3 mt-3">
                    <button class="btn btn-primary mb-2" style="color:white;" type="submit"> <i class="fas fa-save"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

   

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Listas de categorias</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">Categoria</th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $key => $item)
                                <tr>

                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->categoria }}</td>

                                    <td>
                                        <form id="form{{ $item->id }}"
                                            action="{{ route('producto.categoria.destroy', $item->id) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="confirm('form{{ $item->id }}','¿Desea eliminar la categoria?')"
                                                class="btn btn-danger"
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
