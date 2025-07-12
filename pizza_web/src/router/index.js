import { createRouter, createWebHistory } from 'vue-router'

import Login from '@views/Login.vue'
import Register from '@views/Register.vue'
import Dashboard from '@views/Dashboard.vue'

import Upload from '@/components/Upload.vue'
import Report from '@/components/Report.vue'

import * as auth from '@utils/auth'

const routes = [
  { 
    path: '/', 
    redirect: '/dashboard'
  },
  { 
    path: '/login', 
    name: 'Login', 
    component: Login,
    meta: {
      title: 'Login'
    }
  },
  { 
    path: '/register', 
    name: 'Register', 
    component: Register,
    meta: {
      title: 'Register'
    }
  },
  { 
    path: '/dashboard', 
    name: 'Dashboard', 
    component: Dashboard,
    meta: {
      requiresAuth: true
    },
    children: [
      {
        path: '',
        redirect: { name: 'upload' },
      },
      {
        path: 'upload',
        name: 'upload',
        component: Upload,
        meta: {
          title: 'Dashboard | Upload'
        }
      },
      {
        path: 'report',
        name: 'report',
        component: Report,
        meta: {
          title: 'Dashboard | Report'
        }
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach(async (to, from) => {
  document.title = to.meta.title

  if (to.meta.requiresAuth) {
    const isAuthenticated = await auth.isLoggedIn()

    if (!isAuthenticated && to.name !== 'Login') {
      return { name: 'Login' }
    }
  }
})

export default router