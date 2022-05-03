export default {
    register(data) {
        return axios.post("/newDivision", data);
    },

    update(data) {
        return axios.post("/updateDivision", data);
    },

    delete(data) {
        return axios.post("/deleteDivision", data);
    },
};
