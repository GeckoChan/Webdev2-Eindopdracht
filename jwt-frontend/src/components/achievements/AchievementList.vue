<template>
    <div class="container mt-3 mb-1">
      <div class="row">
        <div class="col-md-12">
          
          <div class="list-group">
            <achievement-list-item
              v-for="achievement in achievements"
              :key="achievement.id"
              :achievement="achievement"
            ></achievement-list-item>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
import axios from "../../axios-auth";
import AchievementListItem from "./AchievementListItem.vue";
export default {
  name: "AchievementList",
  components: {
    AchievementListItem,
  },
  data() {
    return {
      achievements: [],
    };
  },
  created() {
    this.getAchievements();
  },
  methods: {
    getAchievements() {
      axios
        .get("achievements/")
        .then((res) => {
          this.achievements = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
