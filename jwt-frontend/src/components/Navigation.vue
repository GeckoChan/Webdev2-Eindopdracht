<template>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <router-link to="/" class="nav-link" active-class="active"
            >Home</router-link
          >
        </li>
        <li class="nav-item" v-if="userstore.isLoggedIn">
          <router-link to="/myachievements" class="nav-link" active-class="active"
            >My Achievements</router-link
          >
        </li>
        <li class="nav-item" v-if="userstore.isAdmin && userstore.isLoggedIn">
          <router-link to="/teacher" class="nav-link" active-class="active"
            >Teacher</router-link
          >
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item" v-if="!userstore.isLoggedIn">
          <router-link to="/login" class="nav-link" active-class="active">
            Login
          </router-link>
        </li>
        <li class="nav-item" v-if="userstore.isLoggedIn">
          <router-link to="/myaccount" class="nav-link" active-class="active">
            My account
          </router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { useUserStore } from "../stores/userstore";

export default {
  name: "Navigation",
  setup() {
    const userstore = useUserStore();

    return { userstore };
  },
};
</script>

<style></style>
