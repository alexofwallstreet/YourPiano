<template>
  <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20 my-12">
    <div class="max-w-xl sm:mx-auto lg:max-w-2xl">
      <SectionHeader
        :label="'вопросы/ответы'"
        :title="'Часто задаваемые вопросы'"
      ></SectionHeader>
      <div class="space-y-4">
        <div class="border rounded shadow-sm" v-for="item in questions">
          <div type="button" aria-label="Open item" title="Open item" @click="item.isOpen = !item.isOpen"
                  class="flex cursor-pointer items-center justify-between w-full p-4 focus:outline-none rounded-xl">
            <div>
              <p class="text-left text-lg font-medium ">{{ item.question }}</p>
            </div>

            <div>
              <div class="flex items-center justify-center w-8 h-8 border rounded-full">
                <svg viewBox="0 0 24 24" class="w-3 text-gray-600 transition-transform duration-200"
                     :class="{'transform rotate-180': item.isOpen}">
                  <polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-miterlimit="10" points="2,7 12,17 22,7" stroke-linejoin="round"></polyline>
                </svg>
              </div>
            </div>
          </div>
          <div class="p-4 pt-0 opacity-0 animate-fade-in-down" v-if="item.isOpen"><p class="text-gray-700">{{ item.answer }}</p></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SectionHeader from "../ui/SectionHeader.vue";

const questions = [
  {
    question: "Это бесплатно?",
    answer: "Приложение является абсолютно бесплатным, разработано в качестве дипломного проекта для университета.",
    isOpen: false
  },
  {
    question: "Я могу научиться играть на фортепиано с помощью приложения?",
    answer: "Тут все зависит от вас! Прилагая должные усилия, вы сможете научиться играть любую песню на сайте. Для этого предназначен режим «Обучения», доступный для каждой песни.",
    isOpen: false
  },
  {
    question: "Как начисляются очки за песню?",
    answer: "За каждую песню предусмотрено максимальное количество очков, которое может набрать пользователь. В зависимости от правильности игры происходит рассчет.",
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
