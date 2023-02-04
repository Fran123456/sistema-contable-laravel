<x-app-layout>

  <div class="container">
    <div class="row">

      <div class="col-md-8 col-xs-12 xol-sm-12">

        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card h-100">
              <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/044.webp" class="card-img-top" alt="Skyscrapers"/>
              <div class="card-body">
                <h6 class="card-title">Card title</h6>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/043.webp" class="card-img-top" alt="Los Angeles Skyscrapers"/>
              <div class="card-body">
                <h6 class="card-title">Card title</h6>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp" class="card-img-top" alt="Palm Springs Road"/>
              <div class="card-body">
                <h6 class="card-title">Card titleffffffffffffffffffffffffffffffffffffffff</h6>

              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-md-4 col-xs-12 xol-sm-12">

        <div class="alert alert-primary" role="alert">
          Tipo de publicaciones
        </div>
 
        <ul class="list-group list-group-light">

          @for ( $i =0 ; $i < count($tipos) ; $i++)

          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" class="rounded-circle" alt=""
                style="width: 45px; height: 45px" />
              <div class="ms-3">
                <p class="fw-bold mb-1">Kate Hunington</p>
                <p class="text-muted mb-0">kate.hunington@gmail.com</p>
              </div>
            </div>
        
            <a class="btn btn-link btn-rounded btn-sm" href="#" role="button">View</a>
          </li>
              
          @endfor
          
          
          
        </ul>

      </div>

    </div>
  </div>

</x-app-layout>
