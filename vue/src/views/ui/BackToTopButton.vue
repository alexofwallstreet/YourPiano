<template>
  <div
    v-if="isVisible"
    ref="scrollTopButton"
    class="to-top-btn sticky w-full flex justify-center bottom-0 pb-3 px-5 lg:px-16 transition z-50 opacity-0 animate-fade-in-up"
  >
    <div
      class="text-white hover:text-indigo-200 transition"
    >
      <button @click="scrollToTop"
              class="bg-indigo-600 rounded-full p-4"
              role="button"
              aria-label="scroll to top of the page">
        <ArrowUpIcon class="h-10 w-10"></ArrowUpIcon>
      </button>
    </div>
  </div>
</template>


<script>
import {defineComponent, ref} from "vue";
import {ArrowUpIcon} from '@heroicons/vue/solid'

const isVisible = ref(false);

export default defineComponent({
  mounted() {
    this.isVisible = false;
    window.addEventListener("scroll", this.handleScroll);
  },

  beforeUnmount() {
    window.removeEventListener("scroll", this.handleScroll);
  },

  components: {
    ArrowUpIcon
  },

  data() {
    return {
      isVisible
    }
  },

  methods: {
    handleScroll() {
      this.isVisible = window.scrollY > 250;
    },
    scrollToTop() {
      window.scrollTo({top: 0, behavior: "smooth"});
    },
  },
});
</script>

<style scoped>
.to-top-btn {
  right: 100px;
}
</style>
