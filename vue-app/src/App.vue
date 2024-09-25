<script lang="ts">
import { defineComponent } from 'vue';
export default defineComponent({
  name: 'App',
  script() {
    const url = window.location.pathname;
    return { url };
  }
});

// import { ref } from 'vue';
// import { useRoute } from 'vue-router';

// const route = useRoute();
// const url = ref("recommended");
// let movieList = ref([]);
// 
// const url = window.location.pathname;

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
  <!-- <main class="bg-[#1F1414] w-full min-h-screen flex flex-col">
    <div v-for="movie in movieList">
      
      <p class="text-white">{{ movie.title }}</p> -->
      <!-- <img class="w-72" src="https://image.tmdb.org/t/p/original/"+{{ ${movie.poster_path} }} alt="">
    <span class=" flex justify-between text-white ">
 <h1 class=" text-xl font-semibold">{{ movie.title }}</h1>
<p>{{ substr($data -> { 'release_date'}, 0, 4) }}</p>
      <p>{{ substr($data -> { 'vote_average'}, 0, 3) }}</p>
      
</span> -->

    <!-- </div>
  </main> -->
</template>

<!-- <div class="flex gap-5 self-center font-semibold cursor-pointer">
  <button @click="changePage('/')"
    :class="url == '/' ? 'bg-yellow-500 text-black rounded-full p-2 font-bold' : 'text-yellow-500 p-2'">Recommended</button>
  <button @click="changePage('/top_rated')"
    :class="url == '/top_rated' ? 'bg-yellow-500 text-black rounded-full p-2 font-bold' : 'text-yellow-500 p-2'">Top
    Rated</button>
  <button @click="changePage('/genres')"
    :class="url == '/genres' ? 'bg-yellow-500 text-black rounded-full p-2 font-bold' : 'text-yellow-500 p-2'">Genres</button>
</div> -->
<style scoped></style>
