import { defineStore } from "pinia";
import axios from "../axios-auth";

export const useUserStore = defineStore("userstore", {
  state: () => ({
    user_id: localStorage.getItem("user_id") || null,
    username: localStorage.getItem("username") || null,
    token: localStorage.getItem("token") || null,
    email: localStorage.getItem("email") || null,
    role: localStorage.getItem("role") || null,
  }),
  getters: {
    isLoggedIn: (state) => state.username !== null,
    isAdmin: (state) => state.role === "admin",
    getUserId: (state) => state.user_id,
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
            this.user_id = res.data.user_id;
            this.username = res.data.username;
            this.token = res.data.jwt;
            this.email = res.data.email;
            this.role = res.data.role;
            this.token = res.data.jwt;
            axios.defaults.headers.common['Authorization'] = "Bearer " + res.data.jwt;

            // Save data to local storage
            localStorage.setItem("user_id", this.user_id);
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
      this.user_id = null;
      this.username = null;
      this.token = null;
      this.email = null;
      this.role = null;
      delete axios.defaults.headers.common['Authorization'];

      // Clear local storage
      localStorage.removeItem("user_id");
      localStorage.removeItem("username");
      localStorage.removeItem("token");
      localStorage.removeItem("email");
      localStorage.removeItem("role");
    },

    register(username, email, password) {
      return new Promise((resolve, reject) => {
        axios
          .post("users", {
            username: username,
            email: email,
            password: password,
          })
          .then((res) => {
            console.log(res.data);
            resolve();
          })
          .catch((error) => reject(error));
      });
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
