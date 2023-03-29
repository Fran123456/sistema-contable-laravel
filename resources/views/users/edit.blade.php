<x-app-layout>
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
        <x-commonnav  ></x-commonnav>
    </div>
    
    <div class="col-md-12">
        <div class="card">

       
           
            <div class="card-body">
                <div class="text-start"><h6>Ficha de: {{ $user->name }} </h6></div>
                
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row mt-4 mb-3">
                        <div class="col-md-12">
                            <span class="badge bg-secondary">Datos generales</span> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label for=""> <strong>Nombre</strong> </label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>
    
                        <div class="col-md-6 mb-1 ">
                            <label for=""> <strong>Correo electronico</strong> </label>
                            <input type="text" readonly class="form-control" value="{{ $user->email }}" required>
                        </div>
                        <div class="col-md-12 mb-1 mt-3 text-end">
                            <button class="btn btn-success" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
                

                <form action="">
                    <div class="row mt-4 mb-3">
                        <div class="col-md-12">
                            <span class="badge bg-secondary">Foto de perfil</span> 
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">{{ $user->name }}</label>
                            <x-photo :user="$user" width="50" height="50"  ></x-photo>
                        </div>
                    </div>
                </form>

                

            </div>
            <div class="card-footer text-body-secondary">
              2 days ago
            </div>
        </div>
    </div>



  





</x-app-layout>
