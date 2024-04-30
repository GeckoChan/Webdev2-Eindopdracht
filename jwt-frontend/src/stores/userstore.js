import { defineStore } from "pinia";
import axios from "../axios-auth";

export const useUserStore = defineStore("userstore", {
  state: () => ({
    username: null,
    token: null,
    email: null,
    role: null,
  }),
  getters: {
    isLoggedIn: (state) => state.username !== null,
    isAdmin: (state) => state.role === "admin",
    getUsername: (state) => state.username,
    getEmail: (state) => state.email,
    getToken: (state) => state.token,
    getRole: (state) => state.role,
  },
  actions: {
    login(username, password) {
      return new Promise((resolve, reject) => {
        axios
          .post("users/login", {
            username: username,
            password: password,
          })
          .then((res) => {
            console.log(res.data);
            this.username = res.data.username;
            this.token = res.data.jwt;
            this.email = res.data.email;
            this.role = res.data.role;
            axios.defaults.headers.common['Authorization'] = "Bearer " + res.data.token;
            resolve();
          })
          .catch((error) => reject(error));
      });
    },

    logout() {
      this.username = null;
      this.token = null;
      delete axios.defaults.headers.common['Authorization'];
    },

    setUsername(username) {
      this.username = username;
    },
    setEmail(email) {
      this.email = email;
    },
    setToken(token) {
      this.token = token;
    },
    setRole(role) {
      this.role = role;
    }
  },
});
