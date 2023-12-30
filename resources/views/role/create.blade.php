<x-app-layout>
    <x-chosen></x-chosen>
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
              <li class="breadcrumb-item active" aria-current="page">Crear roles</li>
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
        <form action="{{ route('roles.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <x-errors></x-errors>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Rol</label>
                            <input  type="text" name="role" value="{{ old('role') }}" required
                                class="form-control">
                        </div>
                        <!--<div class="col-md-6 mt-3">
                            <label for="">Permisos</label>
                            <select required size="10" name="permission[]" data-placeholder="Seleccione los permisos"  multiple class="form-control chosen-select">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->opcion }}</option>
                                @endforeach
                            </select>
                        </div>-->
                        <div class="col-md-12 mt-3">
                            <button class="btn btn-success"><i class="fas fa-save"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>

</x-app-layout>
