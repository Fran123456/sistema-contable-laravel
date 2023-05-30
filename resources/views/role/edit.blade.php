<x-app-layout>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
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

                    <div class="col-md-6 mt-3">
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
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-success"><i class="fas fa-save"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for=""><strong>Permisos</strong></label> <br>

                        <table  class="table table-sm" id="datatable-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Permiso</th>
                                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($role->permissions))
                                    @foreach ($role->permissions as $key=> $permission)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $permission->name }}</td>
                                            <td><button onclick="confirm('form')" type="button" class="btn btn-danger">
                                                    <span class="badge bg-danger"><i class="fas fa-trash-alt"></i></span>
                                                </button></td>
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
