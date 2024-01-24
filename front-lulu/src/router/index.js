import { userIsAdmin } from '../utils/auth'
import { createRouter, createWebHashHistory } from 'vue-router'
import WelcomeView from '../views/WelcomeView.vue'
import Login from '../components/Auth/Login/Login.vue'
import Register from '../components/Auth/Register/Register.vue'
import VendorsAdminView from '../views/Admin/VendorsAdminView.vue'
import DashboardView from '../views/Admin/DashboardView.vue'
import VendorsUserView from '../views/VendorsUserView.vue'
import QuotationView from '../views/Admin/QuotationView.vue'
import WinnersView from '../views/Admin/WinnersView.vue'
import ConfigAdminView from '../views/Admin/ConfigAdminView.vue'

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
        component: VendorsUserView
    },
    {
        path: '/vendors-admin',
        name: 'vendors-admin',
        component: VendorsAdminView,
        beforeEnter: (to, from, next) => {
            if (userIsAdmin()) {
                next()
            } else {
                next('/')
            }
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardView,
        beforeEnter: (to, from, next) => {
            if (userIsAdmin()) {
                next()
            } else {
                next('/')
            }
        }
    },
    {
        path: '/quotations',
        name: 'quotations',
        component: QuotationView,
        beforeEnter: (to, from, next) => {
            if (userIsAdmin()) {
                next()
            } else {
                next('/')
            }
        }
    },
    {
        path: '/winners',
        name: 'winners',
        component: WinnersView,
        beforeEnter: (to, from, next) => {
            if (userIsAdmin()) {
                next()
            } else {
                next('/')
            }
        }
    },
    {
        path: '/config',
        name: 'config',
        component: ConfigAdminView,
        beforeEnter: (to, from, next) => {
            if (userIsAdmin()) {
                next()
            } else {
                next('/')
            }
        }
    },

    {
        path: '/products',
        name: 'products',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: function () {
            return import(
                /* webpackChunkName: "about" */ '../views/Admin/ProductsView.vue'
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
