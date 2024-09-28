<script setup lang="ts">
import LoginRegisterModal from './components/LoginRegisterModal.vue';
import { useModalStore } from './utils/pinia/modalStore';
const modal = useModalStore();
function closeModal(){
  modal.close();
  enableScroll();
}
function openModal(){
  modal.open();
  disableScroll();
}
function disableScroll() {
  document.body.style.overflow = 'hidden';
}
function enableScroll() {
  document.body.style.overflow = 'auto';
};
</script>

<template>
  <div class="relative">
    <button @click="openModal()" class="p-2 bg-green-500 absolute top-5 z-10">Login</button>
    <button @click="closeModal()" class="p-2 left-12 bg-green-500 absolute top-5 z-10">Close</button>
    <LoginRegisterModal v-if="modal.status" />
    <div @click="closeModal()" v-if="modal.status" class="bg-black w-screen h-screen z-30 fixed opacity-70 top-0"></div>
    <RouterView />
  </div>
</template>
