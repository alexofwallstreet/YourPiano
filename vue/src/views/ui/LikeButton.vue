<template>
  <div :class="{'heartbeat' : !isFavorite}">
    <HeartIcon
      id="like-icon"
      class="ong-control-btn h-12 w-12 rounded-full p-1 cursor-pointer relative"
      :class="{'fill-gray-300' : !isFavorite, 'fill-red-400' : isFavorite}"
    ></HeartIcon>
  </div>

</template>

<script>
import { HeartIcon } from '@heroicons/vue/solid'
import LoadingSpinner from "./LoadingSpinner.vue";
export default {
  name: "LikeButton",
  components: {
    LoadingSpinner,
    HeartIcon
  },
  props: {
    isFavorite: false
  }
}
</script>

<style scoped>
#like-icon {
  transition: all 0.5s ease;
}
.heartbeat {
  animation: gelatine 1s ease infinite;
}
 @keyframes gelatine {
   from, to {
     transform: scale(1, 1);
   }
   25% {
     transform: scale(0.9, 1.1);
   }
   50% {
     transform: scale(1.1, 0.9);
   }
   75% {
     transform: scale(0.95, 1.05);
   }
 }
</style>
