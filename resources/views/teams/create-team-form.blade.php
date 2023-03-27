<x-jet-form-section submit="createTeam">
    <x-slot name="title">
        Detalles del nuevo equipo
    </x-slot>

    <x-slot name="description">
        Creación de un nuevo equipo para colaborar en proyectos u otros fines
    </x-slot>

    <x-slot name="form">
        <div class="mb-3">
            <x-jet-label value="Propietario" />

            <div class="d-flex mt-2">
                <img class="rounded-circle" width="48" src="{{ $this->user->profile_photo_url }}">

                <div class="ms-2">
                    <div>{{ $this->user->name }}</div>
                    <div class="text-muted">{{ $this->user->email }}</div>
                </div>
            </div>
        </div>

        <div class="w-md-75">
            <div class="mb-3">
                <x-jet-label for="name" value="Nombre del equipo" />
                <x-jet-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.name" autofocus />
                <x-jet-input-error for="name" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <button type="submit" class="btn app-btn-primary">
            <i class="fas fa-save"></i>
        </button>
    </x-slot>
</x-jet-form-section>