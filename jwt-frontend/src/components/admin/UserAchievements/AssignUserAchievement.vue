<template>
  <Sidebar />
  <div class="container">
    <h1>Assign Achievement to User {{ username }}</h1>
    <div class="table-container">
      <div class="achievementstable" id="nonOwnedAchievementsTable">
        <h2>Non-Owned Achievements</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Achievement ID</th>
              <th>Title</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="achievement in nonOwnedAchievements"
              :key="achievement.achievement_id"
            >
              <td>{{ achievement.achievement_id }}</td>
              <td>{{ achievement.title }}</td>
              <td>
                <button
                  class="btn btn-primary"
                  @click="assignAchievement(achievement.achievement_id)"
                >
                  Assign
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <button @click="previousNonOwnedPage" :disabled="currentNonOwnedPage <= 1">
          Previous Page
        </button>
        <button @click="nextNonOwnedPage">Next Page</button>
        <p>Current Page: {{ currentNonOwnedPage }}</p>
      </div>
      <div class="achievementstable" id="ownedAchievementsTable">
        <h2>Owned Achievements</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Achievement ID</th>
              <th>Title</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="achievement in ownedAchievements"
              :key="achievement.achievement_id"
            >
              <td>{{ achievement.achievement_id }}</td>
              <td>{{ achievement.title }}</td>
              <td>
                <button
                  class="btn btn-danger"
                  @click="unassignAchievement(achievement.achievement_id)"
                >
                  Unassign
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <button @click="previousOwnedPage" :disabled="currentOwnedPage <= 1">
          Previous Page
        </button>
        <button @click="nextOwnedPage">Next Page</button>
        <p>Current Page: {{ currentOwnedPage }}</p>
      </div>
    </div>
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
      nonOwnedAchievements: [],
      ownedAchievements: [],
      user_id: this.$route.query.user_id,
      username: this.$route.query.username,
      currentOwnedPage: 1,
      currentNonOwnedPage: 1,
      ownedLimit: 10,
      nonOwnedLimit: 10,
    };
  },
  setup() {
    const userstore = useUserStore();
    return { userstore };
  },
  created() {
    axios.defaults.headers.common["Authorization"] =
      "Bearer " + this.userstore.getToken;
    this.getNonOwnedAchievements();
    this.getOwnedAchievements();
  },
  methods: {
    async getNonOwnedAchievements() {
      try {
        const response = await axios.get(
          `achievements/nonowned/user/${this.user_id}`, {
            params: {
              offset: (this.currentNonOwnedPage - 1) * this.nonOwnedLimit,
              limit: this.nonOwnedLimit,
            },
          }
        );
        this.nonOwnedAchievements = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async getOwnedAchievements() {
      try {
        const response = await axios.get(
          `achievements/owned/user/${this.user_id}`, {
            params: {
              offset: (this.currentOwnedPage - 1) * this.ownedLimit,
              limit: this.ownedLimit,
            },
          }
        );
        this.ownedAchievements = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async assignAchievement(achievement_id) {
      try {
        await axios.post(`/userachievements`, {
          user_id: this.user_id,
          achievement_id: achievement_id,
        });
        this.getNonOwnedAchievements();
        this.getOwnedAchievements();
      } catch (error) {
        console.error(error);
      }
    },
    async unassignAchievement(achievement_id) {
      try {
        await axios.delete(`userachievements/unassign/`, {
          data: {
            user_id: this.user_id,
            achievement_id: achievement_id,
          },
        });
        this.getNonOwnedAchievements();
        this.getOwnedAchievements();
      } catch (error) {
        console.error(error);
      }
    },
    nextNonOwnedPage() {
      this.currentNonOwnedPage++;
      this.getNonOwnedAchievements();
    },
    previousNonOwnedPage() {
      if (this.currentNonOwnedPage > 1) {
        this.currentNonOwnedPage--;
        this.getNonOwnedAchievements();
      }
    },
    nextOwnedPage() {
      this.currentOwnedPage++;
      this.getOwnedAchievements();
    },
    previousOwnedPage() {
      if (this.currentOwnedPage > 1) {
        this.currentOwnedPage--;
        this.getOwnedAchievements();
      }
    },
  },
};
</script>

<style scoped>
.table-container {
  display: flex;
}

.achievementstable {
  flex: 1;
  margin-right: 10px;
}
</style>
