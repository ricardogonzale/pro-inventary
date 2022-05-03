import BranchApi from "../api/branch";

export default {
    state: {
        branchs: [],
    } /* END OF STATE */,

    getters: {} /* END OF GETTERS */,

    mutations: {
        SET_BRANCHSDATA(state, branchs) {
            state.branchs = branchs;
        },
    } /* END OF MUTATIONS */,

    actions: {
        async getBranchs({ commit }) {
            await axios.get("/getDivisionlist").then((response) => {
                commit("SET_BRANCHSDATA", response.data);
            });
        },

        registerBranch({ commit }, data) {
            return new Promise((resolve, reject) => {
                BranchApi.register(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateBranch({ commit }, data) {
            return new Promise((resolve, reject) => {
                BranchApi.update(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteBranch({ commit }, data) {
            return new Promise((resolve, reject) => {
                BranchApi.delete(data)
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
