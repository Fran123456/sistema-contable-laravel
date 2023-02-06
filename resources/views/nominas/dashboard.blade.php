<x-app-layout>

    <div class="container">
      <div class="row">
  
        <div class="col-md-12">
          @include('blog.nav')
          
        </div>

        <div class="col-md-6 col-xs-12 col-sm-6 mt-3 ">
            <div class="card bg-dark text-white ">
              <a href="{!! route('nominas-boletas') !!}">
                <img src="{!! asset('banners/boleta.jpg') !!}" class="card-img" alt="...">
              </a>
            </div>
        </div>


        <div class="col-md-6 col-xs-12 col-sm-6 mt-3 ">
            <div class="card bg-dark text-white ">
              <a href="{!! route('nominas-dashboard') !!}">
                <img src="{!! asset('banners/prestamos.jpg') !!}" class="card-img" alt="...">
              </a>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 col-sm-6 mt-3 ">
            <div class="card bg-dark text-white ">
              <a href="{!! route('nominas-dashboard') !!}">
                <img src="{!! asset('banners/solicitud-constancias.jpg') !!}" class="card-img" alt="...">
              </a>
            </div>
        </div>

        
        <div class="col-md-6 col-xs-12 col-sm-6 mt-3 ">
            <div class="card bg-dark text-white ">
              <a href="{!! route('nominas-dashboard') !!}">
                <img src="{!! asset('banners/vacaciones.jpg') !!}" class="card-img" alt="...">
              </a>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 col-sm-6 mt-3 ">
            <div class="card bg-dark text-white ">
              <a href="{!! route('nominas-dashboard') !!}">
                <img src="{!! asset('banners/renta.jpg') !!}" class="card-img" alt="...">
              </a>
            </div>
        </div>
  
  
        
        
  
      </div>
    </div>
  
  </x-app-layout>
  