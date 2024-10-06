<script setup lang="ts">
import { useModalStore } from '../utils/pinia/modalStore';
import { ref, useTemplateRef } from 'vue';

const [movie,video,playVideo,cookieUser] = [ref<any>({}),ref<any>({}),ref<boolean>(false),ref<any>(null)];
const props = defineProps({
  id: { type: String, required: true },
});
async function fetchAPI(id: string) {
  const response = await fetch(`https://api.themoviedb.org/3/movie/${id}`, {
    headers: {
      "Content-Type": "application/json",
      "Authorization": "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNzI0OTYyNy40MzYyODcsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.FViH-OykcA9ObXH1szatPBE3stebjh2upjfDEF5yNEA",
    }
  })
  const result = await response.json();
  let resVideo: any = await fetch(`https://api.themoviedb.org/3/movie/${id}/videos`, {
    headers: {
      "Content-Type": "application/json",
      "Authorization": "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNzI0OTYyNy40MzYyODcsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.FViH-OykcA9ObXH1szatPBE3stebjh2upjfDEF5yNEA",
    }
  });
  resVideo = (await resVideo.json()).results;
  resVideo = resVideo[resVideo.length - 1];
  movie.value = result;
  video.value = resVideo;
  cookieUser.value = decodeURIComponent(document.cookie);
};
function playTrailer() {
  playVideo.value = !playVideo.value;
}
const modal = useModalStore();
fetchAPI(props.id);
</script>

<template>
  <div class="bg-yellow-400">
    <main class="h-full">
      <img class="object-center object-cover transform scale-x-[-1] h-full"
        :src="'https://image.tmdb.org/t/p/original/' + movie.backdrop_path" alt="">
      <div class="w-full h-full bg-black top-0 opacity-80"></div>
      <span class="flex flex-col gap-5">
        <img class="w-[15rem] z-10" :src="'https://image.tmdb.org/t/p/original/' + movie.poster_path" alt="">
        <span class="text-xs text-white z-10">
          <h1 class="">{{ movie.title }}</h1>
          <p>{{ movie.release_date }}</p>
          <p>{{ movie.overview }}</p>
        </span>
      </span>
    </main>
    <iframe v-if="playVideo" ref="iframeTrailer" :src="`https://www.youtube.com/embed/${video.key}?autoplay=1&mute=1`"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
      allowfullscreen></iframe>
    <button class="bg-red-500 p-3" @click="playTrailer()">Klik</button>
    <router-link :to="`/checkout/${movie.id}`" v-if="cookieUser.length > 0" class="bg-red-600 p-3">Buy Ticket</router-link>
    <button v-if="cookieUser.length == 0" @click="modal.open('top-[4.5rem]')" class="bg-red-600 p-3">Buy Ticket</button>
  </div>
</template>