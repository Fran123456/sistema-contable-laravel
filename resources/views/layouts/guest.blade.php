<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->


        <!-- Scripts -->
        @vite(['resources/sass/app.scss','resources/js/app.js'])
        <style media="screen">
          .black{
            background-color: #1C5589;
          }
        </style>
    </head>
    <body class="black font-sans antialiased ">
        {{ $slot }}
    </body>
</html>
