import certificationApi from "../api/certification";

export default {
    state: {
        certifications: [],
        dataVehicle: [],
    },

    getters: {
        getDataCertification: (state) => {
            return state.dataVehicle;
        },
    },

    mutations: {
        SET_CERTIFICATIONS(state, certifications) {
            state.certifications = certifications;
        },
        SET_CERTIFICATIONSDATA(state, certifications) {
            state.certifications = certifications;
        },
    },

    actions: {
        async getCertification({ commit }) {
            await axios.get("/getCertificationlist").then((response) => {
                commit("SET_CERTIFICATIONS", response.data);
            });
        },

        getDataCertification({ commit }, data) {
            return new Promise((resolve, reject) => {
                certificationApi
                    .dataCertification(data)
                    .then((res) => {
                        commit("SET_CERTIFICATIONSDATA", res.data);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        newCertification({ commit }, data) {
            return new Promise((resolve, reject) => {
                certificationApi
                    .newCertification(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateCertification({ commit }, data) {
            return new Promise((resolve, reject) => {
                certificationApi
                    .updateCertification(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteCertification({ commit }, data) {
            return new Promise((resolve, reject) => {
                certificationApi
                    .deleteCertification(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        activateCertification({ commit }, data) {
            return new Promise((resolve, reject) => {
                certificationApi
                    .activateCertification(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    },
};
