<template>
  <p class="inline-flex items-center px-3 py-px text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-indigo-50 text-indigo-900">
    {{GENRES[genreId]}}
  </p>
</template>

<script>
const GENRES = {
  1: "Поп",
  2: "Рок",
  3: "Хип-хоп",
  4: "Рэп",
  5: "Электроника",
  6: "Классическая",
  7: "Джаз",
  8: "R&B",
}
let genreId;
export default {
  name: "GenreLabel",
  props: {
    genreId
  },
  data() {
    return {
      GENRES
    }
  }
}
</script>

<style scoped>

</style>
