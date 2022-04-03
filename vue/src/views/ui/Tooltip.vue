<template>
  <div class="absolute top-0 bottom-0 right-2 cursor-help inline-flex flex-col items-center justify-center group ">
    <svg class="w-5 h-5 fill-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
    </svg>
    <div class="absolute bottom-0 right-0 w-60 p-2 flex items-center justify-between hidden mb-6 group-hover:flex opacity-0 animate-fade-in-down">
      <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-indigo-500 shadow-lg rounded">{{ text }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "Tooltip",
  props: {
    text: String
  }
}
</script>

<style scoped>
.tooltip:hover .tooltip-item {
  visibility: visible;
}
</style>
