<x-app-layout>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Yo</li>
          </ol>
    </div>

    <div class="">
            <div class="container-xl">
                <h1 class="app-page-title">Sobre {{ Auth::user()->name }}</h1>
                <hr class="mb-4" />

                <x-alert></x-alert>

                @include('me.components.me-edit')


                <hr class="my-4" />


            </div>
    </div>


</x-app-layout>
