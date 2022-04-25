import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
import auth from "./modules/auth.js";
import client from "./modules/client.js";

export default new Vuex.Store({
    state: {
        loadpage: false,
    } /* END OF STATE */,

    mutations: {
        setloadpage: function (state, payload) {
            Vue.set(state, "loadpage", payload.loadpage);
        },
    } /* END OF MUTATIONS */,

    getters: {
        clients: (state) => {
            return state.clients;
        },
    },
    actions: {} /* END OF ACTIONS */,
    modules: {
        auth,
        client,
    },
});