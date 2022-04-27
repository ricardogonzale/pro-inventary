import companyApi from "../api/company.js";

export default {
    state: {
        companys: [],
    } /* END OF STATE */,

    getters: {} /* END OF GETTERS */,

    mutations: {
        SET_COMPANYSDATA(state, companys) {
            state.companys = companys;
        },
    } /* END OF MUTATIONS */,

    actions: {
        async getCompanys({ commit }) {
            await axios.get("/getCompanylist").then((response) => {
                commit("SET_COMPANYSDATA", response.data);
            });
        },

        registerCompany({ commit }, data) {
            return new Promise((resolve, reject) => {
                companyApi
                    .register(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateCompany({ commit }, data) {
            return new Promise((resolve, reject) => {
                companyApi
                    .update(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteCompany({ commit }, data) {
            return new Promise((resolve, reject) => {
                companyApi
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
