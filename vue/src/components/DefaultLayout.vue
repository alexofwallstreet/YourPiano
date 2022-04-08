<template>
  <div class="min-h-screen flex flex-col justify-between">
    <Header></Header>
    <div id="content">
      <router-view></router-view>
    </div>
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
