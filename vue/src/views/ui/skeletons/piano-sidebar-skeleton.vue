<template>
  <div class="menu px-2 pt-5 animate-pulse">
    <!-- End Toggle button with Arrows -->
    <div class="song-wrapper">
      <!-- Song Cover -->
      <div class="relative max-w-sm rounded-xl overflow-hidden shadow-lg w-full h-52 bg-slate-200" />
      <!-- Song Info -->
      <div class="pt-4">
        <div class="h-2 rounded w-1/2 font-bold text-sm text-blue-200 whitespace-nowrap bg-slate-200"/>
        <div class="h-4 rounded w-2/3 mt-2 font-bold text-xl mb-2 whitespace-nowrap bg-slate-200" />
      </div>

      <!-- Slider -->
      <div class="w-full h-2 bg-slate-200 rounded mt-5 mb-2"></div>

      <!-- Buttons -->
      <div class="pb-2 flex gap-1 justify-start items-center">
        <div class="h-8 w-8 relative bg-slate-200 rounded-full"/>

        <div class="h-8 w-8 relative bg-slate-200 rounded-full"/>

        <div class="h-8 w-8 relative bg-slate-200 rounded-full"/>

        <div class="flex justify-end ml-auto">
          <div class="h-8 w-8 relative bg-slate-200 rounded-full"/>
        </div>
      </div>

      <div class="mt-5">
        <div v-for="i in 4" class="w-full h-10 bg-slate-200 mb-4 rounded"/>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "piano-sidebar-skeleton"
}
</script>

<style scoped>

</style>
