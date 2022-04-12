<template>
  <div class="w-full mt-6 animate-pulse">
    <div class="grid gap-6 my-8 md:grid-cols-2 xl:grid-cols-3">
      <div v-for="i in 3" class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white">
        <div class="p-4 flex justify-center items-start">
          <div class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-slate-200 mr-4">
            <div class="w-10 h-10"></div>
          </div>
          <div>
            <div class="text-sm h-9 font-medium text-gray-600 dark:text-gray-400 rounded-full">
              <div class="w-32 h-6 bg-slate-200 rounded-full"></div>
            </div>
            <div class="text-4xl h-9 font-semibold text-gray-700 dark:text-gray-200 rounded-full">
              <div class="w-24 h-6 bg-slate-200 rounded-full"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-12 w-full h-6 bg-slate-200 rounded-full"></div>
    <div v-for="i in 10" class="mt-2 w-full h-12 bg-slate-200 rounded-full"></div>
  </div>

</template>

<script>
export default {
  name: "overview-skeleton"
}
</script>

<style scoped>

</style>
