<template>
  <section class="d-flex drop-shadow-lg justify-content-center align-items-center vh-100">
    <div class="container w-25 bg-dark text-white p-5 rounded shadow">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Sign in</h1>
          <form @submit.prevent="login">
            <div class="mb-3">
              <label for="inputUsername" class="form-label">Username</label>
              <input
                id="inputUsername"
                type="text"
                class="form-control"
                v-model="username"
              />
            </div>
            <div class="mb-3">
              <label for="inputPassword" class="form-label">Password</label>
              <input
                type="password"
                class="form-control"
                id="inputPassword"
                v-model="password"
              />
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
            <div>
              <p>Don't have an account yet? <router-link to="/register">Sign up</router-link></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { useUserStore } from "../../stores/userstore";

export default {
  name: "Login",
  data() {
    return {
      username: "",
      password: "",
    };
  },
  setup() {
    const userstore = useUserStore();
    return { userstore };
  },
  methods: {
    login() {
      this.userstore
        .login(this.username, this.password)
        .then(() => {
          this.$router.replace("/myaccount");
        })
        .catch((error) => {
          this.errorMessage = error;
        });
    },
  },
};
</script>

<style></style>
