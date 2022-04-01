<template>
  <div class="min-h-full">
    <Header></Header>
    <router-view></router-view>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from "../views/sections/Header.vue";
import Footer from "../views/sections/Footer.vue";

export default {
  components: {Header, Footer}
}

</script>
