<x-app-layout>

    <div class="container">
      <div class="row">
  
        <div class="col-md-12">
            <x-commonnav page="Beneficios" ></x-commonnav>
          
        </div>

        <div class="col-md-6 col-xs-12 col-sm-6 mt-3 ">
            <div class="card bg-dark text-white ">
              <a href="{!! route('beneficios-tienda') !!}">
                <img src="{!! asset('banners/tiendita.jpg') !!}" class="card-img" alt="...">
              </a>
            </div>
        </div>



      </div>
    </div>
  
  </x-app-layout>
  