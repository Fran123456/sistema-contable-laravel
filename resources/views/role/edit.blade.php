<x-app-layout>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <x-slot:title>
        Roles
      </x-slot>

      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
              <li class="breadcrumb-item"><a href="/roles">Roles</a></li>
              <li class="breadcrumb-item active" aria-current="page">Editar roles</li>
            </ol>
          </nav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12 mb-3">
        <x-badge titulo="Nuevo rol" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <x-errors></x-errors>
                    </div>

                    <div class="col-md-12 mt-3">
                        <form action="{{ route('roles.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div>
                                <label>Rol</label>
                                <input type="text" name="role" value="{{ $role->name }}" required
                                    class="form-control">
                            </div>

                            <div class="mt-3">
                                <label for="">Permisos</label>
                                <select multiple required size="10" name="permission[]"
                                    data-placeholder="Seleccione un permiso" class="form-control chosen-select">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->opcion }}">{{ $permission->opcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-success"><i class="fas fa-save"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for=""><strong>Permisos</strong></label> <br>

                        <table  class="table table-sm" id="datatable-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Permiso</th>
                                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                                    <th>Sub Permisos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($role->permissions()->groupBy('opcion')->get())>0)
                                    @foreach ($role->permissions()->groupBy('opcion')->get() as $key=> $permission)
                                        <tr>
                                            <th scope="row" width="30">{{ $key+1 }}</th>
                                            <td>{{ $permission->opcion }}</td>
                                            <td>
                                                <form id="form{{ $permission->id }}" action="{{ route('roles.destroyPermissions',$role->id ) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="permission" value="{{ $permission->opcion }}">
                                                    <button onclick="confirm('form{{ $permission->id }}','¿Desea eliminar el permiso?')" class="btn btn-danger" type="button">
                                                     <i class="fas fa-trash"></i></button>
                                                 </form>
                                            </td>
                                            <td>
                                                @foreach (Help::groupPermissionsOwner( $permission->opcion,$role) as $item)
                                                <a href="{{ route('roles.destroyPermissionOne', $role->id) }}?permission_one={{ $item->id_permissions }}">
                                                    <span class="badge bg-secondary">{{ $item->permission }}</span></a>
                                                @endforeach

                                            </td>
                                        </tr>



                                    @endforeach
                                @else
                                    <x-message message="No hay permisos asociados" color="danger"></x-message>
                                @endif
                            </tbody>
                        </table>


                    </div>


                </div>

            </div>
        </div>
    </div>


    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>

</x-app-layout>
