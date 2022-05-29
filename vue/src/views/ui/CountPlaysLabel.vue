<template>
  <p
     class="bg-gray-100 text-gray-600 inline-block items-end px-3 py-px text-xs font-bold tracking-wider text-white uppercase rounded-full"
  ><span style="font-size: 8px">проигрываний: </span>{{count}}
  </p>
</template>

<script>
export default {
  name: "CountPlaysLabel",
  props: {
    count: 0
  }
}
</script>

<style scoped>

</style>
