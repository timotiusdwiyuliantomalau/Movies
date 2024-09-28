<script setup lang="ts">
import { ref } from 'vue';
const modal = ref("signup");

</script>
<template>
    <div class="z-50 absolute  -translate-x-1/2 left-1/2 top-12">
        <main v-if="modal=='signup'" class="bg-gray-900 p-8 rounded-lg shadow-lg w-80">
            <div class="flex mb-6">
                <button class="w-1/2 py-2 bg-teal-500 text-white font-bold rounded-l-lg">Sign Up</button>
                <button @click="modal='login'" class="w-1/2 py-2 bg-gray-700 text-gray-400 font-bold rounded-r-lg">Sign In</button>
            </div>
            <h2 class="text-center text-white text-lg font-bold mb-6">Sign Up for Free</h2>
            <form>
                <div class="flex mb-4">
                    <input type="text" placeholder="First Name*"
                        class="w-1/2 p-2 mr-2 bg-gray-800 text-white border border-gray-600 rounded">
                    <input type="text" placeholder="Last Name*"
                        class="w-1/2 p-2 ml-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input type="text" placeholder="Nomor KTP*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input type="email" placeholder="Email Address*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="Set A Password*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-6">
                    <input type="password" placeholder="Confirm Password*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <button type="submit" class="w-full py-2 bg-teal-500 text-white font-bold rounded">GET STARTED</button>
            </form>
        </main>

        <main v-if="modal=='login'" class="bg-gray-900 p-8 rounded-lg shadow-lg w-80">
            <div class="flex mb-6">
                <button @click="modal='signup'" class="w-1/2 py-2  text-gray-400 font-bold rounded-l-lg bg-gray-700">Sign Up</button>
                <button class="w-1/2 py-2  bg-teal-500 text-white font-bold rounded-r-lg">Sign In</button>
            </div>
            <h2 class="text-center text-white text-lg font-bold mb-6">Sign In to Your Account</h2>
            <form>
                <div class="mb-4">
                    <input type="text" placeholder="Nomor KTP*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input type="email" placeholder="Email Address*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="Password*"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded">
                </div>
                <button type="submit" class="w-full py-2 bg-teal-500 text-white font-bold rounded">LOGIN</button>
            </form>
        </main>
    </div>
</template>