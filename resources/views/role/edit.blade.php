<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
                            <div>
                                <label>Rol</label>
                                <input type="text" name="role" value="{{ $role->name }}" required
                                    class="form-control">
                            </div>

                            <div class="mt-3">
                                <label for="">Permisos</label>
                                <select required size="10" name="permission"
                                    data-placeholder="Seleccione un permiso" class="form-control chosen-select">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Permisos</label> <br>

                        @if (count($role->permissions))
                            @foreach ($role->permissions as $permission)
                                <form method="post" action="{{ route('roles.destroyPermissions', $role->id) }}"
                                    id="form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" value="{{ $permission->name }}">
                                    <button onclick="confirm('form')" type="button" class="btn btn-danger">
                                        <small style="color:aliceblue">{{ $permission->name }}</small> <span
                                            class="badge bg-danger"><i class="fas fa-trash-alt"></i></span>
                                    </button>
                                </form>
                            @endforeach
                        @else
                            <x-message message="No hay permisos asociados" color="danger"></x-message>
                        @endif
                    </div>

                    <div class="col-md-12 mt-3">
                        <button class="btn btn-success"><i class="fas fa-save"></i></button>
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
