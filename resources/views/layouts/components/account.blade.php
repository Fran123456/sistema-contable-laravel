<div class="app-utility-item app-user-dropdown dropdown">


    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
        aria-expanded="false"><img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}"
        alt="{{ Auth::user()->name }}" /></a>
    @else
        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
        aria-expanded="false"><img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}"
        alt="{{ Auth::user()->name }}" /></a>
    @endif


    <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
        <li><a class="dropdown-item" href="{{ route('me') }}">Perfil</a></li>
        <li><a class="dropdown-item" href="settings.html">Settings</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Salir</a>
        </li>

        <form method="POST" id="logout-form" action="{{ route('logout') }}">
            @csrf
        </form>
    </ul>
</div>
