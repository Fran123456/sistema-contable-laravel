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
                    <a class="btn btn-success mb-2" 
                        href="{{ route('public-contactos', ['selected_ids' => implode(',', $contactosSeleccionados->pluck('id')->toArray())]) }}" >
                        Compartir Seleccionados2
                    </a>
                </div>
                    <table class="table table-bordered" id="socios_contactos">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Portafolio</th>
                                <th>País</th>
                                <th>Cargo</th>
                                <th>CV</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactosSeleccionados as $contacto)
                                <script>
                                    console.log(@json($contacto));
                                </script>
                                <tr>
                                    <td>{{ $contacto->nombre }}</td>
                                    <td>{{ $contacto->apellido }}</td>
                                    <td>{{ $contacto->correo }}</td>
                                    <td>{{ $contacto->telefono }}</td>
                                    <td>{{ $contacto->portafolio }}</td>
                                    <td>{{ $contacto->pais }}</td>
                                    <td>{{ $contacto->cargo_id }}</td>
                                    <td>
                                        @if($contacto->cv)
                                            {{-- <a class="btn btn-success "
                                                href="{{ asset('storage/cv/' . $contacto->cv) }}" 
                                                download>Descargar CV</a> --}}
                                            <a class="btn btn-success " href="{{url('/')}}/cv/{{$contacto->cv}}" target="_blank" title="Ver CV">Ver CV</a>
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
