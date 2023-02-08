<x-app-layout>

    <div class="container">
      <div class="row">
  
        <div class="col-md-12">
          @include('blog.nav')
          
        </div>

        <div class="col-md-12">
            <div class="container-fluid py-5 card">
                <h1 class="display-5 fw-bold">Custom jumbotron</h1>
                <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
                
            </div>
        </div>

        <div class="col-md-6 mt-4">

            <div class="card">
                <div class="card-body">
                  This is some text within a card body.
                </div>
              </div>
            
        </div>

        <div class="col-md-6 mt-4">

            <div class="card">
                <div class="card-body">
                  This is some text within a card body.
                </div>
              </div>

        </div>

        <div class="col-md-12 mt-4">
            <a href="" class="btn btn-danger btn-lg pr-3">FIRMAR</a>
            <a target="_blank" href="{{Help::boletasPDF($id)}}" class="btn btn-danger btn-lg pr-3">VER BOLETA</a>
        </div>



      </div>
    </div>
  </x-app-layout>
  