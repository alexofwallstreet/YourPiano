<template>
  <NothingFound></NothingFound>
  <div class="flex flex-col items-center justify-center pb-24 px-5">
    <h1 class="font-bold tracking-tight text-gray-900 sm:text-2xl text-center">
      Ошибка 404<br> <span class="font-medium text-lg">страница не найдена</span>
    </h1>
    <router-link
      class="block w-full px-12 py-3 text-sm font-medium text-white bg-indigo-500 text-center mt-4
              rounded xs:w-auto active:text-opacity-75 hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring"
      :to="{name: 'Home'}">
      Вернуться на главную
    </router-link>
  </div>

</template>

<script setup>
import NothingFound from "./ui/NothingFound.vue";

</script>

<style scoped>

</style>
