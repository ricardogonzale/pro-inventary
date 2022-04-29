export default {
    register(data) {
        return axios.post("/newEquipment", data);
    },

    update(data) {
        return axios.post("/updateEquipment", data);
    },

    delete(data) {
        return axios.post("/deleteEquipment", data);
    },
};
