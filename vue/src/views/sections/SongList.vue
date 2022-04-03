<template>
  <SongListSkeleton v-if="songs.loading"></SongListSkeleton>
  <!-- Product grid -->
  <div class="lg:col-span-3" v-if="!songs.loading">
    <!-- Replace with your content -->
    <div class="bg-white">
      <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="sr-only">Songs</h2>

        <div
          class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
          <router-link v-for="song in songs.data" :to="{name: 'SingleSong', params: {id: song.id}, props: {song: song}}" :key="song.id" class="group">
            <div
              class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
              <img :src="song.imagePath" :alt="song.title" class="w-full h-full object-center object-cover group-hover:opacity-75"/>
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
  </div>
</template>

<script>
import SongListSkeleton from "../ui/skeletons/song-list-skeleton.vue";
export default {
  name: "SongList",
  components: {SongListSkeleton},
  props: {
    songs: Array
  }
}
</script>

<style scoped>

</style>
