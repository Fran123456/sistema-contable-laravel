<x-app-layout>
    <x-slot:title>
        IDs seleccionados
    </x-slot>
    <x-slot:subtitle>

        <div class="col-md-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
                <li class="breadcrumb-item"><a href="/socios/contacto">Contactos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ver IDs</li>
            </ol>
        </div>
        <div class="col-md-12">
            <x-alert></x-alert>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5> Contactos Seleccionados </h5>
                    <ul>
                        @foreach ($contactosSeleccionados as $contacto)
                            <li>{{ $contacto->id }}</li>
                        @endforeach

                    </ul>
                </div>
            </div>

        </div>
</x-app-layout>
