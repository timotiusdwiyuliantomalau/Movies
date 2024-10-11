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
    console.log(data);
}
fetchMyTicket(cookieUser.value.id);
</script>
<template>
    <div class="grid justify-center">
        <h1 class="text-center text-3xl mb-5">My Ticket</h1>
        <main class="grid gap-8 grid-cols-2">
            <div class="flex gap-4" v-for="(movie, i) in arrayMovie" :key="i">
                <img class="w-[15rem] h-[15rem] object-cover object-center"
                    :src="`https://image.tmdb.org/t/p/original/${movie.detail_movie.poster_path}`" alt="">
                <div class="flex flex-col">
                    <p class="text-xl font-semibold">{{ movie.detail_movie.title }}</p>
                    <p>{{ movie.provider }}</p>
                    <span>
                        <i class="bi bi-calendar"></i>
                        <p>{{ movie.date }}</p>
                    </span>
                    <span>
                        <i class="bi bi-alarm"></i>
                        <p>{{ movie.time }}</p>
                    </span>
                    <span>
                        
                        <p>{{ JSON.parse(movie.seat).join(',') }}</p>
                    </span>
                    <p>{{ movie.theater }}</p>
                    <p class="text-xl font-semibold">${{ movie.price }}</p>
                    <p></p>
                </div>
            </div>
        </main>
    </div>
</template>
