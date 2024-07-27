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
                <div class="d-flex justify-content-between">
                    <h5>Contactos Seleccionados</h5>
                    <!-- Botón para compartir los contactos seleccionados -->
                    <a class="btn btn-success mb-2" target="_blank"
                        href="{{ route('public-contactos', ['selected_ids' => implode(',', $contactosSeleccionados->pluck('id')->toArray())]) }}" >
                        Compartir Seleccionados
                    </a>
                </div>
                    <table class="table table-sm" id="datatable-responsive">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>País</th>
                                <th>Cargo</th>
                                <th>CV</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactosSeleccionados as $contacto)
                                <tr>
                                    <td>{{ $contacto->nombre }}</td>
                                    <td>{{ $contacto->apellido }}</td>
                                    <td>{{ $contacto->correo }}</td>
                                    <td>{{ $contacto->telefono }}</td>
                                    <td>{{ $contacto->pais?->pais }}</td>
                                    <td>{{ $contacto->cargo?->cargo??"sin encontrar" }}</td>
                                    <td>
                                        @if($contacto->cv)
                                            <a class="mx-0.5" 
                                                href="{{url('/')}}/cv/{{$contacto->cv}}" 
                                                target="_blank" 
                                                title="Ver CV">
                                                    <i class="fa-solid fa-file-pdf fa-lg"></i>
                                            </a>
                                        @else
                                            No disponible
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
