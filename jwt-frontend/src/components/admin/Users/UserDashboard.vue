<template>
  <sidebar />
  <div class="AdminDashboard">
    <h1>User Dashboard</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Username</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.user_id">
          <td>{{ user.user_id }}</td>
          <td>{{ user.username }}</td>
          <td>
            <router-link :to="`/teacher/assignachievement?user_id=${user.user_id}&username=${user.username}`">
                <button class="btn btn-primary actionbtn">
                  Assign Achievement
                </button>
            </router-link>
          </td>
        </tr>
      </tbody>
    </table>
    <button @click="previousPage" :disabled="currentPage <= 1">
      Previous Page
    </button>
    <button @click="nextPage">Next Page</button>
    <p>Current Page: {{ currentPage }}</p>
  </div>
</template>

<script>
import axios from "../../../axios-auth";
import Sidebar from "../Sidebar.vue";
import { useUserStore } from "../../../stores/userstore";

export default {
  components: {
    Sidebar,
  },
  data() {
    return {
      users: [],
      currentPage: 1,
      limit: 10,
    };
  },
  setup() {
    const userstore = useUserStore();
    return { userstore };
  },
  created() {
    axios.defaults.headers.common["Authorization"] =
      "Bearer " + this.userstore.getToken;
    this.getUsers();
  },
  methods: {
    async getUsers() {
      const offset = (this.currentPage - 1) * this.limit;
      try {
        const response = await axios.get("users", {
          params: {
            offset: offset,
            limit: this.limit,
          },
        });
        this.users = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    nextPage() {
      this.currentPage++;
      this.getUsers();
    },
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.getUsers();
      }
    },
  },
};
</script>
