<x-app-layout>

    <div class="">

            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mi equipo</li>
                  </ol>
            </div>

            <x-alert></x-alert>

            @include('me.team.team-edit')


            @if(Auth::user()->id ==$team->userOwner->id )
            <hr class="my-4" />
            @include('me.team.team-add-member')
            @endif



            @if (count($usersPedingInvitation)>0)
            <hr class="my-4" />
            @include('me.team.team-peding-invitation-team')
            @endif


            <hr class="my-4" />
            @include('me.team.team-members')



    </div>

</x-app-layout>
