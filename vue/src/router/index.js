import {createRouter, createWebHistory} from "vue-router";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import Piano from "../views/Piano.vue";
import Home from "../views/Home.vue";
import store from "../store";
import Songs from "../views/Songs.vue";
import SingleSong from "../views/SingleSong.vue";
import AdminLayout from "../components/AdminLayout.vue";
import Dashboard from "../views/admin/Dashboard.vue";
import Profile from "../views/Profile.vue";
import Overview from "../views/profile/Overview.vue";
import Likes from "../views/profile/Likes.vue";
import AdminUsers from "../views/admin/AdminUsers.vue";
import AdminSongs from "../views/admin/AdminSongs.vue";
import About from "../views/About.vue";
import Settings from "../views/profile/Settings.vue";
import NotFound from "../views/NotFound.vue";

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
        path: '/404',
        name: '404',
        component: NotFound
      },
      {
        path: '/songs/:id',
        name: 'SingleSong',
        component: SingleSong
      },
      {
        path: '/home',
        name: 'Home',
        component: Home
      },
      {
        path: '/about',
        name: 'About',
        component: About
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
        path: '/piano/tutorial-play/:id',
        name: 'PianoTutorialPlay',
        component: Piano,
        props: {
          gameMode: store.state.gameModes.TUTORIAL_MODE
        },
        meta: {requiresAuth: true},
      },
      {
        path: '/piano/rating-play/:id',
        name: 'PianoRatingPlay',
        component: Piano,
        props: {
          gameMode: store.state.gameModes.RATING_GAME_MODE
        },
        meta: {requiresAuth: true},
      },
      {
        path: '/profile',
        name: 'Profile',
        redirect: '/profile/overview',
        component: Profile,
        meta: {requiresAuth: true},
        children: [
          {
            path: '/profile/overview',
            name: 'ProfileOverview',
            component: Overview
          },
          {
            path: '/profile/liked-songs',
            name: 'ProfileLikes',
            component: Likes
          },
          {
            path: '/profile/settings',
            name: 'ProfileSettings',
            component: Settings
          },
        ]
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
  },
  {
    path: '/admin',
    component: AdminLayout,
    redirect: '/admin/dashboard',
    meta: {requiresAdmin: true},
    children: [
      { path: 'dashboard', name: 'Dashboard', component: Dashboard },
      { path: 'users', name: 'AdminUsers', component: AdminUsers },
      { path: 'songs', name: 'AdminSongs', component: AdminSongs },
    ]
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: {name: '404'}
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || {top: 0}
  }
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({name: 'Login'})
  } else if (to.meta.requiresAdmin && !store.state.user.data?.isAdmin) {
    next({name: '404'})
  } else if (to.meta.isGuest && store.state.user.token) {
    next({name: 'Profile'})
  } else {
    next();
  }
})

export default router;
