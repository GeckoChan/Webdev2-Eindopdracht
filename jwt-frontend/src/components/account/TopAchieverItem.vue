<template>
    <div class="card achievement-card mb-3">
      <div class="card-body row">
        <div class="col-md-6">
          <p class="mb-0" style="font-weight: bold;">Username:</p>
          <p class="mb-0">{{ achiever.username }}</p>
        </div>
        <div class="col-md-6">
          <p class="mb-0" style="font-weight: bold;">Achievements:</p>
          <p class="mb-0">{{ achiever.count }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "TopAchieverItem",
    props: {
      achiever: Object,
    },
  };
  </script>
  