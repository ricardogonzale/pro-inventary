import vehicleApi from "../api/vehicle.js";

export default {
    state: {
        vehicles: [],
        dataVehicle: [],
    },

    getters: {
        getDataVehicle: (state) => {
            return state.dataVehicle;
        },
    },

    mutations: {
        SET_VEHICLES(state, vehicles) {
            state.vehicles = vehicles;
        },
        SET_VEHICLESDATA(state, vehicles) {
            state.vehicles = vehicles;
        },
    },

    actions: {
        async getVehicle({ commit }) {
            await axios.get("/getVehiclelist").then((response) => {
                commit("SET_VEHICLES", response.data);
            });
        },

        getDataVehicle({ commit }, data) {
            return new Promise((resolve, reject) => {
                vehicleApi
                    .dataVehicle(data)
                    .then((res) => {
                        commit("SET_VEHICLESDATA", res.data);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        newVehicle({ commit }, data) {
            return new Promise((resolve, reject) => {
                vehicleApi
                    .newVehicle(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateVehicle({ commit }, data) {
            return new Promise((resolve, reject) => {
                vehicleApi
                    .updateVehicle(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteVehicle({ commit }, data) {
            return new Promise((resolve, reject) => {
                vehicleApi
                    .deleteVehicle(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        activateVehicle({ commit }, data) {
            return new Promise((resolve, reject) => {
                vehicleApi
                    .activateVehicle(data)
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
