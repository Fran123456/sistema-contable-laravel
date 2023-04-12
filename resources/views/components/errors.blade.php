@if ($errors->any())
<div class="alert alert-danger" role="alert">

    @foreach ($errors->all('<li> :message </li>') as $message)
        {!! $message !!}
    @endforeach

</div>

@endif