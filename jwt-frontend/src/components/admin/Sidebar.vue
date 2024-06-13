<template>
  <div class="sidebar">
    <h3>achievements</h3>
    <router-link to="/admin/achievements">View all achievements</router-link>
  </div>
</template>
<script></script>

<style>
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 55px;
  left: 0;
  background-color: #64bba8;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 16px;
  color: white;
  display: block;
}

.sidenav a:hover {
  color: grey;
}

.sidenav h3 {
  padding: 10px 16px;
  color: #f1f1f1;
  font-size: 20px;
  font-weight: bold;
  border-bottom: 1px solid #f1f1f1;
  margin-bottom: 10px;
}
</style>
