<script lang="ts">
import { defineComponent, ref } from 'vue';

export default defineComponent({
  setup() {
    const movieList = ref<any[]>();
    async function laravel() {
      const response = await fetch("https://api.themoviedb.org/3/movie/now_playing?languange=en-US&page=1", {
        headers: {
          "Content-Type": "application/json",
          "Authorization": "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNjA2NjU3MS4yOTQ0NDksInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.NvpH6GCNYQDsnbm1ZkwFfmKtS1qW504s1sJUXJ_eEh8",
        }
      });
      const result = (await response.json()).results;
      movieList.value = result;
      console.log(result);
    };
    laravel();
    return { movieList };
  }
})

</script>

<template>
  <main>

    <div>
      <main class="w-full min-h-screen bg-custom-linear items-center flex flex-col justify-center" style="">
        <h1 class="text-2xl">Movie.in</h1>
        <p>Best Movie Website!</p>
        <img class="w-[20rem]" src="/sold-image.png" alt="">
        <form class="flex rounded-full overflow-hidden">
          <input type="search" class="pl-3" placeholder="Search for a movie.." name="search" id="">
          <input type="submit" value="Cari" class="bg-black p-1 cursor-pointer text-white " />
        </form>
      </main>

      <main class="flex flex-wrap gap-10 bg-[rgb(31,21,21)]">
        <div v-for="movie in movieList" :key="movie.id">
          <router-link :to="{ name: 'detail', params: { id: movie.id } }">
            <img class="w-72" :src="'https://image.tmdb.org/t/p/original/' + movie.poster_path" alt="">
            <p class="text-white">{{ movie.title }}</p>
            <p>{{ movie.release_date }}</p>
          </router-link>
        </div>
      </main>
      
    </div>
  </main>
</template>
