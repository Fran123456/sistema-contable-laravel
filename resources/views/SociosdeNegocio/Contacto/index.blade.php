<x-app-layout>
    <x-slot:title>
        Lista de contactos
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contactos</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <form action="{{ route('socios.contacto.index') }}" method="get">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Cargos</label>
                    <select name="cargo" class="form-control"  id="">
                        <option value="" disabled selected >Seleccionar</option>
                        @foreach ($cargos as $c)
                            <option @if($cargo == $c->id) selected @endif value="{{ $c->id }}" >{{ $c->cargo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="">Pais</label>
                    <select name="pais" class="form-control"  id="">
                        <option value="" disabled selected >Seleccionar</option>
                        @foreach ($paises as $p)
                            <option @if($pais == $p->id) selected @endif value="{{ $p->id }}" >{{ $p->pais }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="">Estados</label>
                    <select name="estado" class="form-control"  id="">
                        <option value="" disabled selected >Seleccionar</option>
                        @foreach ($estados as $e)
                            <option @if($pais == $e->id) selected @endif value="{{ $e->estado }}" >{{ $e->estado }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mt-3">
                   
                    <div class="hstack gap-3">
                        <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
                        <a href="{{ route('socios.contacto.index') }}" class="btn btn-danger" ><i class="fa fa-trash"></i>
                        </a>
                       
                    </div>
                </div>
               
            </div>
        </form>
        <br>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('socios.contacto.create') }}" title="Crear"> <i
                class="fas fa-user-plus"></i> </a>
    </div>



    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5> Contactos </h5>
                    <form action="{{ route('socios.contacto.seleccionados') }}" method="POST" id="selectedForm">
                        @csrf
                        <input type="hidden" name="selected_ids" id="selectedIdsInput">
                        <button type="submit" class="btn btn-danger text-white disabled" id="idButton">Ver
                            IDs</button>
                    </form>
                </div>


                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col"> </th>
                            <th scope="col">Nombre completo</th>
                  
                            <th scope="col">Cargo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Pais</th>
                            <th scope="col" width="160px">Acciones </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactos as $key => $item)
                            <tr>

                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input selector" type="checkbox"
                                            value='{{ $item->id }}' id="checkboxSelect-{{ $key }}">
                                    </div>
                                </td>
                                <td>{{ $item->nombre }} {{ $item->apellido }}</td> {{-- Nombre completo --}}
                               
                                <td>{{ $item->cargo->cargo }}</td>
                                <td>{{ $item->estado }}</td>
                                <td>{{ $item->pais->pais}}</td>
                                <td class="text-center">
                                    <a href="{{ route('socios.registro.show', $item->id) }}" title="Ver detalles"
                                        class="mx-0.5"><i class="fa-solid fa-file-lines fa-lg"></i></a>
                                    <a href="{{ url('/') }}/cv/{{ $item->cv }}" target="_blank"
                                        title="Descargar CV" class="mx-0.5"><i
                                            class="fas fa-file-download fa-lg"></i></a>
                                    <a href="{{ route('socios.contacto.show', $item->id) }}" title="Ver contacto"
                                        class="mx-0.5"><i class="fas fa-eye fa-lg"></i></a>
                                    <a href="{{ route('socios.contacto.edit', $item->id) }}" title="Editar"
                                        class="mx-0.5"><i class="fas fa-edit fa-lg"></i></a>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('socios.contacto.destroy', $item->id) }}" method="post"
                                        class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#"
                                            onclick="if(confirm('form{{ $item->id }}','¿Desea eliminar el contacto?')) { event.preventDefault(); this.closest('form').submit(); }"
                                            title="Eliminar" class="mx-0.5"><i class="fas fa-trash fa-lg"
                                                style="color: #f43e3e"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll('.selector');
            const button = document.querySelector('#idButton');

            let selectedIds = [];

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function(e) {

                    const value = e.target.value;
                    if (e.target.checked) {
                        if (button.classList.contains('disabled')) {
                            button.classList.remove('disabled')
                        }
                        if (!selectedIds.includes(value)) {
                            selectedIds.push(value);
                        }
                    } else {
                        selectedIds = selectedIds.filter(item => item !== value);
                        if (selectedIds.length === 0) {
                            button.classList.add('disabled')
                        }
                    }

                });
            });

            document.querySelector('#idButton').addEventListener('click', function(e) {
                e.preventDefault();
                if (selectedIds.length !== 0) {
                    document.querySelector('#selectedIdsInput').value = selectedIds.join(',');
                    document.querySelector('#selectedForm').submit();
                }
            });
        });
    </script>

    <style>
        .button-float {
            position: absolute;
            left: 52.6rem;
            top: 3rem;
            z-index: 1;
        }
    </style>

</x-app-layout>
