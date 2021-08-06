import {createRouter, createWebHistory} from "vue-router";
import Login from './../views/login.vue'
import Worker from "../views/Worker.vue";
import Admin from "../views/Admin.vue";
import Dashboard from "../views/Dashboard.vue";

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: Dashboard,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/admin",
        name: "admin",
        component: Admin,
    },
    {
        path: "/worker",
        name: "worker",
        component: Worker,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
