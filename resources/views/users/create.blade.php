<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
              <li class="breadcrumb-item"><a href="/users">Usuarios</a></li>
              <li class="breadcrumb-item active" aria-current="page">Crear usuarios</li>
            </ol>
          </nav>
    </div>
    <div class="col-md-12 mb-3">
        <x-badge titulo="Nuevo usuario" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                           <x-errors></x-errors>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Nombre completo</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Correo electronico</label>
                            <input type="text" name="email" value="{{ old('email') }}" required class="form-control">
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>Contraseña</label>
                            <input type="password" name="password" required class="form-control">
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="">Rol asignado</label>
                            <select name="role" class="form-control" id="">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">

                            <label for="">Empresa </label>
                            <select multiple name="empresa[]" id="" class="form-control mt-2 chosen-select">
                                @foreach ($empresas as $e)
                                    <option value="{{ $e->id }}">{{ $e->empresa }}</option>
                                @endforeach
                            </select>
                        </div>


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
