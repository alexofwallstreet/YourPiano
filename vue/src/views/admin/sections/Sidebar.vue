<template>
  <!-- give the sidebar z-50 class so its higher than the navbar if you want to see the logo -->
  <!-- you will need to add a little "X" button next to the logo in order to close it though -->
  <div class="w-1/2 md:w-1/3 lg:w-64 fixed md:top-0 md:left-0 h-screen lg:block border-r z-30 bg-gray-800" :class="adminSideBarOpen ? '' : 'hidden'" id="main-nav">

    <div class="flex justify-between items-start w-full px-4 py-4">
      <div class="w-full h-20 flex px-4 items-center">
        <img class="w-14 h-full" src="/logo-min.svg" alt="YourPiano Logo"/>
      </div>
      <button class="lg:hidden hover:text-blue-500 hover:border-white focus:outline-none navbar-burger py-4" @click="toggleAdminSidebar()">
        <XIcon class="h-10 w-10 fill-indigo-50"></XIcon>
      </button>
    </div>



    <div class="my-8 px-4">
      <router-link :to="{name: 'Dashboard'}"
                   class="w-full flex items-center text-white h-10 pl-4 hover:bg-gray-700 rounded-lg cursor-pointer"
                   :class="$route.name === 'Dashboard' ? 'bg-gray-700' : ''">
        <HomeIcon class="h-6 w-6 mr-2 fill-white"></HomeIcon>
        <span class="text-white font-medium">Дашборд</span>
      </router-link>

      <router-link :to="{name: 'AdminUsers'}"
                   class="w-full flex items-center text-white h-10 pl-4 hover:bg-gray-700 rounded-lg cursor-pointer"
                   :class="$route.name === 'AdminUsers' ? 'bg-gray-700' : ''">
        <UsersIcon class="h-6 w-6 mr-2 fill-white"></UsersIcon>
        <span class="text-white font-medium">Пользователи</span>
      </router-link>

      <router-link :to="{name: 'AdminSongs'}"
                   class="w-full flex items-center text-white h-10 pl-4 hover:bg-gray-700 rounded-lg cursor-pointer"
                   :class="$route.name === 'AdminSongs' ? 'bg-gray-700' : ''">
        <MusicNoteIcon class="h-6 w-6 mr-2 fill-white"></MusicNoteIcon>
        <span class="text-white font-medium">Песни</span>
      </router-link>

      <router-link :to="{name: 'Home'}"
                   class="w-full flex items-center text-white h-10 pl-4 hover:bg-gray-700 rounded-lg cursor-pointer"
                   :class="$route.name === 'Home' ? 'bg-gray-700' : ''">
        <LogoutIcon class="h-6 w-6 mr-2 fill-white"></LogoutIcon>
        <span class="text-white font-medium">Выход</span>
      </router-link>

    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { HomeIcon, UsersIcon, MusicNoteIcon, LogoutIcon, XIcon } from '@heroicons/vue/solid'

export default {
  name: 'Sidebar',
  computed: {
    ...mapState(['adminSideBarOpen'])
  },
  methods: {
    toggleAdminSidebar() {
      this.$store.dispatch('toggleAdminSidebar')
    }
  },
  components: {HomeIcon, UsersIcon, MusicNoteIcon, LogoutIcon, XIcon}
}
</script>
