<template>
  <div
    class="relative flex flex-col-reverse px-4 py-16 mx-auto lg:block lg:flex-col lg:py-32 xl:py-48 md:px-8 sm:max-w-xl md:max-w-full bg-white">
    <div
      class="animate-fade-in-right z-0 flex justify-center h-full -mx-4 overflow-hidden lg:pt-24 lg:pb-16 lg:pr-8 xl:pr-0 lg:w-1/2 lg:absolute lg:justify-end lg:bottom-0 lg:left-0 lg:items-center">
      <img src="/images/laptop.svg" class="object-cover object-right w-full h-auto lg:w-auto lg:h-full" alt=""/>
    </div>
    <div class="animate-fade-in-left relative flex justify-end max-w-xl mx-auto xl:pr-32 lg:max-w-screen-xl">
      <div class="mb-16 lg:pr-5 lg:max-w-lg lg:mb-0">
        <SectionHeader
          :label="'о сайте'"
          :title="'Только клавиатура и ничего лишнего'"
          :content="'Учитесь играть свои любимые песни на фортепиано, достаточно лишь вашего ноутбука или компьютера! Может у вас есть midi-клавиатура? Отличная новость, вы можете использовать и ее!'"
        ></SectionHeader>
        <div class="flex flex-wrap justify-center gap-4 mt-8">
          <router-link
            class="block w-full px-12 py-3 text-sm font-medium text-white border bg-indigo-600 text-center
              border-blue-600 rounded xs:w-auto hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring"
            :to="{name: 'About'}">
            Узнать больше
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SectionHeader from "../ui/SectionHeader.vue";

export default {
  components: {SectionHeader}
}
</script>
