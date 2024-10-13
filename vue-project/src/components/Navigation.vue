<script lang="ts">
import { useCookieUser, useModalStore } from '../utils/pinia/modalStore';
import { defineComponent, ref } from 'vue';
export default defineComponent({
    name: "Navigation",
    setup() {
        const modal = useModalStore();
        const cookieUser = useCookieUser();
        const urlPage = window.location.pathname;
        const url = ref(urlPage);
        return { modal, cookieUser, url }
    }
})

</script>
<template>
    <main
        class="fixed  scale-125 bottom-5 left-1/2 -translate-x-1/2 bg-red-700 px-2 py-1 flex gap-4 rounded-l-full rounded-r-full opacity-40 hover:opacity-100">
        <router-link to="/">
            <i @click="url = '/'"
                :class="`cursor-pointer bi bi-house-door-fill ${url == '/' ? 'text-white' : ''} opacity-100`"></i>
        </router-link>
        <router-link v-if="cookieUser.value.id" :to="{name:'my profile'}">
            <i @click="url = '/account'"
                :class="`cursor-pointer bi bi-person-fill ${url == '/account' ? 'text-white' : ''} opacity-100`"></i>
        </router-link>
        <span v-else>
            <i @click="modal.open('top-12')" :class="`cursor-pointer bi bi-person-fill`"></i>
        </span>
        <router-link v-if="cookieUser.value.id" to="/my-ticket">
            <i @click="url = '/my-ticket'"
                :class="`cursor-pointer bi bi-ticket-perforated-fill ${url == '/my-ticket' ? 'text-white' : ''} opacity-100`"></i>
        </router-link>
        <span v-else>
            <i @click="modal.open('top-[5rem]')" :class="`cursor-pointer bi bi-ticket-perforated-fill`"></i>
        </span>
    </main>
</template>