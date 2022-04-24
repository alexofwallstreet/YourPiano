<template>
  <div v-if="store.state.song.loading" class="animate-pulse">
    <div class="bg-white w-1/2 h-4 bg-slate-200 rounded-xl opacity-0 animate-fade-in-right" />
  </div>
  <div v-else class="bg-white flex items-center flex-wrap opacity-0 animate-fade-in-right">
    <ul class="flex items-center flex-wrap">

      <li class="inline-flex items-center">
        <svg class="w-5 h-auto fill-current mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg>

        <router-link :to="{name: 'Home'}" class="text-gray-600 hover:text-indigo-600">
          Главная
        </router-link>

        <svg class="w-5 h-auto fill-current mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/></svg>
      </li>

      <li class="inline-flex items-center">
        <router-link :to="{name: 'Songs'}" class="text-gray-600 hover:text-indigo-600">
          Песни
        </router-link>

        <svg class="w-5 h-auto fill-current mx-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/></svg>
      </li>

      <li class="inline-flex items-center">
        <a href="#" class="hover:text-blue-500 text-indigo-600">
          {{ pageName }}
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
import store from "../../store";
export default {
  name: "Breadcrumbs",
  props: {
    pageName: ''
  },
  data() {
    return {
      store
    }
  }
}
</script>

<style scoped>

</style>
