import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store.js";

import ListClients from "./components/clients/ListClientsComponent.vue";
import ListCompanys from "./components/company/ListCompanysComponent.vue";
import ListEquipment from "./components/equipment/ListEquipmentsComponent.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    // mode: 'history',
    routes: [
        {
            path: "/listcompanys",
            name: "Listar Companies",
            component: ListCompanys,
        },
        {
            path: "/listclients",
            name: "Listar Clients",
            component: ListClients,
        },
        {
            path: "/listequipments",
            name: "Listar Equipments",
            component: ListEquipment,
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
