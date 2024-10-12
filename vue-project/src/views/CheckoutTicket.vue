<script setup lang="ts">
import { useFlashMessageSuccess } from '../utils/pinia/flashMessageSuccess';
import { ref } from 'vue';
const props = defineProps({
    id: { type: String, required: true }
});
const detailMovie = ref<any>({});
const flashSuccess = useFlashMessageSuccess();
const [cinemas, price, seat, time, theater, date, provider, cookieUser] = [ref<any>(), ref<number>(0), ref<any[]>([]), ref<any>(""), ref<any>(""), ref<any>(""), ref<any>(""), ref()];
const [dynamicTicket, totalTicket, errorBuy] = [ref<number>(1), ref<number>(1), ref<any>()];

async function fetchMovie(id: string) {
    const res = await fetch(`https://api.themoviedb.org/3/movie/${id}`, {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNzg4MzgwNS43NTE3Miwic3ViIjoiNjZkYmYxMTgzMzQyMTE0ZjIxZWM0ZGYwIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.2aQDYl_kWGoWGRiPMcBloudjIsR9bxZnpRDZaxVsRnQ'
        }
    });
    const result = await res.json();
    detailMovie.value = result;
    cookieUser.value = decodeURIComponent(document.cookie).split('=');
    cookieUser.value.map((c: any, i: number) => {
        if (c == 'User') cookieUser.value = JSON.parse(cookieUser.value[i + 1])
    })
}
fetchMovie(props.id);
async function changeId(event: any) {
    const res = await fetch(`http://localhost:8000/api/cinema/${event.target.id}`);
    const result = await res.json();
    let data: any = { theater: [], seat: [] };
    for (let i = 0; i < result.data.theater; i++) {
        data.theater.push(`Theater ${i + 1}`);
    }
    for (let i = 0; i < result.data.total_seat; i++) {
        data.seat.push(`${i + 1}`);
    }
    result.data.total_seat = data.seat;
    result.data.theater = data.theater;
    cinemas.value = result.data;
    price.value = result.data.price;
    provider.value = result.data.provider;
}
function setSeat(event: any) {
    if (event.target.className.split(" ")[event.target.className.split(" ").length - 1] == 'bg-yellow-500') {
        dynamicTicket.value = dynamicTicket.value + 1;
        const result = seat.value.filter((s: any) => s != event.target.textContent);
        seat.value = result;
        setTimeout(() => {
            event.target.classList.remove('font-bold');
            event.target.classList.remove('bg-yellow-500');
        }, 200)

    } else {
        if (dynamicTicket.value == 0) return;
        dynamicTicket.value = dynamicTicket.value - 1;
        seat.value.push(event.target.textContent);
        setTimeout(() => {
            event.target.classList.add('font-bold');
            event.target.classList.add('bg-yellow-500');
        }, 200)
    }
}
async function handleBuyTicket() {
    const res = await fetch("http://localhost:8000/api/ticket", {
        method: "POST",
        body: JSON.stringify({
            seat: JSON.stringify(seat.value),
            date: date.value,
            time: time.value,
            provider: provider.value,
            theater: theater.value,
            user_id: cookieUser.value.id,
            total_ticket: price.value / cinemas.value.price,
            price: price.value,
            detail_movie: JSON.stringify(detailMovie.value),
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await res.json();
    if (result.error) return errorBuy.value = result.error;
    cookieUser.value.ticket.push(detailMovie.value.id)
    let d = new Date();
    d.setTime(d.getTime() + 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = "User=" + JSON.stringify({ id: result.data.id, name: result.data.name, ticket: cookieUser.value.ticket }) + ";" + expires + ";path=/";
    flashSuccess.setFlashSuccess(result.message);
    setTimeout(() => {
        flashSuccess.setFlashSuccess('');
        window.location.href = `/`;
    }, 3000)
}
</script>
<template>
    <div class="flex gap-12 bg-custom-linear justify-center p-5 pb-[10rem]">
        <main class="w-[13rem]">
            <h1 class="text-2xl font-bold text-center">{{ detailMovie.title }}</h1>
            <img class="w-full rounded-lg mt-2" :src="`https://image.tmdb.org/t/p/original/${detailMovie.poster_path}`"
                alt="">
            <span class="flex justify-between">
                <span class="flex gap-2 items-center">
                    <i class="bi bi-clock text-white"></i>
                    <p class="text-white text-sm">{{ detailMovie.runtime }} min</p>
                </span>
                <span class="relative">
                    <i class="bi bi-star-fill text-2xl text-yellow-500 "></i>
                    <p
                        class="text-white absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 font-bold text-[12px]">
                        {{ detailMovie.vote_average }}</p>
                </span>

            </span>
        </main>
        <main>
            <form class="flex flex-col gap-4" @submit.prevent="handleBuyTicket()">

                <div>
                    <p class="text-white">Choose the cinema :</p>
                    <div class="flex gap-3 cursor-pointer">
                        <div @click="changeId" id=1
                            class="bg-yellow-500 text-white font-bold hover:opacity-80 py-1 px-4 rounded">
                            XXI
                        </div>
                        <div @click="changeId" id=2
                            class="bg-red-600 text-white font-bold hover:opacity-80 py-1 px-4 rounded">
                            CGV
                        </div>
                        <div @click="changeId" id=3
                            class="bg-blue-700 text-white font-bold hover:opacity-80 py-1 px-4 rounded">
                            Cinépolis
                        </div>
                    </div>
                </div>

                <div v-if="cinemas != null" class="flex flex-col">
                    <span class="flex gap-10">
                        <div>
                            <p class="text-white">Choose the time :</p>
                            <div class="text-white flex gap-2" v-for="(cinema, index) in cinemas.time" :key="index" >
                                <input v-model="time" type="radio" :value="cinema" :id="index.toString()">
                                <label :for="index.toString()">{{ cinema }}</label>
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <span>
                                <p class="text-white">Set the date :</p>
                                <div>
                                    <input class="rounded-md bg-yellow-500" v-model="date" type="date" name="" id="">
                                </div>
                            </span>
                            <select class="rounded-md" v-model="theater" id="theater">
                                <option disabled value="" selected>Select theater</option>
                                <option v-for="(theater, index) in cinemas.theater" :key="index" :value="theater">{{
                                    theater
                                    }}
                                </option>
                            </select>
                        </div>
                    </span>
                    <div class="mt-5 ">
                        <p class="text-white mb-1">Select your seat :</p>
                        <span class="grid gap-3 grid-cols-8 p-3 bg-[rgb(59,18,18)] text-white mb-4 rounded-md">
                            <p @click="setSeat"
                                :class="'w-6 h-6  text-center rounded-md hover:bg-yellow-400 cursor-pointer'"
                                v-for="(seats, index) in cinemas.total_seat" :key="index">{{ seats }}</p>
                        </span>
                    </div>
                    <div class="flex gap-10 text-white">
                        <p>Total Ticket</p>
                        <span class="flex cursor-pointer gap-2">
                            <p @click="if (totalTicket != 1) { totalTicket--; dynamicTicket--; price = cinemas.price * totalTicket }"
                                v-if="dynamicTicket > 0">- </p>
                            <p>{{ totalTicket }}</p>
                            <p @click="totalTicket++; dynamicTicket++; price = cinemas.price * totalTicket">+</p>
                        </span>
                    </div>
                    <div class="text-yellow-500 font-bold flex gap-3 text-xl">
                        <span>Price</span>
                        :
                        <span>${{ Math.round(price * 100) / 100 }}</span>
                    </div>
                </div>
                <button class=" text-black bg-yellow-500 rounded-md py-1 text-xl font-bold opacity-65 hover:opacity-100" type="submit">Buy</button>
                <p v-if="errorBuy" class="text-red-700 font-bold text-md">*{{ errorBuy }}</p>
            </form>
        </main>
    </div>
</template>
