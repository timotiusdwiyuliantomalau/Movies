<script lang="ts" setup>
import LoginRegisterModal from './components/LoginRegisterModal.vue';
import { useModalStore } from './utils/pinia/modalStore';
import { useFlashMessageSuccess } from './utils/pinia/flashMessageSuccess';
import Navigation from './components/Navigation.vue';

const modal = useModalStore();
const flashSuccess = useFlashMessageSuccess();
function closeModal() {
  modal.close();
  document.body.style.overflow = "auto";
};
</script>

<template>
  <div class="relative">
    <div v-if="flashSuccess.message.length > 0"
      class="flex scale-110 items-center p-2  text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 z-50 top-5 -translate-x-1/2 left-1/2 fixed"
      role="alert">
      <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="currentColor" viewBox="0 0 20 20">
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
      </svg>
      <span class="sr-only">Info</span>
      <div>
        <span class="font-semibold">Success!</span> {{ flashSuccess.message }}
      </div>
    </div>
    <LoginRegisterModal v-if="modal.status" />
    <div @click="closeModal()" v-if="modal.status" class="bg-black opacity-60 w-screen h-screen z-30 fixed top-0"></div>
    <RouterView />
    <Navigation/>
  </div>
</template>
