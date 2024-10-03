<script lang="ts">
import { defineComponent } from 'vue';
import { useModalStore } from '../utils/pinia/modalStore';
import { ref } from 'vue';
export default defineComponent({
    name: 'LoginRegisterModal',
    setup() {
        const modal = ref("signup");
        const [name, email, password, password_confirmation, resident_number] = [ref(''), ref(''), ref(''), ref(''), ref(''), ref('')];
        const isModal = useModalStore();
        fetch('http://localhost:8000/sanctum/csrf-cookie');
        async function handleRegister() {
            const response = await fetch("http://localhost:8000/api/register", {
                method: "POST",
                body: JSON.stringify({
                    name: name.value,
                    email: email.value,
                    password: password.value,
                    password_confirmation: password_confirmation.value,
                    resident_number: resident_number.value,
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const result = await response.json();
            console.log(result);
        }

        async function handleLogin() {
            fetch("http://localhost:8000/sanctum/csrf-cookie")
            const response = await fetch("http://localhost:8000/api/login", {
                method: "POST",
                body: JSON.stringify({
                    email: email.value,
                    password: password.value,
                    resident_number: resident_number.value,
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const result = await response.json();
            console.log(result);
        }

        return { modal, name, email, password, password_confirmation, resident_number, isModal, handleRegister, handleLogin };
    },
})

</script>
<template>
    <div :class="'z-50 absolute  -translate-x-1/2 left-1/2 ' + isModal.position">
        <main v-if="modal == 'signup'" class="bg-gray-900 p-8 rounded-lg shadow-lg w-80">
            <div class="flex mb-6">
                <button class="w-1/2 py-2 bg-teal-500 text-white font-bold rounded-l-lg">Sign Up</button>
                <button @click="modal = 'login'"
                    class="w-1/2 py-2 bg-gray-700 text-gray-400 font-bold rounded-r-lg">Sign
                    In</button>
            </div>
            <h2 class="text-center text-white text-lg font-bold mb-6">Sign Up for Free</h2>
            <form @submit.prevent="handleRegister()">
                <div class="mb-4">
                    <input v-model="name" type="text" placeholder="Name*"
                        class="w-full p-2 mr-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input type="text" v-model="resident_number" placeholder="Resident Number*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input type="email" v-model="email" placeholder="Email Address*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input type="password" v-model="password" placeholder="Set A Password*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-6">
                    <input type="password" v-model="password_confirmation" placeholder="Confirm Password*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <button type="submit" class="w-full py-2 bg-teal-500 text-white font-bold rounded">GET STARTED</button>
            </form>
        </main>

        <main v-if="modal == 'login'" class="bg-gray-900 p-8 rounded-lg shadow-lg w-80">
            <div class="flex mb-6">
                <button @click="modal = 'signup'"
                    class="w-1/2 py-2  text-gray-400 font-bold rounded-l-lg bg-gray-700">Sign Up</button>
                <button class="w-1/2 py-2  bg-teal-500 text-white font-bold rounded-r-lg">Sign In</button>
            </div>
            <h2 class="text-center text-white text-lg font-bold mb-6">Sign In to Your Account</h2>
            <form @submit.prevent="handleLogin()">
                <div class="mb-4">
                    <input v-model="resident_number" required type="text" placeholder="Resident Number*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input v-model="email" required type="email" placeholder="Email Address*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input v-model="password" required type="password" placeholder="Password*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <button type="submit" class="w-full py-2 bg-teal-500 text-white font-bold rounded">LOGIN</button>
            </form>
        </main>
    </div>
</template>