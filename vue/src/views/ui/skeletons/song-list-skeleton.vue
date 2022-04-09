<template>

  <div class="lg:col-span-3 animate-pulse w-full">
    <div class="bg-white ">
      <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:max-w-7xl lg:px-8 ">
        <div
          class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
          <div v-for="i in 8" class="opacity-0 animate-fade-in-down" :style="{animationDelay: `${i * 0.5}ms`}">
            <div
              class="w-full aspect-w-1 aspect-h-1 bg-slate-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
            </div>
            <div  class="h-2 mt-5 text-sm bg-slate-200 rounded"></div>
            <div  class="h-3 mt-2 text-sm bg-slate-200 rounded"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "song-list-skeleton"
}
</script>

<style scoped>

</style>
