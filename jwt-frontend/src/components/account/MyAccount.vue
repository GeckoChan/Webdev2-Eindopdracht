<template>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="account-info">
            <h1>My Account</h1>
            <p><strong>Name:</strong> {{ userStore.getUsername }}</p>
            <p><strong>Email:</strong> {{ userStore.getEmail }}</p>
          </div>
          <div>
            <button class="btn btn-primary" @click="logout">Logout</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { useUserStore } from "../../stores/userstore";

export default {
  name: "MyAccount",
  setup() {
    const userStore = useUserStore();
    return { userStore };
  },
  methods: {
    logout() {
      this.userStore.logout();
      this.$router.replace("/login");
    },
  },
};
</script>

