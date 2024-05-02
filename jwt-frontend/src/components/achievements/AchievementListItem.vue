<template>
  <div class="card achievement-card mb-3">
    <div class="card-body row">
      <div class="achievement-image m-3 col-md-1">
        <img
          :src="achievement.image_path"
          alt="Image of Achievement"
          :title="achievement.title"
        />
      </div>
      <div class="card m-3 achievement-title col-md-3">
        <p>{{ achievement.title }}</p>
      </div>
      <div class="card m-3 achievement-description col-md-6">
        <p>
          <small>{{ achievement.description }}</small>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AchievementListItem",
  props: {
    achievement: Object,
  },
};
</script>
