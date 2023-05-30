<x-app-layout>

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12  text-end mb-4">
        <a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fas fa-user-shield"></i> </a>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Roles y Permisos</h5>
                <table class="table" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Permisos</th>
                            <th width="40" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
                            <th width="40" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $item)
                            <tr class="  @if ($item->disabled) table-danger @endif">
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->name }} </td>
                                <td>

                                        <span class="badge bg-secondary">{{ count($item->permissions) }}</span>


                                </td>
                                <td> <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-warning"><i
                                            class="fas fa-edit"></i></a> </td>
                                <td>
                                  <form id="form" action="{{ route('roles.destroy', $item->id) }}" method="post">
                                     @method('DELETE')
                                     @csrf
                                     <button onclick="confirm('form')" class="btn btn-danger" type="button">
                                      <i class="fas fa-trash"></i></button>
                                  </form>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
