import axios from "axios";
axios.defaults.baseURL = "http://127.0.0.1:8000/api";
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
export default {
    state: {
        users: [],
        user: JSON.parse(localStorage.getItem("user")) ?? null,
        token: localStorage.getItem("token") ?? null,
        loggedIn:
            localStorage.getItem("user") !== null &&
            localStorage.getItem("token") !== null,
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        SET_USERS(state, users) {
            state.users = users;
        },
        SET_TOKEN(state, token) {
            state.token = token;
        },
        SET_LOGGED_IN(state, loggedIn) {
            state.loggedIn = loggedIn;
        },
        LOGIN(state, payload) {
            state.user = payload.user;
            state.token = payload.token;
            state.loggedIn = true;
        },
        REGISTER(state, payload) {
            state.user = payload.user;
        },
        LOGOUT(state) {
            state.user = null;
            state.token = null;
            state.loggedIn = false;
        },
     
    },
    actions: {
       
        login({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/login", payload)
                    .then((response) => {
                        const { user, token } = response.data;
                        commit("LOGIN", { user, token });
                        localStorage.setItem("user", JSON.stringify(user));
                        localStorage.setItem("token", token);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        register({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/register", payload)
                    .then((response) => {
                        const { user } = response.data;
                        commit("REGISTER", { user });
                        localStorage.setItem("user", JSON.stringify(user));
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        logout({ commit }) {
            return new Promise(() => {
                // axios
                    // .post("/logout")
                    // .then((response) => {
                        commit("LOGOUT");
                        localStorage.removeItem("user");
                        localStorage.removeItem("token");
                        // resolve(response);
                    // })
                    // .catch((error) => {
                    //     reject(error);
                    // });
            });
        },
       
       Users({ commit }) {
            return new Promise((resolve, reject) => {
              axios
                    .get("/users/get")
                    .then((response) => {
                        commit("SET_USERS", response.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    },
    getters: {
        user(state) {
            return state.user;
        },
        token(state) {
            return state.token;
        },
        loggedIn(state) {
            return state.loggedIn;
        },
        isAdmin(state) {
            return state.user?.is_admin == 1;
        },
        users(state) {
            return state.users;
        },
    },
};