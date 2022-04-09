<template>
  <p class="inline-flex items-center px-3 py-px text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-indigo-600">
    {{levelName}}
  </p>
</template>

<script>
import store from "../../store";
export default {
  name: "DifficultyLabel",
  computed: {
    levelName() {
      return store.state.searchOptions.filters[1].options.find(filter => filter.value === this.levelId).label;
    }
  },
  props: {
    levelId: Number
  }
}
</script>

<style scoped>

</style>
