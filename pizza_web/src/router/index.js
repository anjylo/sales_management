import { createRouter, createWebHistory } from 'vue-router'

import Login from '@views/Login.vue'
import Dashboard from '@views/Dashboard.vue'

import * as auth from '@utils/auth'

const routes = [
  { 
    path: '/', 
    redirect: '/dashboard' 
  },
  { 
    path: '/login', 
    name: 'Login', 
    component: Login 
  },
  { 
    path: '/dashboard', 
    name: 'Dashboard', 
    component: Dashboard,
    meta: {
      requiresAuth: true
    }
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach(async (to, from) => {
  
  if (to.meta.requiresAuth) {
    const isAuthenticated = await auth.isLoggedIn()

    if (!isAuthenticated && to.name !== 'Login') {
      return { name: 'Login' }
    }
  }
})

export default router