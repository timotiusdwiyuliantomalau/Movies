<script setup lang="ts">
import { useCookieUser, useModalStore } from '../utils/pinia/modalStore';
import { ref } from 'vue';

const [movie, video, playVideo, checkIdTicket] = [ref<any>({}), ref<any>({}), ref<boolean>(false), ref()];
const cookieUser = useCookieUser();
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
  let result = await response.json();
  result.genres = result.genres.map((genre: any) => genre.name);
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
  const idMovieUser = cookieUser.value.ticket;
  checkIdTicket.value = idMovieUser.find((idMovie: number) => idMovie == result.id);
};
function playTrailer() {
  playVideo.value = !playVideo.value;
}
const modal = useModalStore();
fetchAPI(props.id);
</script>

<template>
  <div class=" bg-gradient-to-b to-red-700 from-[rgb(5,4,4)] from-[50%]">
    <main class="min-h-screen">
      <div class="relative h-screen">
        <img class="object-center object-cover transform scale-x-[-1] h-full w-full relative"
          :src="'https://image.tmdb.org/t/p/original/' + movie.backdrop_path" alt="">
        <div class="w-full h-full bg-black top-0 absolute opacity-70"></div>

        <div class="flex gap-[3rem] absolute top-1/2 left-1/2 -translate-x-1/2">
          <div class="w-72 rounded-lg overflow-hidden relative h-fit">
            <img class="object-cover z-10" :src="'https://image.tmdb.org/t/p/original/' + movie.poster_path"
              alt="">
              <div class="absolute top-0 right-0 h-fit">
              <i class="bi bi-star-fill text-yellow-500 text-5xl"></i>
              <p class="text-lg font-bold text-white absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">{{ movie.vote_average }}</p>
            </div>
          </div>
          <div class="text-lg text-white z-10 w-[40rem]">
            <h1 class="text-2xl font-semibold mb-1">{{ movie.title }}</h1>
            <p class="text-yellow-500">( {{ movie.genres.join(", ") }} )</p>
            <p>{{ movie.overview }}</p>

            <div class="mt-8">
              <span class="flex gap-3">
                <i class="bi bi-clock"></i>
                <p>{{ movie.runtime }} min</p>
              </span>
              <span class="flex gap-3">
                <i class="bi bi-calendar"></i>
                <p>{{ movie.release_date }}</p>
              </span>
              <div class="flex space-x-2 mt-3">
                <div class="bg-yellow-500 text-white font-bold py-1 px-4 rounded">
                  XXI
                </div>
                <div class="bg-red-600 text-white font-bold py-1 px-4 rounded">
                  CGV
                </div>
                <div class="bg-blue-700 text-white font-bold py-1 px-4 rounded">
                  Cinépolis
                </div>
              </div>
            </div>
            <div class="flex absolute left-1/2 gap-[8rem] -translate-x-1/2 top-0">
              <iframe class="scale-150  w-[30rem] h-[20rem]" v-if="playVideo" ref="iframeTrailer"
                :src="`https://www.youtube.com/embed/${video.key}?autoplay=1&mute=1`" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
              <i v-if="playVideo" @click="playVideo = false"
                class="bi bi-x-lg font-bold text-4xl cursor-pointer -mt-[3em]"></i>
            </div>
            <div class="flex gap-10 items-center mt-5">
              <span class="flex items-center gap-2">
                <i class="bi bi-play-circle text-5xl cursor-pointer" @click="playTrailer"></i>
                <p>Watch Trailer</p>
              </span>

              <router-link :to="`/checkout/${movie.id}`" v-if="cookieUser.value.id && !checkIdTicket"
                class="bg-black text-yellow-500 hover:opacity-70 py-1 px-2 rounded-md">Buy
                Ticket</router-link>
              <button v-else-if="checkIdTicket"
                class="bg-black text-yellow-500 hover:opacity-70 py-1 px-2 rounded-md cursor-not-allowed">Buy
                Ticket</button>
              <button v-else @click="modal.open('top-[4.5rem]')"
                class="bg-black text-yellow-500 hover:opacity-70 py-1 px-2 rounded-md">Buy Ticket</button>
            </div>

          </div>
        </div>
      </div>

    </main>

    <div class="h-screen"></div>
  </div>
</template>