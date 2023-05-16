<x-app-layout>
    <div class="col-md-12">
        <x-commonnav  ></x-commonnav>
    </div>

    <h4 class="mb-2">Seleccione empresas para administrar</h4>

    <div class="col-md-12">
        <div class="row">

        </div>
        @foreach (Help::usuario()->empresas as $e)
            
            <div  class="col-md-4">
                <div class="card mb-3" @if ($e->id == Help::usuario()->usuario?->empresa_id) style="color:red" @endif >
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">{{ $e->empresa }}</h5>
                          <p class="card-text">
                            
                          </p>
                         <a href="" class="btn btn-success" style="color:aliceblue">Activar</a>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            
        @endforeach
    </div>
    

</x-app-layout>
