<template>
  <div class="modal-backdrop">
    <div class="modal card p-3">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Update Achievement</h2>
        <button class="btn btn-close" @click="closeModal"></button>
      </div>
      <div class="form-group">
        <label for="name">title</label>
        <input
          type="text"
          class="form-control"
          id="title"
          v-model="achievement.title"
        />
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input
          type="text"
          class="form-control"
          id="description"
          v-model="achievement.description"
        />
      </div>
      <div class="form-group">
        <label for="imagePath">Image Path</label>
        <input
          type="text"
          class="form-control"
          id="imagePath"
          v-model="achievement.image_path"
        />
      </div>
      <button class="btn btn-primary" @click="updateAchievement">Update</button>
    </div>
  </div>
</template>

<script>
import axios from "../../../axios-auth";
import { useUserStore } from "../../../stores/userstore";

export default {
  name: "AdminAchievementUpdateModal",
  props: ["showModal", "selectedAchievement"],
  data() {
    return {
        achievement: this.selectedAchievement || { title: '', description: '', image_path: '' },
    };
  },
  watch: {
    selectedAchievement() {
      this.achievement = this.selectedAchievement;
    },
  },
  setup() {
    const userstore = useUserStore();
    return { userstore };
  },
  created() {
    axios.defaults.headers.common["Authorization"] =
      "Bearer " + this.userstore.getToken;
  },
  methods: {
    closeModal() {
      this.$emit("close");
    },
    async updateAchievement() {
      try {
        await axios.put(
          "achievements/" + this.achievement.achievement_id,
          this.achievement
        );
        this.closeModal();
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style scoped>
.modal-backdrop {
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal {
  top: auto;
  left: auto;
  box-shadow: 2px 2px 20px 1px;
  display: flex;
  width: 50%;
  height: auto;
}
</style>
