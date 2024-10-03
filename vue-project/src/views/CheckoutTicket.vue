<script setup lang="ts">
import { ref } from 'vue'
const props = defineProps({
    id: { type: String, required: true }
});
const detailMovie = ref<any>({});
const [name, cinemas] = [ref(''), ref<any>({})];
const totalTicket = ref<number>(1);

async function fetchMovie(id: string) {
    const res = await fetch(`https://api.themoviedb.org/3/movie/${id}`, {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNzg4MzgwNS43NTE3Miwic3ViIjoiNjZkYmYxMTgzMzQyMTE0ZjIxZWM0ZGYwIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.2aQDYl_kWGoWGRiPMcBloudjIsR9bxZnpRDZaxVsRnQ'
        }
    });
    const result = await res.json();
    detailMovie.value = result;
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
}
function setSeat(event: any) {
    if(totalTicket.value == 0) return;
    totalTicket.value = totalTicket.value - 1;
    setTimeout(() => {
        event.target.classList.toggle('bg-yellow-500');
        event.target.classList.toggle('font-bold');

    }, 200)

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
            <form>
                <div><label for="name">Name</label><input v-model="name" />
                </div>
                <div>
                    <span>
                        <label for="cinema">Cinema</label>
                        <select @change="changeId" id="cinema">
                            <option value=1>XXI</option>
                            <option value=2>CGV</option>
                            <option value=3>Cinepolis</option>
                        </select>
                    </span>
                    <span>
                        <input type="date" name="" id="">
                    </span>
                </div>
                <div class="flex">
                    <div>
                        <div v-for="(cinema, index) in cinemas.time" :key="index">
                            <input type="radio" :value="cinema" id="time">
                            <label for="time">{{ cinema }}</label>
                        </div>
                        <select id="theater">
                            <option v-for="(theater, index) in cinemas.theater" :key="index" :value="theater">{{ theater
                                }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <span class="grid gap-3 grid-cols-8 p-3">
                            <p @click="setSeat"
                                :class="totalTicket == 0 ? 'cursor-not-allowed w-6 h-6 text-center rounded-md' : 'w-6 h-6 text-center rounded-md hover:bg-yellow-400 cursor-pointer'"
                                v-for="(seat, index) in cinemas.total_seat" :key="index">{{ seat }}</p>
                        </span>
                    </div>
                </div>
                <div class="flex gap-10">
                    <p>Total Ticket</p>
                    <span class="flex">
                        <p>-</p>
                        <p>{{ totalTicket }}</p>
                        <p>+</p>
                    </span>
                </div>
                <div>
                    Price : ${{ cinemas.price }}
                </div>
                <input type="submit" value="Buy">
            </form>
        </main>
    </div>
</template>
