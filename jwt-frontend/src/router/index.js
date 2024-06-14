import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Home.vue';
import Login from '../components/account/Login.vue';
import MyAccount from '../components/account/MyAccount.vue';
import Registration from '../components/account/Registration.vue';
import MyAchievementsList from '../components/achievements/MyAchievementsList.vue';

import SideBar from '../components/admin/SideBar.vue';
import AchievementDashboard from '../components/admin/Achievements/AchievementDashboard.vue';
import UserDashboard from '../components/admin/Users/UserDashboard.vue';
import AssignUserAchievement from '../components/admin/UserAchievements/AssignUserAchievement.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/myaccount', component: MyAccount },
    { path: '/register', component: Registration },
    { path: '/myachievements', component: MyAchievementsList },
    
    { path: '/teacher', component: SideBar},
    { path: '/teacher/achievements', component: AchievementDashboard},
    { path: '/teacher/users', component: UserDashboard},
    { path: '/teacher/assignachievement', component: AssignUserAchievement}
  ]
})

export default router
