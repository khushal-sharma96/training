import VueRouter from "vue-router";
import AppHome from './components/AppHome.vue'
import AppRegister from './components/AppRegister.vue'
import AppAbout from '@/components/AppAbout'
import AppLogin from './components/AppLogin.vue'
import AppDisplayUsers from '@/Views/displayUsers'

const routes = [
    {
        name: 'AppHome',
        path: '/',
        component: AppHome
    },
    {
        name: 'AppRegister',
        path: '/register',
        component: AppRegister,
        meta: { guest: true }
    },
    {
        name: 'AppLogin',
        path: '/login',
        component: AppLogin,
        meta: { guest: true }
    },
    {
        name: 'AppAbout',
        path: '/about',
        component: AppAbout,
        meta: { requiresAuth: true }

    },
    {
        name: 'AppDisplayUsers',
        path: '/users',
        component: AppDisplayUsers,
        meta: { requiresAuth: true }
    }
]

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {
    const isLoggedIn = parseInt(localStorage.getItem('isLogin') ?? "0");
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.

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
        next() // make sure to always call next()!
    }
})
export default router;