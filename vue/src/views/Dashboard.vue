<template>
  <div class="flex">
    <Sidebar></Sidebar>
    <div class="flex-1"></div>
  </div>
</template>

<script>
import PageComponent from "../components/PageComponent.vue";
import Sidebar from "./ui/Sidebar.vue";

export default {
  name: "Dashboard",
  components: {PageComponent, Sidebar}
}
</script>

<style scoped>

</style>
