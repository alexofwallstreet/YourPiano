<template>
  <LoadingSpinner class="h-7 w-7" v-if="loading"></LoadingSpinner>
    <div v-else-if="status" class="relative inline-block px-3 py-1 font-semibold leading-tight" :class="STATUSES[status]?.text">
      <span aria-hidden class="absolute inset-0 opacity-50 rounded-full" :class="STATUSES[status]?.background"></span>
      <span class="relative">{{ STATUSES[status]?.title }}</span>
    </div>
</template>

<script>
import store from "../../store";
import {computed} from "vue";
import LoadingSpinner from "../ui/LoadingSpinner.vue";
const STATUSES = {
  0: {title: "Новичок", background: "bg-green-200", text: "text-green-900"},
  1: {title: "Любитель", background: "bg-red-200", text: "text-red-900"},
  2: {title: "Профи", color: "bg-orange-200", text: "text-orange-900"},
  3: {title: "Маэстро", color: "bg-indigo-200", text: "text-indigo-900"},
}
export default {
  name: "StatusLabel",
  components: {LoadingSpinner},
  props: {
    status: String
  },
  data() {
    return {
      STATUSES,
      loading: computed(() => store.state.stats.loading),
    }
  }
}
</script>

<style scoped>

</style>
