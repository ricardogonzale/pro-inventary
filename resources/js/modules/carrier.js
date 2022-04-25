import carrierApi from "../api/carrier.js";

export default {
    state: {
        carriers: [],
        dataCarrier: [],
    } /* END OF STATE */,

    getters: {
        getDataCarrier: (state) => {
            return state.dataCarrier;
        },
    } /* END OF GETTERS */,

    mutations: {
        SET_CARRIERS(state, carriers) {
            state.carriers = carriers;
        },
        SET_CARRIERSDATA(state, carriers) {
            state.carriers = carriers;
        },
    } /* END OF MUTATIONS */,

    actions: {
        async getCarrier({ commit }) {
            await axios.get("/getCarrierlist").then((response) => {
                commit("SET_CARRIERS", response.data);
            });
        },

        getDataCarrier({ commit }, data) {
            return new Promise((resolve, reject) => {
                carrierApi
                    .dataCarrier(data)
                    .then((res) => {
                        commit("SET_CARRIERSDATA", res.data);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        registerCarrier({ commit }, data) {
            return new Promise((resolve, reject) => {
                carrierApi
                    .registerCarrier(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateCarrier({ commit }, data) {
            return new Promise((resolve, reject) => {
                carrierApi
                    .updateCarrier(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteCarrier({ commit }, data) {
            return new Promise((resolve, reject) => {
                carrierApi
                    .deleteCarrier(data)
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
