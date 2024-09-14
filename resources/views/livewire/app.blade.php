<div>
    <main class="w-full min-h-screen bg-custom-linear items-center flex flex-col justify-center" style="">
        <h1 class="text-2xl">Movie.in</h1>
        <p>Best Movie Website!</p>
        <form class="flex rounded-full overflow-hidden">
            <input type="search" class="pl-3" class="" placeholder="Search for a movie.." name="search" id="">
            <input type="submit" value="Cari" class="bg-black p-1 cursor-pointer text-white " />
        </form>
    </main>
    <main class="bg-[#1F1414] w-full min-h-screen flex flex-col">
        <div class="flex gap-5 self-center font-semibold cursor-pointer">
            <button wire:click="actionFetch" class="bg-yellow-500 text-black rounded-full p-2 font-bold">For
                You</button>
            <p class="text-yellow-500 rounded-full p-2 font-bold">Category
            </p>
            <p wire:click="$actionFetch" class="text-yellow-500 rounded-full p-2 font-bold">Top Rated</p>
        </div>
        {{-- <div class="flex gap-5 flex-wrap">
            @foreach ($data as $item)
            <span class="flex flex-col">
                <img class="w-72" src={{ "https://image.tmdb.org/t/p/original/" .$item->{'poster_path'} }} alt="">
                <span class="flex justify-between text-white ">
                    <h1 class="text-xl font-semibold">{{ $item->{'title'} }}</h1>
                    <p>{{ $item->{'release_date'} }}</p>
                    <p>{{ $item->{'vote_average'} }}</p>
                </span>
            </span>
            @endforeach
        </div> --}}
        {{-- <div class="flex gap-5 flex-wrap">
            @if(isset($res))
            @foreach ($res as $item)
            <div class="w-40">
                <img src={{ $item->{'Poster'} }}
                class="" alt="">
                <span class="flex justify-between text-white ">
                    <h2 class="text-xl">{{ $item->{'Title'} }}</h2>
                    <p>{{ $item->{'Year'} }}</p>
                </span>
            </div>
            @endforeach
            @endif
        </div> --}}
    </main>
</div>