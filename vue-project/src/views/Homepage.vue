<script lang="ts">
import { useCookieUser } from '../utils/pinia/modalStore';
import { defineComponent, ref } from 'vue';
export default defineComponent({
  setup() {
    const movieList = ref<any[]>();
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
    return { movieList, cookieUser };
  }
})

</script>

<template>
  <main>
    <div>
      <main class="w-full min-h-screen bg-custom-linear items-center flex flex-col justify-center" style="">
        <h1 class="text-2xl">Movie.in</h1>
        <p>Best Movie Website!</p>
        <form class="flex rounded-full overflow-hidden">
          <input type="search" class="pl-3" placeholder="Search for a movie.." name="search" id="">
          <input type="submit" value="Cari" class="bg-black p-1 cursor-pointer text-white " />
        </form>
      </main>
      <main class="flex flex-wrap gap-10 bg-[rgb(31,21,21)]">
        <div v-for="movie in movieList" :key="movie.id">
          
            <router-link :to="{ name: 'detail', params: { id: movie.id } }" class="relative">
              <div v-for="(movieId, index) in cookieUser.value.ticket" :key="index">
                <img class="w-[15rem] absolute rotate-[30deg] left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2"
                  src="/sold-image.png" v-if="movieId == movie.id" alt="">
              </div>
              <img class="w-72" :src="'https://image.tmdb.org/t/p/original/' + movie.poster_path" alt="">
              <p class="text-white">{{ movie.title }}</p>
              <p>{{ movie.release_date }}</p>
            </router-link>
          <!-- <div v-else>
            <router-link :to="{ name: 'detail', params: { id: movie.id } }" class="relative">
              <div v-for="(movieId, index) in cookieUser.value.ticket" :key="index">
                <img class="w-[15rem] absolute rotate-[30deg] left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2"
                  src="/sold-image.png" v-if="movieId == movie.id" alt="">
              </div>
              <img class="w-72" :src="'https://image.tmdb.org/t/p/original/' + movie.poster_path" alt="">
              <p class="text-white">{{ movie.title }}</p>
              <p>{{ movie.release_date }}</p>
            </router-link>
          </div> -->
        </div>
      </main>

    </div>
  </main>
</template>
