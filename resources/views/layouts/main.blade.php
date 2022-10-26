@php
    if (Auth::hasUser()){
    $team=\Illuminate\Support\Facades\Auth::user()->team;
}
@endphp

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
            <a href="">
                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=Nt" alt="">
            </a>
            @isset($team)
                <h1 class="text-teal-700">Team {{$team->name}}</h1>
            @endisset
        </div>

        @isset($header)

            {{$header}}

        @endisset

        <div class="relative h-8 flex items-top justify-center dark:bg-gray-700 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block p-8 z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-xl text-gray-700 dark:text-gray-500 underline">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 text-xl text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>

    <!-- sidebar -->
    <section class="col-start-1 col-end-2 h-full bg-gray-200 text-gray-700 p-8">

        @isset($sidebar)
            {{$sidebar}}
        @endisset

    </section>

    <main class="col-start-2 col-span-1 row-auto p-8">

        @isset($team)
            <h1 class="text-2xl font-bold">All about {{$team->name}}</h1>
        @endisset

        @isset($main)
            {{$main}}
        @endisset
    </main>

</main>
</body>
</html>
