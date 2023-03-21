@props(['team', 'component' => 'jet-dropdown-link'])

<x-dynamic-component :component="$component" href="#" onclick="event.preventDefault();
                                                 document.getElementById('switch-team-form-{{ $team->id }}').submit();">
    <div class="d-flex align-content-center">
        @if (Auth::user()->isCurrentTeam($team))
            
            <div class="text-truncate" style="width: 12rem;"><i class="fa fa-check-circle link-primary"></i>&nbsp;<span class="link-primary">{{ $team->name }}</span></div>
        @else 
        <div class="text-truncate" style="width: 12rem;"><i class="fas fa-dot-circle "></i>&nbsp;  {{ $team->name }}  </div>
            @endif



        
    </div>

    <form method="POST" action="{{ route('current-team.update') }}" id="switch-team-form-{{ $team->id }}">
        @method('PUT')
        @csrf

        <!-- Hidden Team ID -->
        <input type="hidden" name="team_id" value="{{ $team->id }}">
    </form>
</x-dynamic-component>


