<script lang="ts">
import { useCookieUser } from '../utils/pinia/modalStore';
import 'bootstrap-icons/font/bootstrap-icons.css';
import { defineComponent, ref } from 'vue';
export default defineComponent({
  setup() {
    const [movieList, search, movieSearch] = [ref<any[]>(), ref<string>(""), ref<any[]>()];
    const cookieUser = useCookieUser();
    async function laravel() {
      const response = await fetch("https://api.themoviedb.org/3/movie/now_playing?languange=en-US&page=1", {
        headers: {
          "Content-Type": "application/json",
          "Authorization": "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNjA2NjU3MS4yOTQ0NDksInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.NvpH6GCNYQDsnbm1ZkwFfmKtS1qW504s1sJUXJ_eEh8",
        }
      });
      const result = (await response.json()).results;
      movieList.value = result;
    };
    laravel();
    return { movieList, cookieUser, search, movieSearch };
  },
  methods: {
    async handleSearchMovie() {
      const response = await fetch(`
https://api.themoviedb.org/3/search/movie?query=${this.search}&page=1`, {
        headers: {
          'Content-Type': "application/json",
          'Authorization': "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNjA2NjU3MS4yOTQ0NDksInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.NvpH6GCNYQDsnbm1ZkwFfmKtS1qW504s1sJUXJ_eEh8"
        }
      })
      const result = await response.json();
      this.movieSearch = result.results;
      console.log(result.results);
    }
  }
})

</script>

<template>
  <div class="relative grid">
    <main class="w-full h-screen  items-center flex flex-col justify-center bg-custom-linear relative overflow-hidden ">
      <div class="flex flex-col z-20 absolute text-center items-center">
        <h1 class="text-5xl font-bold text-red-600">Movie.<span class="text-white">in</span></h1>
        <p class="text-xl italic text-yellow-500 tracking-wider">Website for purchasing ticket movie!</p>
        <form @submit.prevent="handleSearchMovie()"
          class="flex rounded-full overflow-hidden bg-white mt-8 w-3/4 justify-between">
          <input type="text" autocomplete="off" class="pl-4 focus:outline-none " placeholder="Search for a movie.."
            v-model="search" id="">
          <button type="submit" class="p-1 pr-3">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>
      <span class="bg-black w-full h-full absolute top-0 left-0 z-10 opacity-70"></span>
      <img src="/bg-web.jpg" class=" top-0 left-0 absolute blur-sm h-full w-full" alt="">
    </main>

    <main class="bg-gradient-to-b from-black to-[rgb(31,21,21)] to-[2%] items-center flex flex-col gap-[5rem] pt-[4rem]">
      <main class="grid gap-5" v-if="movieSearch">
        <h2 class="text-yellow-500 text-2xl text-left w-screen pl-[4rem]">Hasil pencarian "{{ search }}" :</h2>
        <div class="flex flex-wrap gap-10  justify-center">
          <div v-for="(movie, i) in movieSearch" :key="i">
            <router-link :to="{ name: 'detail', params: { id: movie.id } }" class="relative">
              <div v-for="(movieId, index) in cookieUser.value.ticket" :key="index">
                <img class="w-[15rem] absolute rotate-[30deg] left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2"
                  src="/sold-image.png" v-if="movieId == movie.id" alt="">
              </div>
              <img class="w-72" :src="'https://image.tmdb.org/t/p/original/' + movie.poster_path" alt="">
              <p class="text-white text-xl font-semibold text-center">{{ movie.title }}</p>
            </router-link>
          </div>
        </div>
      </main>

      <main class="grid gap-8">
        <h2 class="text-yellow-500 font-bold text-2xl text-center tracking-widest">MOVIE NOW PLAYING</h2>
        <div class="flex flex-wrap justify-center gap-10">
          <div class="" v-for="movie in movieList" :key="movie.id">
            <router-link :to="{ name: 'detail', params: { id: movie.id } }" class="relative">
              <div v-for="(movieId, index) in cookieUser.value.ticket" :key="index">
                <img class="w-[15rem] absolute rotate-[30deg] left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2"
                  src="/sold-image.png" v-if="movieId == movie.id" alt="">
              </div>
              <img class="w-72" :src="'https://image.tmdb.org/t/p/original/' + movie.poster_path" alt="">
              <p class="text-white text-xl font-semibold text-center ">{{ movie.title }}</p>
            </router-link>
          </div>
        </div>
      </main>
    </main>
  </div>
</template>
