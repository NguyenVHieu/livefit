import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('@/views/Home.vue'),
      meta: {
        pageTitle: 'Home',
        breadcrumb: [
          {
            text: 'Home',
            active: true,
          },
        ],
      },
    },
    {
      path: '/second-page',
      name: 'second-page',
      component: () => import('@/views/SecondPage.vue'),
      meta: {
        pageTitle: 'Second Page',
        breadcrumb: [
          {
            text: 'Second Page',
            active: true,
          },
        ],
      },
    },
    {
      path: '/sign-in',
      name: 'sign-in',
      component: () => import('@/views/Login.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('@/views/profile/Profile.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/forgot-password',
      name: 'forgot-password',
      component: () => import('@/views/ForgotPassword.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/reset-password',
      name: 'reset-password',
      component: () => import('@/views/ResetPassword.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('@/views/Register.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/workout-builder',
      name: 'workout-builder',
      component: () => import('@/views/WorkoutBuilder.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/workout-sample',
      name: 'workout-sample',
      component: () => import('@/views/WorkoutSample.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/error-404',
      name: 'error-404',
      component: () => import('@/views/error/Error404.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/workout',
      name: 'workout',
      component: () => import('@/views/WorkoutPage.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/workout-process',
      name: 'workout-process',
      component: () => import('@/views/WorkoutProcess.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/workout-process-start',
      name: 'workout-process-start',
      component: () => import('@/views/WorkoutStart.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/workout-done',
      name: 'workout-done',
      component: () => import('@/views/WorkoutDone.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/workout/:id',
      name: 'workout-detail',
      component: () => import('@/views/WorkoutDetail.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

export default router
