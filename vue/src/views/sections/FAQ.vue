<template>
  <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="max-w-xl sm:mx-auto lg:max-w-2xl">
      <SectionHeader></SectionHeader>
      <div class="space-y-4">
        <div class="border rounded shadow-sm" v-for="item in questions">
          <button type="button" aria-label="Open item" title="Open item" @click="item.isOpen = !item.isOpen"
                  class="flex items-center justify-between w-full p-4 focus:outline-none">
            <p class="text-lg font-medium">{{ item.question }}</p>
            <div class="flex items-center justify-center w-8 h-8 border rounded-full">
              <!-- Add "transform rotate-180" classes on svg, if is ope" -->
              <svg viewBox="0 0 24 24" class="w-3 text-gray-600 transition-transform duration-200"
                   :class="{'transform rotate-180': item.isOpen}">
                <polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-miterlimit="10" points="2,7 12,17 22,7" stroke-linejoin="round"></polyline>
              </svg>
            </div>
          </button>
          <div class="p-4 pt-0" v-if="item.isOpen"><p class="text-gray-700">{{ item.answer }}</p></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SectionHeader from "../ui/SectionHeader.vue";

const questions = [
  {
    question: "1 The quick, brown fox jumps over a lazy dog?",
    answer: "1 Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque rem aperiam, eaque ipsa quae",
    isOpen: false
  },
  {
    question: "2 The quick, brown fox jumps over a lazy dog?",
    answer: "2 Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque rem aperiam, eaque ipsa quae",
    isOpen: false
  },
  {
    question: "3 The quick, brown fox jumps over a lazy dog?",
    answer: "3 Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque rem aperiam, eaque ipsa quae",
    isOpen: false
  },
];

export default {
  data() {
    return {
      questions
    }
  },
  components: {SectionHeader}

};


</script>

<style scoped>

</style>
