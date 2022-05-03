<template>
  <div id="home">

    <div class="lg:flex justify-between items-center mb-6 opacity-0 animate-fade-in-right">
      <p class="text-gray-800 text-4xl font-extrabold">
        {{greetingMessage()}}, <span class="drop-shadow text-5xl text-gray-600">{{ user.data.name }}</span>!
      </p>
    </div>

    <div v-if="stats.loading" class="h-80 bg-slate-200 animate-pulse"></div>

    <div v-else class="flex flex-wrap -mx-3 mb-20 opacity-0 animate-fade-in-down">
      <div class="w-1/2 xl:w-1/4 px-3 h-64 mt-4">
        <div class="w-full h-full bg-white border text-blue-400 rounded-lg flex flex-col items-center p-6 mb-6 xl:mb-0">
          <MusicNoteIcon ></MusicNoteIcon>
          <div class="text-gray-700">
            <p class="font-extrabold text-6xl text-center">{{ formatNumber(stats.data.songsCount) }}</p>
            <p class="text-center">Песен</p>
          </div>

        </div>
      </div>

      <div class="w-1/2 xl:w-1/4 px-3 h-64 mt-4">
        <div class="w-full h-full bg-white border text-blue-400 rounded-lg flex flex-col items-center p-6 mb-6 xl:mb-0">
          <UsersIcon></UsersIcon>
          <div class="text-gray-700">
            <p class="font-extrabold text-center  text-6xl">{{ formatNumber(stats.data.usersCount) }}</p>
            <p class="text-center">Пользователей</p>
          </div>
        </div>
      </div>

      <div class="w-1/2 xl:w-1/4 px-3 h-64 mt-4">
        <div class="w-full h-full bg-white border text-blue-400 rounded-lg flex flex-col items-center p-6">
          <PlayIcon></PlayIcon>
          <div class="text-gray-700">
            <p class="font-extrabold text-center text-6xl">{{ formatNumber(stats.data.totalRatingPlays) }}</p>
            <p class="text-center">Сыграно раз</p>
          </div>
        </div>
      </div>

      <div class="w-1/2 xl:w-1/4 px-3 h-64 mt-4">
        <div class="w-full h-full bg-white border text-blue-400 rounded-lg flex flex-col items-center p-6">
          <ChartSquareBarIcon ></ChartSquareBarIcon>
          <div class="text-gray-700">
            <p class="font-extrabold text-center text-6xl">{{ formatNumber(stats.data.totalRatingPoints) }}</p>
            <p class="text-center">Очков набрано</p>
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

function formatNumber(number) {
  if (number > 1000) {
    return Number.parseInt(number / 1000) + 'k';
  }
  return number;
}
</script>
