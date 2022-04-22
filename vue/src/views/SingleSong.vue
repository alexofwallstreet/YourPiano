<template>
  <section class="text-gray-600 body-font overflow-hidden">
    <div class="container px-5 py-24 mx-auto">

      <div class="lg:w-4/5 mx-auto flex flex-wrap mb-5">
        <Breadcrumbs :page-name="song.data.title"></Breadcrumbs>
      </div>

      <SongItemSkeleton v-if="song.loading"></SongItemSkeleton>
      <div v-if="!song.loading" class="lg:w-4/5 mx-auto flex flex-wrap rounded border shadow-xl">
        <div class="lg:w-1/2 w-full lg:h-96 sm:h-64 shadow-md p-5">
          <img
          :alt="song.data.title"
          class="object-cover w-full h-full object-center rounded opacity-0 animate-fade-in-right"
          :src="song.data.imagePath">
        </div>

        <div class="justify-between lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0 opacity-0 animate-fade-in-left p-5">
          <div>
            <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ song.data.author }}</h2>
            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ song.data.title }}</h1>
            <p class="leading-relaxed">{{ song.data.description }}</p>
          </div>

          <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
            <div class="flex">
              <span class="mr-3">Жанр</span>
              <GenreLabel :genre-id="song.data.genre"></GenreLabel>
            </div>
            <div class="flex ml-6">
              <span class="mr-3">Сложность</span>
              <DifficultyLabel :level-id="song.data.difficulty"></DifficultyLabel>
            </div>
          </div>
          <div class="flex">
            <router-link :to="{name: 'PianoRatingPlay', params: {id: song.data.id}}"
                         class="flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
              Играть
            </router-link>
            <router-link :to="{name: 'PianoTutorialPlay'}"
                         class="flex text-white bg-indigo-400 border-0 py-2 px-6 mx-2 focus:outline-none hover:bg-indigo-600 rounded">
              Пройти обучение
            </router-link>
            <button
              @click.prevent="toggleLike(song.data)"
              class="ml-auto w-10 h-10 p-0 border-0 inline-flex items-center justify-center text-gray-500">
              <LikeButton :is-favorite="song.data.isFavorite"></LikeButton>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import {computed, ref} from "vue";
import store from "../store";
import router from "../router";
import SongItemSkeleton from "./ui/skeletons/sogn-item-skeleton.vue";
import LikeButton from "./ui/LikeButton.vue";
import DifficultyLabel from "./ui/DifficultyLabel.vue";
import GenreLabel from "./ui/GenreLabel.vue";
import Breadcrumbs from "./ui/Breadcrumbs.vue";

const loading = ref(false);

function toggleLike(song) {
  if (!loading.value) {
    loading.value = true;
    const user = store.state.user.data;
    if (song.isFavorite) {
      store.dispatch('dislikeSong', {song, user})
        .then(() => {
          song.isFavorite = false;
          loading.value = false;
        })
    } else {
      store.dispatch('likeSong', {song, user})
        .then(() => {
          song.isFavorite = true;
          loading.value = false;
        })
    }
  }
}

const song = computed(() => store.state.song);
store.dispatch('getSong', router.currentRoute.value.params.id);
</script>

<style scoped>

</style>
