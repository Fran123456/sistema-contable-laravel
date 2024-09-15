
<x-app-layout>
    <x-slot:title>
        Lista de clientes
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
        </ol>
    </div>
    
    <div class='col-md-6'>
        <a class="btn btn-success" href="{{ route('socios.descargar.excel') }}" ">Descargar Excel</i></a>
    </div>
    </div>
</x-app-layout>