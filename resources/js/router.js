import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store.js";

import ListClients from "./components/clients/ListClientsComponent.vue";
import ListCompanys from "./components/company/ListCompanysComponent.vue";
import ListEquipment from "./components/equipment/ListEquipmentsComponent.vue";
import ListCategories from "./components/category/ListCategoriesComponent.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    // mode: 'history',
    routes: [
        {
            path: "/listcompanys",
            name: "List Companies",
            component: ListCompanys,
        },
        {
            path: "/listclients",
            name: "List Clients",
            component: ListClients,
        },
        {
            path: "/listequipments",
            name: "List Equipments",
            component: ListEquipment,
        },
        {
            path: "/listcategories",
            name: "List Categories",
            component: ListCategories,
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
