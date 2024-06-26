<x-app-layout>
    <x-slot:title>
        inicio
      </x-slot>

      <x-slot:subtitle>
      </x-slot>

    <h4 class="mb-2">Seleccione empresas para administrar</h4>

    <div class="col-md-12">
        <div class="row">


            @foreach (Help::usuario()->empresas as $e)
                <div class="col-md-6">
                    <div class="card mb-3 ">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/empresa.jpg') }}"
                                    class="img-fluid rounded-start mt-2 mb-2 ml-2 mr-2" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $e->empresa }}</h5>
                                    <p class="card-text">

                                    </p>

                                    @if ($e->id == Help::usuario()->empresa_id)
                                        <button type="button" disabled class="btn btn-danger">SELECCIONADA</button>
                                    @else
                                        <a href="{{ route('rrhh.cambioEmpresa',['id'=>Help::usuario()->id ,'empresa'=>$e->id]) }}" class="btn btn-success" style="color:aliceblue">Activar</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</x-app-layout>
