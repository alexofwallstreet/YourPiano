<template>
  <div id="home">

    <div className="lg:flex justify-between items-center mb-6 opacity-0 animate-fade-in-right">
      <p className="text-gray-600 text-2xl font-extrabold">
        {{greetingMessage()}}, {{ user.data.name }}!
      </p>
    </div>

    <div v-if="stats.loading" class="h-80 bg-slate-200 animate-pulse"></div>

    <div v-else className="flex flex-wrap -mx-3 mb-20 opacity-0 animate-fade-in-down">
      <div className="w-1/2 xl:w-1/4 px-3 h-64">
        <div className="w-full h-full bg-white border text-blue-400 rounded-lg flex flex-col items-center p-6 mb-6 xl:mb-0">
          <MusicNoteIcon className="w-16 h-16 fill-current mr-4 hidden lg:block" ></MusicNoteIcon>
          <div className="text-gray-700">
            <p className="font-extrabold text-3xl text-center">{{ stats.data.songsCount }}</p>
            <p class="text-center">Всего песен</p>
          </div>

        </div>
      </div>

      <div className="w-1/2 xl:w-1/4 px-3 h-64">
        <div className="w-full h-full bg-white border text-blue-400 rounded-lg flex flex-col items-center p-6 mb-6 xl:mb-0">
          <UsersIcon className="w-16 h-16 fill-current mr-4 hidden lg:block" ></UsersIcon>
          <div className="text-gray-700">
            <p className="font-extrabold text-center  text-3xl">{{ stats.data.usersCount }}</p>
            <p class="text-center">Всего пользователей</p>
          </div>
        </div>
      </div>

      <div className="w-1/2 xl:w-1/4 px-3 h-64">
        <div className="w-full h-full bg-white border text-blue-400 rounded-lg flex flex-col items-center p-6">
          <PlayIcon className="w-16 h-16 fill-current mr-4 hidden lg:block" ></PlayIcon>
          <div className="text-gray-700">
            <p className="font-extrabold text-center text-3xl">{{ stats.data.totalRatingPlays }}</p>
            <p class="text-center">Всего сыграно раз</p>
          </div>
        </div>
      </div>

      <div className="w-1/2 xl:w-1/4 px-3 h-64">
        <div className="w-full h-full bg-white border text-blue-400 rounded-lg flex flex-col items-center p-6">
          <ChartSquareBarIcon ></ChartSquareBarIcon>
          <div className="text-gray-700">
            <p className="font-extrabold text-center text-3xl">{{ stats.data.totalRatingPoints }}</p>
            <p class="text-center">Всего очков набрано</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { PlayIcon, UsersIcon, MusicNoteIcon, ChartSquareBarIcon } from '@heroicons/vue/solid'
import store from "../../store";
import {computed} from "vue";
const user = computed(() => store.state.user);

const stats = computed(() => store.state.adminStats);
store.dispatch('getAdminStats');

function greetingMessage() {
  const hours = new Date().getHours();
  switch (true) {
    case (hours > 5 && hours <= 11):
      return 'Доброее утро';
    case (hours > 11 && hours <= 16):
      return 'Добрый день';
    case (hours > 16 && hours <= 22):
      return 'Добрый вечер';
    default:
      return 'Доброй ночи';
  }
}
</script>
