<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-xl h-screen ">
<main class="grid grid-cols-[1fr_6fr] grid-rows-[150px_minmax(900px,_1fr)_100px] h-full auto-cols-max">

    <header
        class="flex justify-between gap-8 col-start-1 col-span-2  bg-gray-200 text-gray-700 p-8 place-content-center">
        <div>
            <a href="{{route('home')}}">
                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=Nt" alt="">
            </a>

            @isset($team)
                <h1 class="text-teal-700">Team {{$team->name ?? 'EMPTY'}}</h1>
            @endisset
        </div>

        @isset($header)

            {{$header}}

        @endisset

    </header>

    <!-- sidebar -->
    <section class="col-start-1 col-end-2 h-full bg-gray-200 text-gray-700 p-8">

        @isset($sidebar)
            {{$sidebar}}
        @endisset

    </section>

    <main class="col-start-2 col-span-1 row-auto p-8">

{{--        @isset($team)--}}
{{--            <h1 class="text-2xl font-bold">All about {{$team->name}}</h1>--}}
{{--        @endisset--}}

       {{$slot}}
    </main>

</main>
</body>
</html>
