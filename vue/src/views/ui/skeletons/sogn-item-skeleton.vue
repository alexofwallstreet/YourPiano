<template>
  <div class="lg:w-4/5 mx-auto flex flex-wrap animate-pulse">
    <div class="lg:w-1/2 w-full lg:h-96 min-h-64 object-cover object-center rounded bg-slate-200 opacity-0 animate-fade-in-down"></div>
    <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0 opacity-0 animate-fade-in-down">
      <div v-for="i in 10" class="h-2 bg-slate-200 rounded mb-3"></div>
      <div v-for="i in 2" class="h-2 w-1/2 bg-slate-200 rounded mb-3"></div>
      <p class="leading-relaxed"></p>
      <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
        <div class="flex ml-6 items-center">
          <span class="mr-3"></span>
        </div>
      </div>
      <div class="flex">
        <div class="flex text-white bg-slate-200 border-0 py-2 px-6 w-16 focus:outline-none hover:bg-slate-200 rounded">
        </div>
        <div class="flex text-white bg-slate-200 border-0 py-2 px-6 mx-2 w-16 focus:outline-none hover:bg-slate-200 rounded">
        </div>
        <div
          class="rounded-full ml-auto w-10 h-10 bg-slate-200 p-0 border-0 inline-flex items-center justify-center text-gray-500">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "song-item-skeleton"
}
</script>

<style scoped>

</style>
