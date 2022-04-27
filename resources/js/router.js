import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store.js";

import ListClients from "./components/clients/ListClientsComponent.vue";
import ListCompanys from "./components/company/ListCompanysComponent.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    // mode: 'history',
    routes: [
        {
            path: "/listcompanys",
            name: "Listar Compañias",
            component: ListCompanys,
        },
        {
            path: "/listclients",
            name: "Listar Clientes",
            component: ListClients,
        },
    ],
});

router.beforeEach((to, from, next) => {
    store.commit("setloadpage", { loadpage: true });
    next();
});
router.afterEach(() => {
    setTimeout(() => {
        store.commit("setloadpage", { loadpage: false });
    }, 500);
});

export default router;
