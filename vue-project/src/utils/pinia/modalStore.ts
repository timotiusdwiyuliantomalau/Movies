import { defineStore } from 'pinia'
export const useModalStore = defineStore('modal', {
    state: () => ({ count: 0, status: false }),
    getters: {
      isModal: (state) => state.status,
    },
    actions: {
      open() {
        this.status = true
      },close() {
        this.status = false
      }
    },
  })