import {createRouter, createWebHistory}  from 'vue-router'
import Login from "../views/Login.vue"
import NotFound from "../views/NotFound.vue"
import Dashboard from "../views/Dashboard/index.vue"
import Techniciens from "../views/Dashboard/Techniciens.vue"
import Statistics from "../views/Dashboard/Statistics.vue"
import Orders from "../views/Dashboard/Orders.vue"

const routes = [
    {
        path: '/',
        name: 'Login',
        component: Login,
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        children:[
            {
                path:'',
                name: 'Statistics',
                component:Statistics
            },
            {
                path:'/dashboard/orders',
                name: 'Orders',
                component:Orders
            },
            {
                path:'/dashboard/techniciens',
                name: 'Techniciens',
                component:Techniciens
            }
        ]
    },
    {
        name:"NotFound",
        path:"/:pathMatch(.*)*",
        component: NotFound
    }
]
const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: 'active',
})


export default router