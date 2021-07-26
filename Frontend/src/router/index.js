import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from "@/components/Dashboard";
import Login from "@/components/Login";

Vue.use(VueRouter)

const routes = [

    {
        path: '/login',
        name: 'login',
        component: Login,
    },

    {
        path: '/',
        name: 'Dash',
        component: Dashboard,
        props: {
            content: 'Home'
        }
    },
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
        path: '/Others',
        name: 'Dash',
        component: Dashboard,
        props: {
            content: 'Others'
        }
    },

]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
