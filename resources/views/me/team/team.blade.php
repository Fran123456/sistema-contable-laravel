<x-app-layout>

    <div class="">

            <div class="col-md-12">
                <x-commonnav></x-commonnav>
            </div>
            
            <x-alert></x-alert>

            @include('me.team.team-edit')
            <hr class="my-4" />
            @include('me.team.team-add-member')
            <hr class="my-4" />
            @include('me.team.team-peding-invitation-team')

            <hr class="my-4" />
            @include('me.team.team-members')


          
    </div>
    
</x-app-layout>
