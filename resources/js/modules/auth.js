import authApi from "../api/auth.js";

export default {
    state: {
        loadpage: false,
        // the auth state of the user
        loggedIn: false,
        // current logged in user
        user: {},
        userdata: [],
    } /* END OF STATE */,

    getters: {
        loggedIn(state) {
            return state.loggedIn;
        },

        user(state) {
            return state.user;
        },

        userdatatype(state) {
            return state.userdata.type;
        },
    } /* END OF GETTERS */,

    mutations: {
        setLoggedIn(state, loggedIn) {
            state.loggedIn = loggedIn;
        },

        setUser(state, user) {
            state.user = user;
        },

        setloadpage: function (state, payload) {
            Vue.set(state, "loadpage", payload.loadpage);
        },

        SET_USERDATA(state, userdata) {
            state.userdata = userdata;
        },
    } /* END OF MUTATIONS */,

    actions: {
        login({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                authApi
                    .login(credentials)
                    .then((res) => {
                        commit("setLoggedIn", true);
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        } /* END OF LOGIN */,

        logout({ commit }) {
            return new Promise((resolve, reject) => {
                authApi
                    .logout()
                    .then((res) => {
                        commit("setLoggedIn", false);
                        // set the user
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        } /* END OF LOGOUT */,

        async getUserdata({ commit }) {
            await axios.get("/getUserinfo").then((response) => {
                commit("SET_USERDATA", response.data);
            });
        },

        /* END OF LOGOUT */
    } /* END OF ACTIONS */,
};
