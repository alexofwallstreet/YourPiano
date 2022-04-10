<template>
  <div class="flex justify-center w-full">
    <SongList :songs="songs" v-if="songs.data.length > 0">
      <Pagination :links="songs.links" :get-for-page="getForPage"></Pagination>
    </SongList>
    <NothingFound v-else message="У вас нет понравившихся песен."></NothingFound>
  </div>
</template>

<script>
import SongList from "../sections/SongList.vue";
import Pagination from "../ui/Pagination.vue";
import NothingFound from "../ui/NothingFound.vue";
import SongListSkeleton from "../ui/skeletons/song-list-skeleton.vue";
import {ref, computed} from "vue";
import store from "../../store";
export default {
  name: "Likes",
  components: {
    SongList, NothingFound, Pagination, SongListSkeleton
  },
  setup() {
    const songs = computed(() => store.state.songs);
    store.dispatch('getLikedSongs');

    function getForPage(link) {
      if (!link.url || link.active) {
        return;
      }
      store.dispatch('getLikedSongs', {url: link.url});
    }

    return {
      store,
      songs,
      getForPage,
    }
  }
}
</script>

<style scoped>

</style>
