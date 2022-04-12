<template>
  <div class="py-8 rounded-md w-full">
    <div class="flex items-center justify-center opacity-0 animate-fade-in-up">
      <h2 class="text-gray-600 text-3xl font-extrabold">Песни YourPiano</h2>
    </div>
    <div class="w-full opacity-0 animate-fade-in-down">
      <div class="py-4 overflow-x-auto w-full">

        <div class="relative my-2 p-0.5">
          <SearchIcon class="absolute h-5 w-5 top-0 bottom-0 my-auto ml-4"></SearchIcon>
          <input @change="getSongs" v-model="search" type="text" name="search" id="search"
                 class="focus:ring-indigo-500 focus:border-indigo-500 block shadow
                 w-full h-12 pl-12 pr-12 sm:text-sm border-gray-300 rounded-lg"
                 placeholder="Введите название песни или ее автора" />
        </div>

        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
          <div v-if="users.loading" class="p-12 flex justify-center h-96 w-full bg-slate-200 animate-pulse">
            <LoadingSpinner></LoadingSpinner>
          </div>
          <table v-else class="min-w-full leading-normal">
            <thead>
            <tr>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                ID
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Название
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Автор
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Действия
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, i) of users.data" :key="i">
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <div class="flex items-center">
                  <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                      {{ user.id }}
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <div class="flex items-center">
                  <div class="flex-shrink-0 w-10 h-10">
                    <img class="w-full h-full rounded-full object-cover"
                         :src="user.imagePath"
                         alt=""/>
                  </div>
                  <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                      {{user.title}}
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{user.author}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <button
                  class="w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm"
                  type="button"
                >Изменить
                </button>

                <button
                  class="w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                  type="button"
                >Удалить
                </button>
              </td>
            </tr>
            </tbody>
          </table>
          <Pagination :links="users.links" :get-for-page="getForPage"></Pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { SearchIcon } from '@heroicons/vue/solid'
import {computed, ref} from "vue";
import store from "../../store";
import Pagination from "../ui/Pagination.vue";
import LoadingSpinner from "../ui/LoadingSpinner.vue";

const search = ref('');

const users = computed(() => store.state.songs);
store.dispatch('getSongs');

function getForPage(link) {
  if (!link.url || link.active) {
    return;
  }
  store.dispatch('getSongs', {url: link.url, search: search.value});
}

function getSongs() {
  store.dispatch('getSongs', {search: search.value});
}
</script>

<style scoped>

</style>

