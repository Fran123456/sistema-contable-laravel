<x-app-layout>
    <div class="col-md-12">
        <x-commonnav ></x-commonnav>
    </div>
    <div class="col-md-12 mb-3">
        <x-badge titulo="Nuevo rol" icono="fas fa-user-plus"></x-badge>
    </div>
    <div class="col-md-12">
        <form action="{{ route('roles.storeRole') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                           <x-errors></x-errors>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>Rol</label>
                            <input type="text"  name="role" value="{{ old('role') }}" required class="form-control">
                        </div>
                        <div class="col-md-12 mt-3">
                          <button class="btn btn-success"><i class="fas fa-save"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>



</x-app-layout>