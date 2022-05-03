<template>
  <div class="leading-normal tracking-normal" id="main-body">
    <div class="flex flex-wrap">

      <Sidebar />

      <div class="w-full flex flex-col justify-between bg-gray-100 min-h-screen transition-all duration-200" :class="adminSideBarOpen ? 'overlay lg:pl-64' : 'pl-0'" id="main-content">

        <Navbar />

        <div class="p-6 bg-gray-100 mb-20">
          <router-view />
        </div>

        <Footer />

      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

import Sidebar from "../views/admin/sections/Sidebar.vue";
import Navbar from "../views/admin/sections/Navbar.vue";
import Footer from "../views/admin/sections/Footer.vue";

export default {
  name: 'Dashboard',
  computed: {
    ...mapState(['adminSideBarOpen'])
  },
  components: {
    Sidebar,
    Navbar,
    Footer
  }
}
</script>
