<x-app-layout>

    <x-slot:title>
        Agregar Empresa
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rrhh.empresa.index') }}">Empresas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear empresa</li>
            </ol>
        </nav>
    </div>
    
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <form method="post" action="{{ route('rrhh.empresa.store') }}">
            <div class="row">
                @csrf
                <div class="col-md-12   mt-2 mb-21">
                    <label for="">Empresa</label>
                    <input name="empresa" required type="text" class="form-control">
                </div>
    
                <div class="col-md-4   mt-2 mb-21">
                    <label for="">Abreviatura</label>
                    <input name="abreviatura" type="text" class="form-control" max="10">
                </div>
    
                <div class="col-md-4   mt-2 mb-21">
                    <label for="">NRC</label>
                    <input name="nrc" type="text" class="form-control" max="10">
                </div>
    
                <div class="col-md-4   mt-2 mb-21">
                    <label for="">NIT</label>
                    <input name="nit" type="text" class="form-control" max="10">
                </div>
    
                <div class="col-md-12   mt-2 mb-21">
                    <label for="">Razon social</label>
                    <input name="razon_social" type="text" class="form-control" max="10">
                </div>
    
                <div class="col-md-12 mb-3 mt-3">
                    <button class="btn btn-primary mb-2" style="color:white;" type="submit"> <i class="fas fa-save"></i>
                    </button>
                </div>
            </div>
    
    
        </form>
    
    </div>
</x-app-layout>
