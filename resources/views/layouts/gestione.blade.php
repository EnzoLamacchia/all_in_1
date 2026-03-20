<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/assets/img/brainOrange.png" />
    <title>{{ config('app.name', 'Gestione') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
{{--    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/> <!--Replace with your tailwind.css once created-->
{{--    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->--}}

    <!-- Scripts -->
{{--    <script src="{{ mix('js/app.js') }}" defer></script>--}}
    @vite('resources/js/app.js')
    <script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous"></script>
{{--    <script src="//unpkg.com/alpinejs" defer></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

</head>
<body class="font-sans antialiased bg-white">
<div class="flex flex-row">
    {{--        <x-jet-banner />--}}

    {{--        @stack('modals')--}}

    {{--        @livewireScripts--}}

    <x-sidebar.menu></x-sidebar.menu>

    <div class="flex w-full bg-white overflow-hidden">
        {{$slot}}
    </div>

</div>
<script>
    $(document).ready(function(){
        $("#salvato").fadeOut(3000); //esegue il fadeOut sul messaggio di alert di modifica di un album
    })
    // var s = document.getElementById('salvato').style;
    //  s.opacity = 1;
    //  (function fade(){(s.opacity-=.05)<0?s.display="none":setTimeout(fade,200)})();
</script>
</body>
</html>
