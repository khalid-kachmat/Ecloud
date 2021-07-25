import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from "@/components/Dashboard";

Vue.use(VueRouter)

const routes = [

    {
        path: '/patients',
        name: 'Dash',
        component: Dashboard,
        props: {
            content: 'Patient'
        }
    },
    {
        path: '/calendar',
        name: 'Dash',
        component: Dashboard,
        props: {
            content: 'Calendar'
        }
    },
    {
        path: '/users',
        name: 'Dash',
        component: Dashboard,
        props: {
            content: 'Users'
        }
    },
    {
        path: '/',
        name: 'Dash',
        component: Dashboard,
        props: {
            content: 'Home'
        }
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
