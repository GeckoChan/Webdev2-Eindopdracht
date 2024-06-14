<template>
  <sidebar />
  <AdminAchievementUpdateModal v-show="isModalVisible" :selectedAchievement="selectedAchievement" @close="closeModal"/>
  <div class="AdminDashboard">
    <h1>Achievement Dashboard</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Description</th>
          <th>Image Path</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="achievement in achievements"
          :key="achievement.achievement_id"
        >
          <td>{{ achievement.achievement_id }}</td>
          <td>{{ achievement.title }}</td>
          <td>{{ achievement.description }}</td>
          <td>{{ achievement.image_path }}</td>
          <td>
            <button class="btn btn-primary actionbtn" @click="showModal(achievement)">Edit</button>
            <button
              class="btn btn-danger"
              @click="deleteAchievement(achievement.achievement_id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <button @click="previousPage" :disabled="currentPage <= 1">
      Previous Page
    </button>
    <button @click="nextPage">Next Page</button>
    <p>Current Page: {{ currentPage }}</p>

    <div class="create-achievement-card">
      <form @submit.prevent="createAchievement" class="achievement-form">
        <div class="form-item">
          <label for="title">Title:</label>
          <input id="title" v-model="newAchievement.title" required />
        </div>
        <div class="form-item">
          <label for="description">Description:</label>
          <input
            id="description"
            v-model="newAchievement.description"
            required
          />
        </div>
        <div class="form-item">
          <label for="imagePath">Image Path (optional):</label>
          <input id="imagePath" v-model="newAchievement.image_path" />
        </div>
        <div class="form-item">
          <button type="submit" class="btn btn-success">Create</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "../../../axios-auth";
import Sidebar from "../Sidebar.vue";
import { useUserStore } from "../../../stores/userstore";
import AdminAchievementUpdateModal from "./AdminAchievementUpdateModal.vue";

export default {
  components: {
    Sidebar,
    AdminAchievementUpdateModal,
  },
  data() {
    return {
      achievements: [],
      newAchievement: {
        title: "",
        description: "",
        image_path: "",
      },
      currentPage: 1,
      limit: 10,
      isModalVisible: false,
      selectedAchievement: "",
    };
  },
  setup() {
    const userstore = useUserStore();
    return { userstore };
  },
  created() {
    axios.defaults.headers.common["Authorization"] =
      "Bearer " + this.userstore.getToken;
    this.getAchievements();
  },
  methods: {
    async getAchievements() {
      const offset = (this.currentPage - 1) * this.limit;
      try {
        const response = await axios.get("achievements", {
          params: {
            offset: offset,
            limit: this.limit,
          },
        });
        this.achievements = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async deleteAchievement(id) {
      try {
        await axios.delete("achievements/" + id);
        this.getAchievements();
      } catch (error) {
        console.error(error);
      }
    },
    async createAchievement() {
      try {
        await axios.post("achievements", this.newAchievement);
        this.getAchievements();
      } catch (error) {
        console.error(error);
      }
    },
    nextPage() {
      this.currentPage++;
      this.getAchievements();
    },
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.getAchievements();
      }
    },
    showModal(achievement) {
      this.selectedAchievement = achievement;
      this.isModalVisible = true;
    },
    closeModal() {
        this.isModalVisible = false;
        this.getAchievements();
        this.selectedAchievement = "";
    }
  },
};
</script>

<style>
.AdminDashboard {
  margin-left: 200px;
  padding: 20px;
}

.actionbtn {
  margin-right: 10px;
}

.create-achievement-card {
  margin-left: 200px;
  position: fixed;
  bottom: 0;
  left: 0;
  width: calc(100% - 200px);
  background-color: #f8f9fa;
  padding: 20px;
  box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
}

.achievement-form {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.achievement-form > div {
  flex: 1; /* Each child div takes equal width */
  margin-right: 20px; /* Space between form elements */
}

.achievement-form > div:last-child {
  margin-right: 0;
}

.achievement-form input,
.achievement-form textarea {
  width: 100%;
  box-sizing: border-box;
}

.achievement-form button {
  white-space: nowrap;
}
</style>
