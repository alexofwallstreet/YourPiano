<template>
  <p v-if="mode===0"
    class="inline-block text-md font-extrabold text-xl
    tracking-wider text-white uppercase rounded-full
    bg-green-600 border-white border-2 circle flex justify-center items-center p-2"
  >
    {{userPoints}}
  </p>
  <p v-else
    class="inline-block px-5 py-2 text-md font-extrabold tracking-wider text-white rounded-r-2xl bg-green-500"
  >
    <span v-if="userPoints">
  <span  class="text-lg font-medium">Очков набрано: </span><span class="text-2xl text-white">{{userPoints}} из {{songPoints}} </span>
</span>
    <span v-else class="text-2xl text-white font-bold">Вы еще не играли эту песню</span>
  </p>
</template>

<script>
import {CheckCircleIcon} from '@heroicons/vue/solid';
let userPoints;
let songPoints;
export default {
  name: "UserScore",
  components: {
    CheckCircleIcon,
  },
  props: {
    userPoints,
    songPoints,
    mode: 0
  },
}
</script>

<style scoped>
.circle {
  min-width: 3rem;
  min-height: 3rem;
}
</style>
