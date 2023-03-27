<style>
    .text-bg-danger {
    color: white !important;
    background-color: RGBA(210, 109, 105, var(--bs-bg-opacity, 1)) !important;
}
</style>


@if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
    <div class="app-utility-item app-user-dropdown dropdown">
        
        @if (Auth::user()->currentTeam?->id)
        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
        aria-expanded="false">{{ Auth::user()->currentTeam?->name }}</a>
        @else  
        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
        aria-expanded="false">Sin equipo</a>
        @endif



        <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
            <!--<li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>-->
            @if (Auth::user()->currentTeam?->id)
            <li><a class="dropdown-item" href="{{ route('teamMe', Auth::user()->currentTeam?->id) }}">Equipo</a>
            </li>
            @endif

            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <li><a class="dropdown-item" href="{{ route('teams.create') }}">Nuevo equipo</a></li>
            @endcan
            <li><a class="dropdown-item" href="{{ route('invitations') }}">Mis solicitudes  
             <span class="badge text-bg-danger" >{{ Help::countTeamInvitations() }}</span>     </a></li>

            @if (count(Auth::user()->allTeams())>0)
                <li>
                    <hr class="dropdown-divider">
                </li>
                @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" />
                @endforeach
            @endif

           

          

        </ul>
    </div>
@endif
