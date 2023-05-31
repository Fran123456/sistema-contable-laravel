<x-app-layout>
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
            </ol>
          </nav>
    </div>
    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('users.create') }}"> <i class="fas fa-user-plus"></i> </a>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <table class="table" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Correo</th>
                            <th width="40" class="text-center" scope="col">Deshabilitado</th>
                            <th width="40" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
                            <th width="40" class="text-center" scope="col"><i class="fas fa-user-slash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $item)
                            <tr class="  @if ($item->disabled) table-danger @endif">
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->name }} </td>
                                <td>
                                    @if (count($item->getRoleNames()) > 0)
                                        @foreach ($item->getRoleNames() as $r)
                                            {{ $r }} <br>
                                        @endforeach
                                    @else
                                        <span class="badge bg-danger">Sin roles</span>
                                    @endif

                                </td>
                                <td>{{ $item->email }}</td>
                                <td class="text-center">
                                    @if ($item->disabled)
                                        <h4> <span class="badge bg-danger"><i class="fas fa-frown"></i></span></h4>
                                    @else
                                        <h4> <span class="badge bg-success"><i class="fas fa-smile"></i></span></h4>
                                    @endif
                                </td>
                                <td> <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning"><i
                                            class="fas fa-edit"></i></a> </td>
                                <td>
                                    @php
                                        $title = '¿Desea habilitar al usuario?';
                                        if (!$item->disabled) {
                                            $title = '¿Desea deshabilitar al usuario?';
                                        }
                                    @endphp



                                    <form id="form" action="{{ route('users.disableUser', $item->id) }}"
                                        method="get">
                                        <button class="btn btn-danger" onclick="confirm('form', '{{ $title }}')"
                                            type="button"><i class="fas fa-trash"></i></button>
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
