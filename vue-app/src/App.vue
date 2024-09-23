<script setup>
import { ref } from 'vue';
let pages = ref("recommended");
function changePage(page) {
  pages.value = page;
  page != "recommended" && window.history.pushState(null, null, page);
  page == "recommended" && window.history.pushState(null, null, "/");
}

</script>

<template>
  <main class="w-full min-h-screen bg-custom-linear items-center flex flex-col justify-center" style="">
    <h1 class="text-2xl">Movie.in</h1>
    <p>Best Movie Website!</p>
    <form class="flex rounded-full overflow-hidden">
      <input type="search" class="pl-3" placeholder="Search for a movie.." name="search" id="">
      <input type="submit" value="Cari" class="bg-black p-1 cursor-pointer text-white " />
    </form>
  </main>
  <main class="bg-[#1F1414] w-full min-h-screen flex flex-col">
    <div class="flex gap-5 self-center font-semibold cursor-pointer">
      <button @click="changePage('recommended')"
        :class="pages == 'recommended' ? 'bg-yellow-500 text-black rounded-full p-2 font-bold' : 'text-yellow-500 p-2'">Recommended</button>
      <button @click="changePage('top_rated')"
        :class="pages == 'top_rated' ? 'bg-yellow-500 text-black rounded-full p-2 font-bold' : 'text-yellow-500 p-2'">Top
        Rated</button>
      <button @click="changePage('genres')"
        :class="pages == 'genres' ? 'bg-yellow-500 text-black rounded-full p-2 font-bold' : 'text-yellow-500 p-2'">Genres</button>
    </div>
  </main>
  <!-- <main class="bg-[#1F1414] w-full min-h-screen flex flex-col">

    <div class="flex gap-10 flex-wrap">
      @foreach ($this->recommendedData() as $datas)
      @foreach ($datas as $data)
      <span wire:key="{{ $data->{'id'} }}" class="flex flex-col w-72">
        <img class="w-72" src={{ "https://image.tmdb.org/t/p/original/" .$data->{'poster_path'} }} alt="">
        <span class="flex justify-between text-white ">
          <h1 class="text-xl font-semibold">{{ $data -> { 'title'} }}</h1>
          <p>{{ substr($data -> { 'release_date'}, 0, 4) }}</p>
          <p>{{ substr($data -> { 'vote_average'}, 0, 3) }}</p>
        </span>
      </span>
      @endforeach
      @endforeach

    </div>
    {{ --{{ dump($page) }}
    <div class="flex gap-5 self-center font-semibold cursor-pointer">
      @if ($page=="recommended")
      <button class="bg-yellow-500 text-black rounded-full p-2 font-bold">Recommended</button>
      @else
      <button onclick="navigate('/')" wire:click="recommendedPage"
        class="text-yellow-500 rounded-full p-2 font-bold">Recommended</button>
      @endif
      @if ($page=="top_rated")
      <button class="text-black bg-yellow-500 rounded-full p-2 font-bold">Top
        Rated</button>
      @else
      <button onclick="navigate('/top_rated')" wire:click="topRatedPage"
        class="text-yellow-500 rounded-full p-2 font-bold">Top Rated</button>
      @endif
      @if ($page=="genres")
      <button class="text-black bg-yellow-500 rounded-full p-2 font-bold">Genres
        @else
        <button onclick="navigate('/genres')" wire:click="genresPage"
          class="text-yellow-500 rounded-full p-2 font-bold">Genres
        </button>
        @endif

    </div> --}}
    {{ -- < div class="flex gap-5 flex-wrap" >
      @if ($action_page)
      @foreach($action_page as $item)
    <span class="flex flex-col" >
      <img class="w-72" src = {{ "https://image.tmdb.org/t/p/original/".$item -> { 'poster_path'} }} alt="">
        <span class="flex justify-between text-white ">
          <h1 class="text-xl font-semibold">{{ $item -> { 'title'} }}</h1>
          <p>{{ $item -> { 'release_date'} }}</p>
          <p>{{ $item -> { 'vote_average'} }}</p>
        </span>
      </span>
      @endforeach
      @elseif(isset($genres))
      @foreach ($genres as $genre)
      <span>
        <p class="text-white font-semibold">{{ $genre -> { 'name'} }}</p>
      </span>
      @endforeach
      @endif
    </div> --}}
    {{ --{{ dump($page) }}

    <div class="flex gap-5 flex-wrap">
      @if($page=="recommended")
      @foreach ($data as $item)
      <span class="flex flex-col w-72">
        <img class="w-72" src={{ "https://image.tmdb.org/t/p/original/" .$item->{'poster_path'} }} alt="">
        <span class="flex justify-between text-white ">
          <h1 class="text-xl font-semibold">{{ $item -> { 'title'} }}</h1>
          <p>{{ substr($item -> { 'release_date'}, 0, 4) }}</p>
          <p>{{ substr($item -> { 'vote_average'}, 0, 3) }}</p>
        </span>
      </span>
      @endforeach
      @elseif($page=="top_rated")
      @foreach ($data as $item)
      <span class="flex flex-col w-72 relative">
        <img class="w-72" src={{ "https://image.tmdb.org/t/p/original/" .$item->{'poster_path'} }} alt="">
        <span class="absolute right-0 flex">
          <x-typ-starburst class="w-20 text-red-700 text-opacity-50" />
          <p class="text-white font-bold text-xl absolute top-1/2 -translate-y-1/2 left-1/2  -translate-x-1/2">
            {{ substr($item -> { 'vote_average'}, 0, 3) }}</p>
        </span>

        <span class="flex justify-between text-white ">
          <h1 class="text-xl font-semibold">{{ $item -> { 'title'} }}</h1>
          <p>{{ substr($item -> { 'release_date'}, 0, 4) }}</p>

        </span>
      </span>
      @endforeach
      @else
      @foreach ($data as $genre)
      <span>
        <p class="text-white font-semibold">{{ $genre -> { 'name'} }}</p>
      </span>
      @endforeach
      @endif
    </div> --}}
    {{ -- < div class="flex gap-5 flex-wrap" >
      @if (isset($res))
      @foreach($res as $item)
    <div class="w-40" >
      <img src={ { $item -> { 'Poster'} }}
        class="" alt="">
        <span class="flex justify-between text-white ">
          <h2 class="text-xl">{{ $item -> { 'Title'} }}</h2>
          <p>{{ $item -> { 'Year'} }}</p>
        </span>
      </div>
      @endforeach
      @endif
    </div> --}}
  </main> -->
</template>

<style scoped></style>
