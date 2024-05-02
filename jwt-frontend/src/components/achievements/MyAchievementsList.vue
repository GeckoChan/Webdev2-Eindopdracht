<template>
  <div class="container mt-3 mb-1">
    <h1>My Achievements Showcase</h1>
    <div class="row">
      <div class="col-md-12">
        <div class="list-group">
          <achievement-list-item
            v-for="userAchievement in userAchievements"
            :key="userAchievement.id"
            :achievement="userAchievement.achievement"
          ></achievement-list-item>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "../../axios-auth";
import AchievementListItem from "./AchievementListItem.vue";
import { useUserStore } from "../../stores/userstore";
export default {
  name: "AchievementList",
  components: {
    AchievementListItem,
  },
  data() {
    return {
        userAchievements: [],
    };
  },
  setup() {
    const userstore = useUserStore();
    return { userstore };
  },
  created() {
    this.getAchievements();
  },
  methods: {
    getAchievements() {
      axios
        .get("userachievements/account/" + this.userstore.getUserId)
        .then((res) => {
          this.userAchievements = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
