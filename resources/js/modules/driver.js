import driverApi from "../api/driver.js";

export default {
    state: {
        drivers: [],
        dataDriver: [],
    },

    getters: {
        getDataDriver: (state) => {
            return state.dataDriver;
        },
    },

    mutations: {
        SET_DRIVERS(state, drivers) {
            state.drivers = drivers;
        },
        SET_DRIVERSDATA(state, drivers) {
            state.drivers = drivers;
        },
    },

    actions: {
        async getDriver({ commit }) {
            await axios.get("/getDriverlist").then((response) => {
                commit("SET_DRIVERS", response.data);
            });
        },

        getDataDriver({ commit }, data) {
            return new Promise((resolve, reject) => {
                driverApi
                    .dataDriver(data)
                    .then((res) => {
                        commit("SET_DRIVERSDATA", res.data);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        newDriver({ commit }, data) {
            return new Promise((resolve, reject) => {
                driverApi
                    .newDriver(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateDriver({ commit }, data) {
            return new Promise((resolve, reject) => {
                driverApi
                    .updateDriver(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteDriver({ commit }, data) {
            return new Promise((resolve, reject) => {
                driverApi
                    .deleteDriver(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        activateDriver({ commit }, data) {
            return new Promise((resolve, reject) => {
                driverApi
                    .activateDriver(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    },
};
