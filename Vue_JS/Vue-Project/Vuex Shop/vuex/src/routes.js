import VueRouter from "vue-router";
import cartVue from './view/cartView.vue'
import homeView from '@/view/homeView.vue'
import loginPage from '@/view/loginPage.vue'
import pageDefault404 from '@/view/pageDefault404'

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
        meta: { auth: true }
    },
    {
        name: 'loginPage',
        path: '/login',
        component: loginPage,
        meta: { guest: true }
    },
    {
        name: 'page404',
        path: '*',
        component: pageDefault404
    }
]

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {
    // alert(this.$store.state.isLogin)
    const isLoggedIn =false// (store.state.isLogin);
    if (to.matched.some(record => record.meta.auth)) {
        if (!isLoggedIn) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (isLoggedIn) {
            next({
                path: '/',
            })
        } else {
            next()
        }
    } else {
        next()
    }
})
export default router;