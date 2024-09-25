
<x-app-layout>
    <x-slot:title>
        Lista de clientes
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('socios.cliente.index') }}">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Importar Clientes</li>
        </ol>
    </div>
    <div class="col-md-12">
        @if(session('rows'))
            <h5>Resultado de la importación de clientes</h5>
            <h6>Total de filas recorridas: {{ session('rows') }}</h6>
        @endif
        @if(session('errores') && count(session('errores')) > 0 )
            <div class="alert alert-danger">
                <ul>
                    @foreach(session('errores') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('ingresados'))
            <div class="alert alert-success">
                {{ session('ingresados') }} clientes ingresados correctamente.
            </div>
        @endif
    </div>
    
    <div class='col-md-6'>
        <a class="btn btn-success" href="{{ route('socios.descargar.excel') }}" ">Descargar Excel</i></a>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5"> <!-- Cambia el tamaño de la columna aquí -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('socios.importar.excel') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div >
                                <label for="excel">Subir archivo</label>
                                <input type="file" accept=".xlsx, .xls" name="excel" id="excel" class="form-control" required>
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-success">Subir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</x-app-layout>