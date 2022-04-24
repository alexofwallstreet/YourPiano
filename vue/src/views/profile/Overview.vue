<template>
  <div v-if="stats.loading">
    <OverviewSkeleton></OverviewSkeleton>
  </div>
  <div v-else class="w-full mt-6">
    <div class="grid gap-6 mt-4 mb-6 md:grid-cols-2 xl:grid-cols-3">
      <div class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800">
        <div class="p-4 flex justify-center items-start">
          <div class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-orange-100 dark:bg-orange-500 mr-4">
            <HashtagIcon class="w-10 h-10"></HashtagIcon>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
              Место в рейтинге
            </p>
            <p class="text-4xl font-semibold text-gray-700 dark:text-gray-200">
              {{ stats.data.userPlace }}
            </p>
          </div>
        </div>
      </div>
      <div class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800">
        <div class="p-4 flex justify-center items-start">
          <div class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-orange-100 dark:bg-orange-500 mr-4">
            <ChartBarIcon class="w-10 h-10"></ChartBarIcon>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
              Набрано очков
            </p>
            <p class="text-4xl font-semibold text-gray-700 dark:text-gray-200">
              {{ stats.data.totalPoints }}
            </p>
          </div>
        </div>
      </div>
      <div class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800">
        <div class="p-4 flex justify-center items-start">
          <div class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-orange-100 dark:bg-orange-500 mr-4">
            <PlayIcon class="w-10 h-10"></PlayIcon>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
              Сыграно песен
            </p>
            <p class="text-4xl font-semibold text-gray-700 dark:text-gray-200">
              {{ stats.data.playedSongs }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <Table :users="stats.data.usersTop10"></Table>
  </div>

</template>

<script>
import { PlayIcon, ChartBarIcon, HashtagIcon } from '@heroicons/vue/solid'
import Table from "./TableTop10Users.vue";
import {computed} from "vue";
import store from "../../store";
import StatusLabel from "./StatusLabel.vue";
import OverviewSkeleton from "./skeleton/overview-skeleton.vue";

export default {
  name: "Overview",
  components: {OverviewSkeleton, StatusLabel, Table, PlayIcon, ChartBarIcon, HashtagIcon},
  setup() {
    const stats = computed(() => store.state.stats);
    return {
      stats
    }
  }
}
</script>

<style scoped>

</style>
