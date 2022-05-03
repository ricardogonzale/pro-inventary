import DivisionApi from "../api/division";

export default {
    state: {
        divisions: [],
    } /* END OF STATE */,

    getters: {} /* END OF GETTERS */,

    mutations: {
        SET_DIVISIONSDATA(state, divisions) {
            state.divisions = divisions;
        },
    } /* END OF MUTATIONS */,

    actions: {
        async getDivisions({ commit }) {
            await axios.get("/getDivisionlist").then((response) => {
                commit("SET_DIVISIONSDATA", response.data);
            });
        },

        registerDivision({ commit }, data) {
            return new Promise((resolve, reject) => {
                DivisionApi.register(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateDivision({ commit }, data) {
            return new Promise((resolve, reject) => {
                DivisionApi.update(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteDivision({ commit }, data) {
            return new Promise((resolve, reject) => {
                DivisionApi.delete(data)
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
