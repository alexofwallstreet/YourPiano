<template>
    <span class="relative inline-block px-3 py-1 font-semibold leading-tight" :class="STATUSES[status]?.text">
      <span aria-hidden class="absolute inset-0 opacity-50 rounded-full" :class="STATUSES[status]?.background"></span>
      <span class="relative">{{ STATUSES[status]?.title }}</span>
    </span>
</template>

<script>
const STATUSES = {
  0: {title: "Новичок", background: "bg-green-200", text: "text-green-900"},
  1: {title: "Любитель", background: "bg-red-200", text: "text-red-900"},
  2: {title: "Профи", color: "bg-orange-200", text: "text-orange-900"},
  3: {title: "Маэстро", color: "bg-indigo-200", text: "text-indigo-900"},
}
export default {
  name: "StatusLabel",
  props: {
    status: String
  },
  data() {
    return {
      STATUSES
    }
  }
}
</script>

<style scoped>

</style>
