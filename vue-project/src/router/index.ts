import { createRouter, createWebHistory } from 'vue-router';
import Homepage from '@/views/Homepage.vue';
import DetailMovie from '@/views/DetailMovie.vue';
import NotFound from '@/views/NotFound.vue';
import CheckoutTicket from '@/views/CheckoutTicket.vue';
import MyTIcket from '@/views/MyTicket.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Homepage
    },
    {
      path: '/detail/:id',
      name: 'detail',
      component: DetailMovie,
      props: true,
    },
    {
      path:'/checkout/:id',
      name:'checkout ticket',
      component:CheckoutTicket,
      props:true,
    },
    {
      path:"/my-ticket",
      name:"my ticket",
      props:true,
      component:MyTIcket,
    },
    {
      path:'/:catchAll(.*)',
      name: 'not found',
      component:NotFound,
    },
  ]
})

export default router
