<template>
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
          <router-link :to="{name: 'Piano'}"
                       class="inline-block text-center bg-indigo-600 border border-transparent rounded-md py-3 px-8 font-medium text-white hover:bg-indigo-700">
            Начать играть
          </router-link>
          <router-link :to="{name: 'Register'}"
                       class="inline-block text-center bg-indigo-400 border border-transparent rounded-md py-3 px-8 font-medium text-white hover:bg-indigo-700">
            Войти
          </router-link>
        </div>
      </div>
      <div>
        <img class="object-contain w-full h-56 rounded sm:h-96" src="/images/promo.png" alt=""/>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Hero"
}
</script>

<style scoped>

</style>
