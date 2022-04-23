<template>
  <div id="like">
    <HeartIcon
      class="ong-control-btn h-12 w-12 rounded-full p-1 cursor-pointer relative animate-bounce"
      :class="{'fill-gray-300' : !isFavorite, 'fill-red-400' : isFavorite}"
    ></HeartIcon>
  </div>

</template>

<script>
import { HeartIcon } from '@heroicons/vue/solid'
export default {
  name: "LikeButton",
  components: {
    HeartIcon
  },
  props: {
    isFavorite: false
  }
}
</script>

<style scoped>
 #like svg path {
  stroke-dasharray: 100;
  animation: dash 5s linear;
}

@keyframes dash {
  to {
    stroke-dashoffset: 1000;
  }
}
</style>
