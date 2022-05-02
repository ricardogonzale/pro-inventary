import CategoryApi from "../api/category";

export default {
    state: {
        categories: [],
    } /* END OF STATE */,

    getters: {} /* END OF GETTERS */,

    mutations: {
        SET_CATEGORIESDATA(state, categories) {
            state.categories = categories;
        },
    } /* END OF MUTATIONS */,

    actions: {
        async getCategories({ commit }) {
            await axios.get("/getCategorylist").then((response) => {
                commit("SET_CATEGORIESDATA", response.data);
            });
        },

        registerCategory({ commit }, data) {
            return new Promise((resolve, reject) => {
                CategoryApi.register(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateCategory({ commit }, data) {
            return new Promise((resolve, reject) => {
                CategoryApi.update(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteCategory({ commit }, data) {
            return new Promise((resolve, reject) => {
                CategoryApi.delete(data)
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
