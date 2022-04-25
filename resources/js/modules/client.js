import clientApi from "../api/client.js";

export default {
    state: {
        clients: [],
    } /* END OF STATE */,

    getters: {} /* END OF GETTERS */,

    mutations: {
        SET_CLIENTSDATA(state, clients) {
            state.clients = clients;
        },
    } /* END OF MUTATIONS */,

    actions: {
        async getClients({ commit }) {
            await axios.get("/getClientlist").then((response) => {
                commit("SET_CLIENTSDATA", response.data);
            });
        },

        register({ commit }, data) {
            return new Promise((resolve, reject) => {
                clientApi
                    .register(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        update({ commit }, data) {
            return new Promise((resolve, reject) => {
                clientApi
                    .update(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        delete({ commit }, data) {
            return new Promise((resolve, reject) => {
                clientApi
                    .delete(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    } /* END OF ACTIONS */,
};
