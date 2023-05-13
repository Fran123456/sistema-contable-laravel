<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <style>
        hr {
            margin: 0.5rem 0;
            color: inherit;
            border: 0;
            border-top: 1px solid;
            opacity: .25;
        }
    </style>
    <div class="col-md-12">
        <x-commonnav></x-commonnav>

    </div>

    <div class="col-md-12">
        <x-alert></x-alert>
        <div class="card">

            <div class="card-body">
                <div class="text-start">
                    <h6>Ficha de: {{ $user->name }} </h6>
                </div>

                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row mt-4 mb-3">
                        <div class="col-md-12">
                            <x-badge titulo="Datos generales" icono="fas fa-user-edit"></x-badge>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label for=""> <strong>Nombre</strong> </label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                required>
                        </div>

                        <div class="col-md-6 mb-1 ">
                            <label for=""> <strong>Correo electronico</strong> </label>
                            <input type="text" readonly class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="col-md-6 mb-2 mt-3">
                            <label for=""> <strong>Rol asignado</strong> </label>
                            <select name="role" class="form-control" id="">
                                @foreach ($roles as $role)
                                    @if (isset($user->getRoleNames()[0]))
                                        @if ($user->getRoleNames()[0] == $role->name)
                                            <option selected value="{{ $role->name }}">{{ $role->name }}</option>
                                        @else
                                            <option selected value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endif
                                    @else
                                        <option selected value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-12 mb-1 mt-3 text-end">
                            <button class="btn btn-success" type="submit"><i class="fas fa-user-edit"></i></button>
                        </div>
                    </div>
                </form>


                <form action="">
                    <div class="row mt-4 mb-3">
                        <div class="col-md-12">
                            <x-badge titulo="Foto de perfil" icono="fas fa-user-edit"></x-badge>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="">{{ $user->name }}</label>
                            <x-photo :user="$user" width="50" height="50"></x-photo>
                        </div>
                    </div>
                </form>

                <form action="{{ route('users.updatePassword', $user->id) }}" method="post">
                    @csrf
                    <div class="row mt-4 mb-3">
                        <div class="col-md-12">

                            <x-badge titulo="Resetear contraseña" icono="fas fa-user-edit"></x-badge>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Contraseña</label>
                            <div class="input-group mb-3">
                                <span onclick="mostrarPassword()" class="input-group-text" id="basic-addon1"> <span
                                        class="fa fa-eye-slash icon"></span> </span>
                                <input required ID="txtPassword" type="text" class="form-control">
                            </div>
                            <div class="col-md-12 mb-1 mt-3 text-end">
                                <button class="btn btn-success" type="submit"><i class="fas fa-user-edit"></i></button>
                            </div>
                        </div>
                    </div>
                </form>



                <div class="">

                    <div class="row mt-4 mb-3">
                        <div class="col-md-12">

                            <x-badge titulo="Empresa asociadas al usuario" icono="fas fa-user-edit"></x-badge>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col"><i class="fas fa-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->empresas as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $item->empresa }}</td>
                                            <td><a href="{{ route('users.eliminarEmpresa', ['id'=>$user->id, 'empresa_id'=>$item->id]) }}"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('users.agregarEmpresa') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <label for=""> <strong>Empresa</strong> </label>
                                <select name="empresa" id="" class="form-control mt-2 chosen-select">
                                    @foreach ($empresas as $e)
                                        <option value="{{ $e->id }}">{{ $e->empresa }}</option>
                                    @endforeach
                                </select>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success  mt-2" style="color:white"><i
                                        class="fas fa-save"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card-footer text-body-secondary">

            </div>
        </div>
    </div>



    <script type="text/javascript">
        function mostrarPassword() {
            var cambio = document.getElementById("txtPassword");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        $(document).ready(function() {
            //CheckBox mostrar contraseña
            $('#ShowPassword').click(function() {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });

        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>



</x-app-layout>
