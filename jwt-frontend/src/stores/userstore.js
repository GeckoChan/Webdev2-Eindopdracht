import { defineStore } from "pinia";
import axios from "../axios-auth";

export const useUserStore = defineStore("userstore", {
  state: () => ({
    username: localStorage.getItem("username") || null,
    token: localStorage.getItem("token") || null,
    email: localStorage.getItem("email") || null,
    role: localStorage.getItem("role") || null,
  }),
  getters: {
    isLoggedIn: (state) => state.username !== null,
    isAdmin: (state) => state.role === "admin",
    getUser: (state) => state,
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

            // Save data to local storage
            localStorage.setItem("username", this.username);
            localStorage.setItem("token", this.token);
            localStorage.setItem("email", this.email);
            localStorage.setItem("role", this.role);
            resolve();
          })
          .catch((error) => reject(error));
      });
    },

    logout() {
      this.username = null;
      this.token = null;
      this.email = null;
      this.role = null;
      delete axios.defaults.headers.common['Authorization'];

      // Clear local storage
      localStorage.removeItem("username");
      localStorage.removeItem("token");
      localStorage.removeItem("email");
      localStorage.removeItem("role");
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
