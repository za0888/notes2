{{--<x-app-layout>--}}

<x-main>
    <x-slot name="header">
        <x-navigation/>
    </x-slot>

    <x-slot name='sidebar'>
        @isset($themes)
            <h1>Themes:</h1>
            <ul class="flex flex-col">
                @foreach($themes as $theme)
                    <li class="flex-1 p-4 text-[#0D8ABC]">

                        <a href="{{route('themes.show',$theme->id)}}">{{$theme->name ?? 'NO THEMES'}}</a>

                    </li>
                @endforeach
            </ul>
        @endisset
    </x-slot>
    @isset($team)
        <h1 class="mb-8">All about team <span class="font-bold">{{strtoupper($team?->name) ?? ''}}</span> :</h1>
        <div class="prose lg:prose-xl prose-slate text-justify indent-8">Lorem ipsum dolor sit amet, consectetur
            adipisicing elit.
            {{$team->about ?? "Nothing. Just empty"}}
        </div>
    @endisset
</x-main>

{{--</x-app-layout>--}}
