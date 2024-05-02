import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Home.vue';
import Login from '../components/account/Login.vue';
import MyAccount from '../components/account/MyAccount.vue';
import Registration from '../components/account/Registration.vue';
import MyAchievementsList from '../components/achievements/MyAchievementsList.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/myaccount', component: MyAccount },
    { path: '/register', component: Registration },
    { path: '/myachievements', component: MyAchievementsList }
  ]
})

export default router
