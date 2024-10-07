import { defineStore } from "pinia";

export const useFlashMessageSuccess=defineStore('flashMessageSuccess',{
    state:()=>({message:""}),
    actions:{
        setFlashSuccess(message:string){
            this.message=message;
        }
    }
})