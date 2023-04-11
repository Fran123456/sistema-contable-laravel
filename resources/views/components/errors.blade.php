@foreach ($errors->all('<div class="alert alert-danger" role="alert"> :message </div>') as $message)
{!! $message !!}
@endforeach
