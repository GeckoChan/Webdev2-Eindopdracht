<template>
  <section class="d-flex justify-content-center align-items-center vh-100">
    <div class="container w-50 bg-dark text-white p-5 rounded shadow">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Register</h1>
          <form @submit.prevent="register">
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
              <label for="inputEmail" class="form-label">Email</label>
              <input
                id="inputEmail"
                type="email"
                class="form-control"
                v-model="email"
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
            <div class="mb-3">
              <label for="inputPassword2" class="form-label"
                >Confirm Password</label
              >
              <input
                type="password"
                class="form-control"
                id="inputPassword2"
                v-model="password2"
              />
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <div>
              <p>
                Already have an account?
                <router-link to="/login">Sign in</router-link>
              </p>
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
  name: "Registration",
  data() {
    return {
      username: "",
      email: "",
      password: "",
      password2: "",
    };
  },
  methods: {
    register() {
      if (this.password !== this.password2) {
        alert("Passwords do not match");
        return;
      }
      useUserStore()
        .register(this.username, this.email, this.password)
        .then(() => {
          this.$router.replace("/login");
        })
        .catch((error) => {
          alert(error);
        });
    },
  },
};
</script>
