<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Create Team') }}
        </h2>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crea un nuevo equipo</li>
          </ol>
    </div>

    <div>
        @livewire('teams.create-team-form')
    </div>
</x-app-layout>
