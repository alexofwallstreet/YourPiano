<template>
  <section class="text-gray-600 body-font overflow-hidden">
    <div class="container px-5 py-24 mx-auto">
      <SongItemSkeleton v-if="song.loading"></SongItemSkeleton>
      <div v-if="!song.loading" class="lg:w-4/5 mx-auto flex flex-wrap">
        <img
          :alt="song.data.title" class="lg:w-1/2 w-full lg:h-96 h-64 object-cover object-center rounded"
             :src="song.data.imagePath">
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
          <h2 class="text-sm title-font text-gray-500 tracking-widest">{{song.data.author}}</h2>
          <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{song.data.title}}</h1>
          <p class="leading-relaxed">{{song.data.description}}</p>
          <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
            <div class="flex">
              <span class="mr-3">Жанр</span>
              {{song.data.genre}}
            </div>
            <div class="flex ml-6 items-center">
              <span class="mr-3">Сложность</span>
              {{song.data.difficulty}}
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
              class="rounded-full ml-auto w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                   viewBox="0 0 24 24">
                <path
                  d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import {computed} from "vue";
import store from "../store";
import router from "../router";
import SongItemSkeleton from "./ui/skeletons/sogn-item-skeleton.vue";

export default {
  components: {SongItemSkeleton},
  setup() {
    const song = computed(() => store.state.song);
    store.dispatch('getSong', router.currentRoute.value.params.id);
    console.log(song)
    return {
      song
    }
  }
}
</script>

<style scoped>

</style>
