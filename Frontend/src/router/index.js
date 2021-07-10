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
    path: '/',
    name: 'Dash',
    component: Dashboard,
    props: {
      content: 'Table'
    }
  },
  {
    path: '/calendar',
    name: 'calendar',
    component: Calendar,

  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
