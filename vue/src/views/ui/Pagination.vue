<template>
  <div class="flex justify-center mt-5">
    <nav class="relative z-0 inline-flex justify-center rounded-md shadow-sm" aria-label="pagination">
      <a
        v-for="(link, i) of links"
        :key="i"
        :aria-disabled="!link.url"
        href="#"
        @click="getForPage(link)"
        aria-current="page"
        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
        :class="[
                    link.active
                    ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                    i === 0 ? 'rounded-l-md' : '',
                    i === links.length - 1 ? 'rounded-r-md' : '',
                  ]"
      >
        <template v-if="link.label.includes('Next')"><ChevronRightIcon class="h-5 w-5" aria-hidden="true" /></template>
        <template v-else-if="link.label.includes('Prev')"><ChevronLeftIcon class="h-5 w-5" aria-hidden="true" /></template>
        <template v-else>{{ link.label }}</template>
      </a>
    </nav>
  </div>
</template>

<script>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
export default {
  name: "Pagination",
  components: {
    ChevronLeftIcon,
    ChevronRightIcon,
  },
  props: {
    links: Array,
    getForPage: Function
  }
}
</script>

<style scoped>

</style>
