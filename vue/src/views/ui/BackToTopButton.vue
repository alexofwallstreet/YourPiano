<template>
  <div
    v-if="isVisible"
    ref="scrollTopButton"
    class="to-top-btn fixed w-screen flex justify-center bottom-0 transition z-50 opacity-0 bg-transparent"
    :class="isVisible ? 'animate-fade-in-up' : 'animate-fade-out-down'"
  >
    <div
      class="text-white hover:text-indigo-400 transition absolute bottom-10 transition-all"
      style="right: 10%"
    >
      <button
        @click="scrollToTop"
        class="animate-bounce inline-flex items-center px-4 py-4 mt-16 font-medium text-indigo-600 bg-indigo-500 rounded-full hover:bg-indigo-400 transition-all"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="flex-shrink-0 w-4 h-4 -rotate-90 stroke-white"
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M14 5l7 7m0 0l-7 7m7-7H3"/>
        </svg>
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
      this.isVisible = window.scrollY > 500;
    },
    scrollToTop() {
      window.scrollTo({top: 0, behavior: "smooth"});
    },
  },
});
</script>

<style scoped>
</style>
