<x-app-layout>

    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Reportes contables</li>
            </ol>
          </nav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="row">
        <div class="col-md-4 mt-2">
            <div class="card" >
                <div class="card-body">
                  <h5 class="card-title">Permisos</h5>
                  <a style="color:white"  href="" class="btn btn-primary" >
                     Ver
                  </a>
                </div>
              </div>
        </div>
    
        @foreach ($reportes as $r)
        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ $r->reporte }}</h5>
                  <button style="color:white" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rpt{{ $r->id }}">
                    {!! $r->icono !!} Generar
                  </button>
                </div>
              </div>
        </div>
        @include('components.config_reporte.modal')
        @endforeach
    </div>

</x-app-layout>