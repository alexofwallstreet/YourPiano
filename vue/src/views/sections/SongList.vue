<template>
  <SongListSkeleton v-if="songs.loading"></SongListSkeleton>
  <div v-else class="lg:col-span-3 w-full">
    <div class="bg-white">
      <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="sr-only">Songs</h2>

        <div
          class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
          <router-link
            v-for="(song, i) in songs.data" :to="{name: 'SingleSong', params: {id: song.id}, props: {song: song}}"
            :key="song.id"
            class="group opacity-0 animate-fade-in-down"
            :style="{animationDelay: `${i * 10}ms`}">
            <div
              class="relative w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
              <img :src="song.imagePath" :alt="song.title" class="w-full h-full object-center object-cover"/>
              <div class="absolute flex justify-end items-end p-2">
                <LikeButton :is-favorite="song.isFavorite"></LikeButton>
              </div>
            </div>
            <h3 class="mt-4 text-sm text-gray-700">
              {{ song.author }}
            </h3>
            <p class="mt-1 text-lg font-medium text-gray-900">
              {{ song.title }}
            </p>
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
export default {
  name: "SongList",
  components: {LikeButton, SongListSkeleton},
  props: {
    songs: Object
  }
}
</script>

<style scoped>

</style>
