<template>
  <div class="sticky top-0 z-10">
    <div class="w-full h-20 px-6 bg-gray-100 border-b flex items-center justify-between">

      <!-- left navbar -->
      <div class="flex">

        <!-- mobile hamburger -->
        <div class="inline-block lg:hidden flex items-center mr-4">
          <button class="hover:text-blue-500 hover:border-white focus:outline-none navbar-burger" @click="toggleAdminSidebar()">
            <svg class="h-5 w-5" v-bind:style="{ fill: 'black' }" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
          </button>
        </div>
      </div>

      <!-- right navbar -->
      <div class="flex items-center relative">
        <span class="text-lg mr-4 font-medium">{{user.data.name}}</span>
        <img :src="user?.data?.imagePath" class="w-12 h-12 rounded-full shadow-lg">
      </div>
    </div>

  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'Navbar',
  computed: {
    ...mapState(['adminSideBarOpen']),
    ...mapState(['user']),
  },
  data() {
    return {
      dropDownOpen: false
    }
  },
  methods: {
    toggleAdminSidebar() {
      this.$store.dispatch('toggleAdminSidebar')
    }
  }
}
</script>
