<template>
  <p :class="LEVELS[levelId]?.background + ' ' + LEVELS[levelId]?.text"
     class="inline-flex items-center px-3 py-px text-xs font-semibold tracking-wider text-white uppercase rounded-full"
  >{{ LEVELS[levelId]?.title }}
  </p>
</template>

<script>
import store from "../../store";

const LEVELS = {
  1: {title: "Простой", background: "bg-green-100", text: "text-green-900"},
  2: {title: "Средний", background: "bg-yellow-100", text: "text-yellow-900"},
  3: {title: "Сложный", background: "bg-red-100", text: "text-red-900"},
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
