<x-app-layout>

    <div class="">

            <div class="col-md-12">
                <x-commonnav></x-commonnav>
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
