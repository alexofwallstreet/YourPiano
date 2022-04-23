<template>
  <p v-if="mode===0"
    class="inline-block text-md font-extrabold tracking-wider text-white uppercase rounded-full bg-green-600 "
  >
    <CheckCircleIcon class="h-10 w-10"></CheckCircleIcon>
  </p>
  <p v-else
    class="inline-block px-5 py-2 text-md font-extrabold tracking-wider text-white rounded-r-2xl bg-green-200"
  >
    <span v-if="userPoints" class="text-2xl text-green-900">{{userPoints}}/{{songPoints}} <span class="text-sm font-medium">набрано очков</span></span>
    <span v-else class="text-2xl text-green-900">Вы еще не играли эту песню</span>
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

</style>
