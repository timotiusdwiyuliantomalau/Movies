<script lang="ts">
import { useFlashMessageSuccess } from "@/utils/pinia/flashMessageSuccess";
import { useCookieUser } from "../utils/pinia/modalStore";
import { defineComponent } from "vue";
export default defineComponent({
    name:"MyProfile",
    setup(){
        const cookieUser=useCookieUser();
        const flashSuccess=useFlashMessageSuccess()
        return {cookieUser,flashSuccess};
    },
    methods:{
        logout(){
            this.$cookies.remove('User');
            this.flashSuccess.setFlashSuccess("Your account has been signed out!");
            setTimeout(()=>{window.location.pathname="/";},3000)
        }
    }
})
</script>
<template>
    <div class="relative h-screen bg-[#1F1515]">
    <main class="max-w-sm mx-auto bg-white rounded-lg shadow-md p-4 scale-125 absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2">
        <div class="flex items-center space-x-3">
            <i class="bi bi-person-circle text-4xl text-slate-600"></i>
            <div>
                <h2 class="text-lg font-semibold">
                    {{ cookieUser.value.name }}
                </h2>
                <p class="text-sm text-slate-700 flex items-center">
                    {{ cookieUser.value.resident_number }}
                </p>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center justify-between p-2 bg-gray-100 rounded-lg">
                <div class="flex items-center space-x-3">
                    <i class="bi bi-envelope-fill "></i>
                    <span class="text-xs font-medium">
                        {{ cookieUser.value.email }}
                    </span>
                </div>
                <a class="text-blue-500 font-semibold text-xs" href="#">
                    Change
                </a>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-between p-2 hover:bg-gray-100 rounded-lg cursor-pointer">
                    <div class="flex items-center space-x-2">
                        <i class="bi bi-person-fill-gear">
                        </i>
                        <span>
                            Account setting
                        </span>
                    </div>
                    <i class="fas fa-chevron-right">
                    </i>
                </div>
                <div class="flex items-center justify-between p-2 hover:bg-gray-100 rounded-lg cursor-pointer">
                    <div class="flex items-center space-x-2">
                        <i class="bi bi-substack">
                        </i>
                        <span>
                            Member setting
                        </span>
                    </div>
                    <i class="fas fa-chevron-right">
                    </i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center p-2 bg-purple-300 rounded-lg cursor-pointer">
                    <i class="bi bi-person-check-fill text-purple-700 text-2xl">
                    </i>
                    <div class="ml-2">
                        <span class="font-semibold">
                            Join Member
                        </span>
                        <p class="text-xs text-slate-600 hover:underline">
                            Click here to know member's advantage
                        </p>
                    </div>
                    <button class=" bg-purple-800 hover:bg-purple-950 text-white rounded-md px-3 ml-4">Join</button>
                </div>
            </div>
            <div class="mt-4">
                <div @click="logout()" class="flex items-center p-2 hover:bg-gray-100 rounded-lg cursor-pointer ">
                    <i class="bi bi-box-arrow-left">
                    </i>
                    <span class="ml-2">
                        Sign out
                    </span>
                </div>
            </div>
        </div>
    </main>
</div>
</template>