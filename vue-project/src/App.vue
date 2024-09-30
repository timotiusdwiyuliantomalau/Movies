<script setup lang="ts">
import { ref } from 'vue';
import LoginRegisterModal from './components/LoginRegisterModal.vue';
import { useModalStore } from './utils/pinia/modalStore';
const modal = useModalStore();
function closeModal() {
  modal.close();
  document.body.style.overflow = "auto";
}
</script>

<template>
  <div class="relative">
    <LoginRegisterModal v-if="modal.status" />
    <div @click="closeModal()" v-if="modal.status" class="bg-black w-screen h-screen z-30 fixed opacity-70 top-0"></div>
    <RouterView />
  </div>
</template>
