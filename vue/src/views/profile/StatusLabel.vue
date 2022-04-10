<template>
    <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
      <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
      <span class="relative">{{ status }}</span>
    </span>
</template>

<script>
export default {
  name: "StatusLabel",
  props: {
    status: String
  }
}
</script>

<style scoped>

</style>
