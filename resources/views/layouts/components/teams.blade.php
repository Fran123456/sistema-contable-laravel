@if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
    <div class="app-utility-item app-user-dropdown dropdown">
        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
            aria-expanded="false">{{ Auth::user()->currentTeam->name }}</a>



        <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
            <!--<li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>-->
            <li><a class="dropdown-item" href="{{ route('teamMe', Auth::user()->currentTeam->id) }}">Equipo</a>
            </li>

            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <li><a class="dropdown-item" href="{{ route('teams.create') }}">Nuevo equipo</a></li>
            @endcan

            <li>
                <hr class="dropdown-divider">
            </li>

            @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" />
            @endforeach

        </ul>
    </div>
@endif
