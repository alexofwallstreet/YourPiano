<template>
  <button @click="clickHandler"
          :class="{'heartbeat' : !isFavorite, 'click': click}"
          class="transition-all">
    <HeartIcon
      id="like-icon"
      class="ong-control-btn h-12 w-12 rounded-full p-1 cursor-pointer relative"
      :class="{'fill-gray-300' : !isFavorite, 'fill-red-400' : isFavorite}"
    ></HeartIcon>
  </button>

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
  data() {
    let click = false;
    return {
      click
    }
  },
  methods: {
    clickHandler() {
      this.click = true;
      setTimeout(() => this.click = false, 1000);
    }
  },
  props: {
    isFavorite: false,
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
.click {
  animation: onClick 0.5s ease-in;
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

@keyframes onClick {
  from, to {
    transform: scale(1, 1);
  }
  50% {
    transform: scale(0.7, 0.7);
    opacity: 0.8;
  }
  100% {
    transform: scale(1, 1);
  }
}
</style>
