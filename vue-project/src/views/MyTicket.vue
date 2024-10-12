<script setup lang="ts">
import { ref } from 'vue';
import { useCookieUser } from '../utils/pinia/modalStore';
const cookieUser = useCookieUser();
const [arrayMovie] = [ref<any>()];
async function fetchMyTicket(id: number) {
    let data: any = await fetch(`http://localhost:8000/api/ticket/${id}`);
    data = await data.json();
    data.forEach((item: any) => {
        item.detail_movie = JSON.parse(item.detail_movie);
    })
    arrayMovie.value = data;
}
fetchMyTicket(cookieUser.value.id);
</script>
<template>
    <div class="grid justify-center bg-custom-linear p-6">
        <h1 class="text-center text-3xl mb-8 font-bold uppercase">My Ticket</h1>
        <main class="grid gap-8 grid-cols-2">
            <div class="flex gap-4 bg-gradient-to-b from-yellow-500 to-yellow-700 p-4 rounded-md cursor-pointer" v-for="(movie, i) in arrayMovie" :key="i">
                <router-link :to="{ name: 'detail', params: { id: movie.detail_movie.id }}">
                <img class="w-[13rem] h-[13rem] object-cover object-center"
                    :src="`https://image.tmdb.org/t/p/original/${movie.detail_movie.poster_path}`" alt="">
                </router-link>
                <div class="flex flex-col w-full h-full">
                    <p class="text-xl font-bold">{{ movie.detail_movie.title }}</p>                    
                    <span class="flex gap-1 items-center">
                        <i class="bi bi-calendar-fill w-4 text-[12px]"></i>
                        <p>{{ movie.date }}</p>
                    </span>
                    <span class="flex gap-1 items-center">
                        <i class="bi bi-alarm-fill w-4 text-[12px]"></i>
                        <p>{{ movie.time }}</p>
                    </span>
                    <span class="flex gap-1 items-center">
                        <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>seat-passenger</title><path  d="M9 19H15V21H9C6.24 21 4 18.76 4 16V7H6V16C6 17.66 7.34 19 9 19M10.42 5.41C11.2 4.63 11.2 3.36 10.42 2.58C9.64 1.8 8.37 1.8 7.59 2.58C6.81 3.36 6.81 4.63 7.59 5.41C8.37 6.2 9.63 6.2 10.42 5.41M11.5 9C11.5 7.9 10.6 7 9.5 7H9C7.9 7 7 7.9 7 9V15C7 16.66 8.34 18 10 18H15.07L18.57 21.5L20 20.07L14.93 15H11.5L11.5 9Z" /></svg>
                        <p>{{ JSON.parse(movie.seat).join(' | ') }}</p>
                    </span>
                    <span class="flex gap-1 items-center pb-2">
                    <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>theater</title><path d="M4,15H6A2,2 0 0,1 8,17V19H9V17A2,2 0 0,1 11,15H13A2,2 0 0,1 15,17V19H16V17A2,2 0 0,1 18,15H20A2,2 0 0,1 22,17V19H23V22H1V19H2V17A2,2 0 0,1 4,15M11,7L15,10L11,13V7M4,2H20A2,2 0 0,1 22,4V13.54C21.41,13.19 20.73,13 20,13V4H4V13C3.27,13 2.59,13.19 2,13.54V4A2,2 0 0,1 4,2Z" /></svg>
                    <p>{{ movie.theater }}</p>
                </span>
                <div v-if="movie.provider=='XXI'" class="bg-yellow-500 text-white font-bold py-1 px-4 rounded w-fit">
                  XXI
                </div>
                <div v-if="movie.provider=='CGV'" class="bg-red-600 text-white font-bold py-1 px-4 rounded w-fit">
                  CGV
                </div>
                <div v-if="movie.provider=='Cinepolis'" class="bg-blue-700 text-white font-bold py-1 px-4 rounded w-fit">
                  Cinépolis
                </div>
                    <p class="text-xl font-bold place-self-end ">${{ movie.price }}</p>
                    <p></p>
                </div>
            </div>
        </main>
    </div>
</template>
