export default {
    register(data) {
        return axios.post("/newClient", data);
    },

    update(data) {
        return axios.post("/updateClient", data);
    },

    delete(data) {
        return axios.post("/deleteClient", data);
    },
};
