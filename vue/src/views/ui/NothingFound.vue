<template>
  <!-- Product grid -->
  <div class="lg:col-span-3">
    <!-- Replace with your content -->
    <div class="bg-white">
      <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:max-w-7xl lg:px-8">

        <div class="flex flex-col items-center justify-center font-medium opacity-0 animate-fade-in-down">
          <img src="/images/piano.svg" class="lg:w-1/4 w-1/2 -rotate-180" alt="">
          <div class="mt-6">
            {{ message }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "NothingFound",
  props: {
    message: String
  }
}
</script>

<style scoped>

</style>
