<template>
  <div class="sidenav">
    <h3>Dashboards</h3>
    <router-link to="/teacher/achievements">Achievement</router-link>
    <router-link to="/teacher/users">Users</router-link>
  </div>
</template>
<script></script>

<style>
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  top: 55px;
  left: 0;
  background-color: #3f474f;
  overflow-x: hidden;
  padding-top: 20px;
  z-index: 1;;
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
