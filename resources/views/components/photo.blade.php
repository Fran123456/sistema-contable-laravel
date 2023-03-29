@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        
@else
    <a></a><img class="rounded-circle" width="{{ $width??32 }}" height="{{ $height??32 }}" src="{{ $user->profile_photo_url }}"
    alt="{{ $user->name }}" /></a>
@endif
