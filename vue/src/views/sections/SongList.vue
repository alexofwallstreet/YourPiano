<template>
  <SongListSkeleton v-if="songs.loading"></SongListSkeleton>
  <div v-else class="lg:col-span-3 w-full">
    <div>
      <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="sr-only">Songs</h2>

        <div
          class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
          <router-link
            v-for="(song, i) in (onlyBest ? songs.data.slice(0,4) : songs.data)"
            :to="{name: 'SingleSong', params: {id: song.id}, props: {song: song}}"
            :key="song.id"
            class="group opacity-0 animate-fade-in-down border-b drop-shadow pb-5"
            :style="{animationDelay: `${i * 10}ms`}">
            <div
              class="relative w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
              <img :src="song.imagePath" :alt="song.title"
                   class="w-full h-full object-center object-cover brightness-90"/>
              <div v-if="!onlyBest" class="absolute flex justify-between items-end p-2">
                <div>
                  <UserScore v-if="song.userPoints" :user-points="song.userPoints" :mode="0"></UserScore>
                </div>
<!--                <LikeButton :is-favorite="song.isFavorite"></LikeButton>-->
              </div>
              <!--              <div class="h-4">-->
              <!--                <DifficultyLabel :level-id="song.difficulty"></DifficultyLabel>-->
              <!--              </div>-->
              <div class="relative flex items-start pt-2 justify-center w-full right-0">
                <CountPlaysLabel :count="song.totalPlays"></CountPlaysLabel>
              </div>
            </div>
            <h3 class="mt-2 text-sm text-gray-700">
              {{ song.author }}
            </h3>
            <p class="text-2xl font-medium text-gray-900">
              {{ song.title }}
            </p>
            <div class="mt-2">
              <DifficultyLabel class="h-5 mt-1 mr-2" :level-id="song.difficulty"></DifficultyLabel>
            </div>
            <div class="mt-1">
              <GenreLabel :genre-id="song.genre" class="h-5 mt-1"></GenreLabel>
            </div>
          </router-link>
        </div>
      </div>
    </div>
    <slot></slot>
  </div>
</template>

<script>
import SongListSkeleton from "../ui/skeletons/song-list-skeleton.vue";
import LikeButton from "../ui/LikeButton.vue";
import DifficultyLabel from "../ui/DifficultyLabel.vue";
import GenreLabel from "../ui/GenreLabel.vue";
import UserScore from "../ui/UserScore.vue";
import CountPlaysLabel from "../ui/CountPlaysLabel.vue";

export default {
  name: "SongList",
  components: {CountPlaysLabel, UserScore, GenreLabel, DifficultyLabel, LikeButton, SongListSkeleton},
  props: {
    songs: Object,
    onlyBest: false
  },
}
</script>

<style scoped>

</style>
