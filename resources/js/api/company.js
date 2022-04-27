export default {
    register(data) {
        return axios.post("/newCompany", data);
    },

    update(data) {
        return axios.post("/updateCompany", data);
    },

    delete(data) {
        return axios.post("/deleteCompany", data);
    },
};
