<template>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
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
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { useUserStore } from "../stores/userstore";

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
