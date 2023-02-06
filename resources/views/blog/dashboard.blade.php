<x-app-layout>

  <div class="container">
    <div class="row">

      <div class="col-md-8 col-xs-12 xol-sm-12">
        <div class="alert alert-primary" role="alert">
          Publicaciones más recientes
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          
        @for ($i =0 ; $i < count($blogs) ; $i++)
        @php
        $url =   Help::pathAssets(  'imagen-post/' . $blogs[$i]['imagenPrevia'])  ;
        @endphp

          <div class="col">
            <div class="card h-100">
              <img src="{{$url }}" class="card-img-top" height="170" width="90" alt="Los Angeles Skyscrapers"/>
              <div class="card-body">
                <h6 class="card-title">{{$blogs[$i]['titulo']}}</h6>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
              </div>
            </div>
          </div>
          @endfor

        </div>
      </div>

      <div class="col-md-4 col-xs-12 xol-sm-12">

        <div class="alert alert-primary" role="alert">
          Tipo de publicaciones
        </div>
          
        <ul class="list-group list-group-light">

          @for ( $i =0 ; $i < count($tipos) ; $i++)

          @php
            $url =   Help::pathAssets(  'imagen-tipos-mas/' . $tipos[$i]['imagen'])  ;
          @endphp

          <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="">
              <div class="d-flex align-items-center">
                <img src="{{$url }}"  alt=""
                  style="width: 115px; height: 85px" />
                <div class="ms-3">
                  <p class="fw-bold mb-1">{{$tipos[$i]['tipo']}}</p>
                  
                </div>
              </div>
            </a>
        
           
          </li>
              
          @endfor
          
          
          
        </ul>

      </div>

    </div>
  </div>

</x-app-layout>
