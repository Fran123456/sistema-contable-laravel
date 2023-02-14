<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

      @php
      $routes =  Help::routerNav();
      @endphp
       @for ($i=0; $i < count(  $routes); $i++)
         @if ($i < (count(  $routes) - 1) )
           <li class="breadcrumb-item"><a href="{{$routes[$i]['url']}}">  {{ucfirst($routes[$i]['nombre'])}}  </a></li>
         @else
           <li class="breadcrumb-item active" aria-current="page">
              @if (isset( $current ))
                   {{ ucfirst($current) }}
              @else
                   {{ ucfirst($routes[$i]['nombre']) }}
              @endif
             </li>
         @endif

       @endfor


    </ol>
  </nav>
