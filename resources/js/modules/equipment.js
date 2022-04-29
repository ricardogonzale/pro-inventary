import EquipmentApi from "../api/equipment.js";

export default {
    state: {
        equipments: [],
    } /* END OF STATE */,

    getters: {} /* END OF GETTERS */,

    mutations: {
        SET_EQUIPMENTSDATA(state, equipments) {
            state.equipments = equipments;
        },
    } /* END OF MUTATIONS */,

    actions: {
        async getEquipments({ commit }) {
            await axios.get("/getEquipmentlist").then((response) => {
                commit("SET_EQUIPMENTSDATA", response.data);
            });
        },

        register({ commit }, data) {
            return new Promise((resolve, reject) => {
                EquipmentApi.register(data)
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
                EquipmentApi.update(data)
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
                EquipmentApi.delete(data)
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
