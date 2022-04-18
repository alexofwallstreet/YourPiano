<template>
  <div
    class="relative bg-indigo-50 px-4 py-16 w-full md:px-24 lg:px-8 lg:py-20">
    <svg class="absolute left-0 top-0 w-full h-6 -mt-5 sm:-mt-10 sm:h-16 text-deep-purple-accent-400"
         preserveAspectRatio="none" viewBox="0 0 1440 54">
      <path class="fill-indigo-50"
            d="M0 22L120 16.7C240 11 480 1.00001 720 0.700012C960 1.00001 1200 11 1320 16.7L1440 22V54H1320C1200 54 960 54 720 54C480 54 240 54 120 54H0V22Z"></path>
    </svg>
    <div class="mx-auto mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl">

    </div>
    <SectionHeader
      :label="'песни'"
      :title="'Лучшие песни YourPiano'"
      :content="'Найдите подходящую для вас песню по жанру или уровню сложности'"
    ></SectionHeader>
    <SongList :songs="songs" :only-best="true"></SongList>
    <div class="flex justify-center">
      <router-link :to="{name: 'Songs'}"
                   class="inline-block text-center bg-indigo-600 border border-transparent rounded-md py-3 px-8 font-medium text-white hover:bg-indigo-700">
        Больше песен
      </router-link>
    </div>
    <svg class="absolute left-0 bottom-0 w-full h-6 -mt-5 sm:-mb-10 sm:h-16 rotate-180 z-10" preserveAspectRatio="none"
         viewBox="0 0 1440 54">
      <path class="fill-indigo-50"
            d="M0 22L120 16.7C240 11 480 1.00001 720 0.700012C960 1.00001 1200 11 1320 16.7L1440 22V54H1320C1200 54 960 54 720 54C480 54 240 54 120 54H0V22Z"></path>
    </svg>
  </div>
</template>

<script setup>
import SectionHeader from "../ui/SectionHeader.vue";
import SongList from "./SongList.vue";
import {computed} from "vue";
import store from "../../store";

const songs = computed(() => store.state.songs);
store.dispatch('getSongs');
</script>

<style scoped>

</style>
