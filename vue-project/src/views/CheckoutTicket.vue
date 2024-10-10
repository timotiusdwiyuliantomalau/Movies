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
    const res = await fetch(`http://localhost:8000/api/cinema/${event.target.value}`);
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
    document.cookie = "User=" + JSON.stringify({ id: result.data.id, name: result.data.name, ticket:cookieUser.value.ticket  }) + ";" + expires + ";path=/";
    flashSuccess.setFlashSuccess(result.message);
    setTimeout(() => {
        flashSuccess.setFlashSuccess('');
        window.location.href=`/`;
    }, 3000)
}
</script>
<template>
    <div class="flex gap-12">
        <main class="w-72">
            <h1>{{ detailMovie.title }}</h1>
            <img class="w-full" :src="`https://image.tmdb.org/t/p/original/${detailMovie.poster_path}`" alt="">
            <span class="flex justify-between">
                <p>{{ detailMovie.runtime }} min</p>
                <p>{{ detailMovie.vote_average }}</p>
            </span>
        </main>
        <main>
            <form @submit.prevent="handleBuyTicket()">
                <div>
                    <span>
                        <label for="cinema">Cinema</label>
                        <select @change="changeId" id="cinema">
                            <option value="">Select Cinema</option>
                            <option value=1>XXI</option>
                            <option value=2>CGV</option>
                            <option value=3>Cinepolis</option>
                        </select>
                    </span>
                    <span>
                        <input v-model="date" type="date" name="" id="">
                    </span>
                </div>
                <div v-if="cinemas != null" class="flex flex-col">
                    <div class="flex gap-5">
                        <div>
                            <div v-for="(cinema, index) in cinemas.time" :key="index" class="">
                                <input v-model="time" type="radio" :value="cinema" :id="index.toString()">
                                <label :for="index.toString()">{{ cinema }}</label>
                            </div>
                        </div>
                        <select v-model="theater" id="theater">
                            <option v-for="(theater, index) in cinemas.theater" :key="index" :value="theater">{{ theater
                                }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <span class="grid gap-3 grid-cols-8 p-3">
                            <p @click="setSeat"
                                :class="'w-6 h-6 text-center rounded-md hover:bg-yellow-400 cursor-pointer'"
                                v-for="(seats, index) in cinemas.total_seat" :key="index">{{ seats }}</p>
                        </span>
                    </div>
                    <div class="flex gap-10">
                        <p>Total Ticket</p>
                        <span class="flex">
                            <p @click="if (totalTicket != 1) { totalTicket--; dynamicTicket--; price = cinemas.price * totalTicket }"
                                v-if="dynamicTicket > 0">- </p>
                            <p>{{ totalTicket }}</p>
                            <p @click="totalTicket++; dynamicTicket++; price = cinemas.price * totalTicket">+</p>
                        </span>
                    </div>
                    <div>
                        Price : ${{ Math.round(price * 100) / 100 }}
                    </div>
                </div>

                <button type="submit">Buy</button>
                <p v-if="errorBuy" class="text-red-500 font-semibold text-md">*{{ errorBuy }}</p>
            </form>
        </main>
    </div>
</template>
