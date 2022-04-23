<template>
  <p class="inline-flex items-center px-3 py-px text-xs font-bold tracking-wider text-white uppercase rounded-full bg-indigo-100 text-indigo-900">
    {{GENRES[genreId]}}
  </p>
</template>

<script>
import store from "../../store";
//            {label: 'Поп', value: 1, checked: false},
// {label: 'Рок', value: 2, checked: false},
// {label: 'Хип-хоп', value: 3, checked: false},
// {label: 'Рэп', value: 4, checked: false},
// {label: 'Электронная', value: 5, checked: false},
// {label: 'Классическая', value: 6, checked: false},
// {label: 'Джаз', value: 7, checked: false},
// {label: 'R&B', value: 8, checked: false},
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
