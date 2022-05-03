export default {
    register(data) {
        return axios.post("/newBranch", data);
    },

    update(data) {
        return axios.post("/updateBranch", data);
    },

    delete(data) {
        return axios.post("/deleteBranch", data);
    },
};
