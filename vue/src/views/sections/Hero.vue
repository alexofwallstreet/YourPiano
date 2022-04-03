<template>
  <div class="bg-indigo-50">
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
      <div class="grid gap-10 lg:grid-cols-2">
        <div class="lg:pr-10">
          <h1 class="text-4xl font font-extrabold tracking-tight text-gray-900 sm:text-6xl">
            Научитесь играть
            <wbr class="hidden md:block"/>
            на фортепиано онлайн
          </h1>
          <p class="mb-6 mt-6 text-xl text-gray-500">
            Обучайтесь игре на фортепиано вместе с YourPiano! Это весело и увлекательно, зарабатывайте очки за каждую
            сыгранную песню, разучивайте новые песни
          </p>
          <div class="flex items-center space-x-4">
            <router-link :to="{name: 'PianoFreePlay'}"
                         class="inline-block text-center bg-indigo-600 border border-transparent rounded-md py-3 px-8 font-medium text-white hover:bg-indigo-700">
              Начать играть
            </router-link>
            <router-link :to="{name: 'Login'}"
                         class="inline-block text-center bg-indigo-400 border border-transparent rounded-md py-3 px-8 font-medium text-white hover:bg-indigo-700">
              Войти
            </router-link>
          </div>
        </div>
        <div>
          <img class="object-contain w-full h-56 rounded sm:h-96" src="/images/promo.svg" alt=""/>
        </div>
      </div>
    </div>
  </div>
  <svg class="relative top-0 w-full h-6 -mt-5 sm:-mt-10 sm:h-16 rotate-180 z-10" preserveAspectRatio="none"
       viewBox="0 0 1440 54">
    <path class="fill-indigo-50"
          d="M0 22L120 16.7C240 11 480 1.00001 720 0.700012C960 1.00001 1200 11 1320 16.7L1440 22V54H1320C1200 54 960 54 720 54C480 54 240 54 120 54H0V22Z"></path>
  </svg>
</template>

<script>
export default {
  name: "Hero"
}
</script>

<style scoped>

</style>
