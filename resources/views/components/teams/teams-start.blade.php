<x-guest-layout>
    <h1 class="text-2xl text-center shadow-2xl shadow-gray-500 font-sans m-8">
        Teams
    </h1>
    <div class="flex flex-wrap justify-center w-full gap-10">

        @foreach ($teams as $team )

            <section class="basis-80 shadow-xl shadow-gray-500">
                <a href="{{ route('register',$team->id) }}"
                   class="block w-full h-full text-black p-8 prose lg:prose-xl mb-4">

                    <span class="text-red-700 p-4">{{strtoupper($team->name ?? '')}}</span>
                    <br/>
                    {{$team?->about ?? ''}}
                    <ul class="mb-20 text-xl font-bold">
                        Team is interested in the following themes:

                        @foreach($team->themes as $theme)
                            <li class="text-gray-500">{{$theme->name ?? 'No themes yet'}}</li>
                        @endforeach

                    </ul>
                </a>



            </section>

        @endforeach

    </div>


</x-guest-layout>
