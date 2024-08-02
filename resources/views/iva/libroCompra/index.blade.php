<x-app-layout>
    <x-slot:title>
        Libro Compra
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Libro Compra</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a href="{{ route('iva.libro_compras.create') }}" class="btn btn-success" title="Crear">
            <i class="fa-solid fa-circle-plus"></i>
        </a>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Fecha emision PDF</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Total compra</th>
                            <th scope="col" width="160px">Acciones </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libro_compras as $key => $item)
                            <tr>

                                <th scope="row">{{ $key + 1 }}</th>
                                <td class="text-center">{{ \Carbon\Carbon::parse($item->fecha_emision_en_pdf)->format('d-m-y') }}</td>
                                <td class="text-center">{{ $item->documento }}</td>
                                <td class="text-center">{{ $item->proveedor->nombre }}</td>
                                <td class="text-center">${{ $item->total_compra}}</td>
                                <td class="text-center">
                                    <a href="{{ route('iva.libro_compras.edit', $item->id) }}" title="Editar" class="mx-0.5">
                                        <i class="fas fa-edit fa-lg"></i>
                                    </a>
                                    <form id="form{{ $item->id }}" 
                                        action="{{ route('iva.libro_compras.destroy', $item->id) }}" method="post" 
                                        class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" 
                                            onclick="if(confirm('form{{ $item->id }}','¿Desea eliminar este libro de compra?')) { event.preventDefault(); this.closest('form').submit(); }" 
                                            title="Eliminar" class="mx-0.5">
                                            <i class="fas fa-trash fa-lg" style="color: #f43e3e"></i>
                                        </a>
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
