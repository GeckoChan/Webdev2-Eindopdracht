<template>
  <section id="section-content">
    <div class="container h-100">
      <h1 class="display-4">Achieve in school</h1>
      <div id="content-container" class="row h-100">
        <div class="col-md-7">
          <p class="lead">Showcase of Achievements</p>
          <div class="card" id="achievement_list" style="overflow-y: auto; max-height: 70%;">
            <achievement-list></achievement-list>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
          <p class="lead">Top 5 Achievers</p>
          <div class="card" id="top_achievers" style="overflow-y: auto; max-height: 70%;">
            <top-achievers></top-achievers>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import AchievementList from "./achievements/AchievementList.vue";
import TopAchievers from './account/TopAchievers.vue';
export default {
  name: "Home",
  components: {
    AchievementList,
    TopAchievers,
  },
};  
</script>

<style>
#section-content {
  height: 70vh;
}
</style>
