import { defineStore } from 'pinia'
export const useModalStore = defineStore('modal', {
    state: () => ({ status: false, position:"" }),
    getters: {
      isModal: (state) => state.status,
    },
    actions: {
      open(position :string) {
        this.status = true
        this.position=position; 
      },close() {
        this.status = false;
      }
    },
  })