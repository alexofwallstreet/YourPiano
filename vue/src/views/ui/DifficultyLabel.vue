<template>
  <p class="inline-flex items-center px-3 py-px text-xs font-bold tracking-wider text-white uppercase rounded-full bg-indigo-600 ">
    {{LEVELS[levelId]}}
  </p>
</template>

<script>
import store from "../../store";
const LEVELS = {
  1: "Простой",
  2: "Средний",
  3: "Сложный",
}
let levelId;
export default {
  name: "DifficultyLabel",
  props: {
    levelId
  },
  data() {
    return {
      LEVELS
    }
  }
}
</script>

<style scoped>

</style>
