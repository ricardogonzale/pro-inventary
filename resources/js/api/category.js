export default {
    register(data) {
        return axios.post("/newCategory", data);
    },

    update(data) {
        return axios.post("/updateCategory", data);
    },

    delete(data) {
        return axios.post("/deleteCategory", data);
    },
};
