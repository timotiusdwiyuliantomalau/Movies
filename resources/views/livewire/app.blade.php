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
            @if (count(explode("/",$url))==3)
            <button class="bg-yellow-500 text-black rounded-full p-2 font-bold">Recommended</button>
            @else
            <button onclick="navigate('/')" wire:click="recommendedPage"
                class="text-yellow-500 rounded-full p-2 font-bold">Recommended</button>
            @endif
            @if (count(explode("/",$url))==4&&explode("/",$url)[3]=='top_rated')
            <button class="text-black bg-yellow-500 rounded-full p-2 font-bold">Top
                Rated</button>
            @else
            <button onclick="navigate('/top_rated')" wire:click="topRatedPage"
                class="text-yellow-500 rounded-full p-2 font-bold">Top Rated</button>
            @endif
            @if (count(explode("/",$url))==4&&explode("/",$url)[3]=='genres')
            <button class="text-black bg-yellow-500 rounded-full p-2 font-bold">Genres
                @else
                <button wire:click="genresPage" onclick="navigate('/genres')"
                    class="text-yellow-500 rounded-full p-2 font-bold">Genres
                </button>
                @endif


        </div>
        <div class="flex gap-5 flex-wrap">
            @if($action_page)
            @foreach ($action_page as $item)
            <span class="flex flex-col">
                <img class="w-72" src={{ "https://image.tmdb.org/t/p/original/" .$item->{'poster_path'} }} alt="">
                <span class="flex justify-between text-white ">
                    <h1 class="text-xl font-semibold">{{ $item->{'title'} }}</h1>
                    <p>{{ $item->{'release_date'} }}</p>
                    <p>{{ $item->{'vote_average'} }}</p>
                </span>
            </span>
            @endforeach
            @elseif(isset($genres))
            @foreach ($genres as $genre)
            <span>
                <p class="text-white font-semibold">{{ $genre->{'name'} }}</p>
            </span>
            @endforeach
            @endif
        </div>

        <div class="flex gap-5 flex-wrap">
            @if(isset($data[0]->{'title'}))
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
            @else
            @foreach ($data as $genre)
            <span>
                <p class="text-white font-semibold">{{ $genre->{'name'} }}</p>
            </span>
            @endforeach
            @endif
        </div>
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
<script>
    function navigate(url){
        window.history.pushState({}, '', url);
    }
</script>