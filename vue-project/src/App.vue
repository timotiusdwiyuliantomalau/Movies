<script setup lang="ts">
import { ref } from 'vue';
import { useModalStore } from './utils/pinia/modalStore';
const modal = useModalStore();

function disableScroll() {
  document.body.style.overflow = 'hidden';
}
</script>

<template>
  <div class="relative">
    <button @click="modal.open(); disableScroll()" class="p-2 bg-green-500 absolute top-5 z-10">Login</button>
    <button @click="modal.close()" class="p-2 left-12 bg-green-500 absolute top-5 z-10">Close</button>
    <div v-if="modal.status" class="bg-black w-screen h-screen fixed opacity-70 top-0"></div>
    <RouterView />
  </div>
</template>
