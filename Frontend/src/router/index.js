import Vue from 'vue'
import VueRouter from 'vue-router'
import Users from "@/views/Users";
import Dashboard from "@/components/Dashboard";
import Calendar from "@/components/Calendar"
Vue.use(VueRouter)

const routes = [
  {
    path: '/test',
    name: 'Users',
    component: Users
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
    name: 'calendar',
    component: Calendar,

  }
  ,
  {
    path: '/users',
    name: 'Dash',
    component: Dashboard,
    props: {
      content: 'Users'
    }
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
