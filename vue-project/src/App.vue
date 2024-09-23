<script setup lang="ts">
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const pages = ref("recommended");
const movieList = ref([]);
function changePage(page: string) {
  pages.value = page;
  // page != "recommended" ? navigate(`/${page}`) : navigate(`/`);
}
async function laravel() {
  const response = await fetch('https://api.themoviedb.org/3/movie/now_playing?language=en-US&page=1', {
    headers: {
      "Content-Type": "application/json",
      "Authorization": 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNzA5MTQ2OS43NjA5NzIsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DTu9Plr3-Q-hQ9yFL0SafKT8qSoYp_f5tGdWwLRHjxY'
    },
    method: "GET",
  })
  const result = await response.json();
  movieList.value = result.results;
}
const url = window.location.pathname;
</script>

<template>
  <button @click="laravel">KLIK</button>
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
    <div v-for="movie in movieList">
      <img class="w-72" src={{ 'https://image.tmdb.org/t/p/original/${movie.poster_path}' }} alt="">
      <span class=" flex justify-between text-white ">
        <h1 class=" text-xl font-semibold">{{ movie.title }}</h1>
        <p>{{ substr($data -> { 'release_date'}, 0, 4) }}</p>
        <p>{{ substr($data -> { 'vote_average'}, 0, 3) }}</p>
      </span>
    </div>
  </main>
</template>

<style scoped></style>
