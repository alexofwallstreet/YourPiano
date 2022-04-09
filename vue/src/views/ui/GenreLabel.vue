<template>
  <p class="inline-flex items-center px-3 py-px text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-indigo-600">
    {{genreName}}
  </p>
</template>

<script>
import store from "../../store";
export default {
  name: "GenreLabel",
  props: {
    genreId: Number
  },
  computed: {
    genreName() {
      return store.state.searchOptions.filters[0].options.find(filter => filter.value === this.genreId).label;
    }
  },
  setup() {
    return store;
  }
}
</script>

<style scoped>

</style>
