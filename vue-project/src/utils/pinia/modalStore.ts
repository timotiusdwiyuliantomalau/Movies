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
  let cookieUser:any = decodeURIComponent(document.cookie).split('=');
  cookieUser=cookieUser.map((c: any, i: number) => {
    if (c == 'User') return JSON.parse(cookieUser[i + 1])
})
if(cookieUser[0]==undefined)cookieUser[0]={};
  export const useCookieUser = defineStore('cookieUser', {
    state: () => ({ value:cookieUser[0] }),
  })

  