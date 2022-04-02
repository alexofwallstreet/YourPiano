import {createRouter, createWebHistory} from "vue-router";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import Piano from "../views/Piano.vue";
import Home from "../views/Home.vue";
import store from "../store";
import Songs from "../views/Songs.vue";

const routes = [
  {
    path: '/',
    redirect: '/home',
    component: DefaultLayout,
    children: [
      {
        path: '/songs',
        name: 'Songs',
        component: Songs
      },
      {
        path: '/home',
        name: 'Home',
        component: Home
      },
      {
        path: '/piano/free-play',
        name: 'PianoFreePlay',
        component: Piano,
        props: {
          gameMode: store.state.gameModes.FREE_PLAY_MODE
        },
      },
      {
        path: '/auth',
        redirect: '/login',
        name: 'Auth',
        component: AuthLayout,
        meta: {isGuest: true},
        children: [
          {
            path: '/login',
            name: 'Login',
            component: Login
          },
          {
            path: '/register',
            name: 'Register',
            component: Register
          },
        ]
      },
    ]
  }

];

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({name: 'Login'})
  } else {
    next();
  }
})

export default router;
