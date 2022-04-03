<template>
  <div class="relative transition-all bg-gray-800 opacity-0 animate-fade-in-up -z-10" :class="isPianoPage() ? '' : 'mt-16'">
    <svg class="absolute top-0 w-full h-6 -mt-5 sm:-mt-10 sm:h-16 text-deep-purple-accent-400" preserveAspectRatio="none" viewBox="0 0 1440 54">
      <path fill="#1F2937" d="M0 22L120 16.7C240 11 480 1.00001 720 0.700012C960 1.00001 1200 11 1320 16.7L1440 22V54H1320C1200 54 960 54 720 54C480 54 240 54 120 54H0V22Z"></path>
    </svg>
    <div class="px-4 pt-12 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
      <div class="w-full flex justify-center mb-8">
        <router-link :to="{name: 'Home'}" aria-label="Go home" title="Company" class="inline-flex items-center">
          <img class="w-full h-full" src="/logo.svg" alt="YourPiano Logo"/>
        </router-link>
      </div>
      <div class="sm:flex-row pb-10">
        <p class="flex justify-center mb-3 text-lg text-gray-500">
          &copy; {{ new Date().getFullYear() }} Алексей Волчков. Все права защищены
        </p>

      </div>
    </div>
  </div>
</template>

<script>
import router from "../../router";

export default {
  name: "Footer",
  methods: {
    isPianoPage() {
      return router.currentRoute.value.name === "PianoFreePlay"
        || router.currentRoute.value.name === "PianoRatingPlay"
        || router.currentRoute.value.name === "PianoTutorialPlay";
    }
  }
}
</script>

<style scoped>

</style>
