<template>
  <div v-if="isLoading"
       class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-30 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
    <div class="loader ease-linear rounded-full border-4 border-t-4 border-indigo-100 h-12 w-12 mb-4  border-t-indigo-500"></div>
    <h2 class="text-center text-white text-xl font-extrabold mb-3">Загрузка...</h2>
  </div>
</template>

<script>
export default {
  name: "SpinnerOverlay",
  props: {
    isLoading: Boolean
  }
}
</script>

<style scoped>
.loader {
  animation: spinner 1.5s linear infinite;
}

@-webkit-keyframes spinner {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
