import VueRouter from "vue-router";
import cartVue from './view/cartView.vue'
import homeView from '@/view/homeView.vue'

const routes = [
    {
        name: 'AppHome',
        path: '/',
        component: homeView 
    },
{
    name: 'cartVue',
        path: '/cart',
            component: cartVue,
    }
]

const router = new VueRouter({
    routes
})

export default router;