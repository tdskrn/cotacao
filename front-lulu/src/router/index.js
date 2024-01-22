import { userIsAdmin } from '../utils/auth'
import { createRouter, createWebHashHistory } from 'vue-router'
import WelcomeView from '../views/WelcomeView.vue'
import Login from '../components/Auth/Login/Login.vue'
import Register from '../components/Auth/Register/Register.vue'
import VendorsView from '../views/VendorsView.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: WelcomeView
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/vendors',
        name: 'vendor',
        component: VendorsView
    },

    {
        path: '/products',
        name: 'products',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: function () {
            return import(
                /* webpackChunkName: "about" */ '../views/ProductsView.vue'
            )
        },
        beforeEnter: (to, from, next) => {
            if (userIsAdmin()) {
                next()
            } else {
                next('/')
            }
        }
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router
