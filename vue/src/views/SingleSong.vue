<template>
  <SingleSongSkeleton v-if="song.loading"></SingleSongSkeleton>
  <section v-else class="pb-16">
    <header class="max-w-7xl mx-auto px-4 opacity-0 animate-fade-in-right">
      <div class="relative z-10 flex items-baseline justify-between pt-16 pb-6 border-b border-gray-200">
        <Breadcrumbs :page-name="song.data.title"></Breadcrumbs>
      </div>
    </header>
    <div class="relative max-w-screen-xl px-4 py-8 mx-auto">
      <div class="grid gap-8 lg:items-start lg:grid-cols-4">
        <div class="lg:col-span-3">

          <div class="relative mt-4 flex gap-6 lg:justify-start justify-center">
            <img
              alt=""
              :src="song.data.imagePath"
              class="w-64 rounded-xl h-64 object-cover opacity-0 animate-fade-in-right"
            />

            <div class="info flex flex-col justify-between opacity-0 animate-fade-in-down">
              <div>
                <DifficultyLabel :level-id="song.data.difficulty"></DifficultyLabel>
                <span class="w-4 inline-block"></span>
                <GenreLabel :genre-id="song.data.genre"></GenreLabel>

                <h1 class="md:text-7xl sm:text-5xl text-3xl font-extrabold tracking-tight text-gray-900">
                  {{ song.data.title }}</h1>
                <h4 class="md:text-xl text-xl font-medium tracking-tight text-gray-400 uppercase mt-2">
                  {{ song.data.author }}</h4>
              </div>
              <div class="mt-2">
                <UserScore :mode="1" :song-points="song.data.ratingPoints" :user-points="song.data.userPoints"></UserScore>
              </div>
              <div class="font-medium mt-2">
                Эту песню сыграли <span class="font-extrabold text-xl text-white bg-indigo-500 px-2 rounded-full">{{ song.data.totalPlays }}</span> раз
              </div>
            </div>
          </div>
        </div>

        <div class="lg:top-0 lg:sticky opacity-0 animate-fade-in-left">
          <form class="space-y-4 lg:pt-8 text-center lg:text-left">
            <router-link
              :to="{name: 'PianoRatingPlay', params: {id: song.data.id}}"
              type="submit"
              class="w-full px-6 py-3 text-sm font-bold tracking-wide text-white bg-indigo-600 text-center
              border-blue-600 rounded w-auto lg:w-full hover:bg-indigo-700 active:bg-indigo-800"
            >
              Играть на рейтинг
            </router-link>

            <router-link
              :to="{name: 'PianoTutorialPlay'}"
              type="button"
              class="w-full ml-3 lg:ml-0 px-6 py-3 text-sm font-bold tracking-wide w-auto lg:w-full text-center text-white hover:bg-indigo-700 bg-indigo-400 border border-gray-300 rounded"
            >
              Пройти обучение
            </router-link>

            <div
              class="w-full h-10 p-0 border-0 flex items-center justify-center lg:justify-between text-gray-500">
              <div>
                Сохрани песню, чтобы не потерять ее:
              </div>
              <LikeButton @click.prevent="toggleLike(song.data)" :is-favorite="song.data.isFavorite"></LikeButton>
            </div>
          </form>
        </div>

        <div class="lg:col-span-3">
          <div class="prose max-w-none">
            <p class="opacity-0 animate-fade-in-down">{{ song.data.description }}</p>
            <iframe
              class="opacity-0 animate-fade-in-up"
              :src="song.data.youtubeLink + '?controls=0'"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            ></iframe>
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
import LikeButton from "./ui/LikeButton.vue";
import DifficultyLabel from "./ui/DifficultyLabel.vue";
import GenreLabel from "./ui/GenreLabel.vue";
import Breadcrumbs from "./ui/Breadcrumbs.vue";
import UserScore from "./ui/UserScore.vue";
import SingleSongSkeleton from "./ui/skeletons/single-song-skeleton.vue";

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
.prose h3 {
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid rgb(243 244 246);

  /* @apply mb-1 pb-2 border-b border-gray-200; */
}

.prose iframe {
  width: 100%;
  margin-top: 1.5rem;
  aspect-ratio: 16 / 9;
  border-radius: 0.75rem;

  /* @apply w-full aspect-video mt-6 rounded-xl; */
}
</style>
