<template>
  <AddModal :open="isAddModalOpen" :toggle-modal-callback="toggleAddModal"></AddModal>
  <UpdateModal :open="isUpdateModalOpen" :item="currentSong" :toggle-modal-callback="toggleUpdateModal"></UpdateModal>
  <DeleteModal
    :open="isDeleteModalOpen "
    :item="currentSong"
    :toggle-modal-callback="toggleDeleteModal"
    :title="'Вы уверены, что хотите удалить песню ' + currentSong?.title + ' и все результаты, связанные с ней?'"
    :delete-callback="deleteSong"
  ></DeleteModal>

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
                 placeholder="Введите название песни или ее автора"/>
        </div>

        <div class="flex">
          <button
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm mb-5 px-4 py-2 mx-1 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm"
            type="button"
            @click="toggleAddModal()"
          >Добавить новую песню
          </button>
        </div>


        <div class="inline-block min-w-full shadow rounded-xl overflow-hidden animate-fade-in-down">
          <div v-if="songs.loading" class="p-12 flex justify-center h-screen w-full bg-slate-200 animate-pulse">
            <LoadingSpinner class="w-24 h-24"></LoadingSpinner>
          </div>
          <table v-else class="min-w-full leading-normal animate-fade-in-down">
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
            <tr v-for="(song, i) of songs.data" :key="i">
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <div class="flex items-center">
                  <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                      {{ song.id }}
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <div class="flex items-center">
                  <div class="flex-shrink-0 w-20 h-20 mr-4">
                    <img class="w-full h-full object-cover rounded-xl"
                         :src="song.imagePath"
                         alt=""/>
                  </div>
                  <div class="ml-3">
                    <p class="text-gray-900 text-xl whitespace-no-wrap">
                      {{ song.title }}
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 text-lg whitespace-no-wrap">
                  {{ song.author }}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <button
                  @click="toggleUpdateModal(song)"
                  class="w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm"
                  type="button"
                >Изменить
                </button>

                <button
                  @click="currentSong = song; toggleDeleteModal()"
                  class="w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                  type="button"
                >Удалить
                </button>
              </td>
            </tr>
            </tbody>
          </table>
          <Pagination :links="songs.links" :get-for-page="getForPage"></Pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {SearchIcon} from '@heroicons/vue/solid'
import {computed, ref} from "vue";
import store from "../../store";
import Pagination from "../ui/Pagination.vue";
import LoadingSpinner from "../ui/LoadingSpinner.vue";
import AddModal from "./sections/AddSong.vue";
import UpdateModal from './sections/UpdateSong.vue';
import DeleteModal from "./sections/DeleteModal.vue";

const search = ref('');
const isUpdateModalOpen = ref(false);
const isAddModalOpen = ref(false);
const isDeleteModalOpen = ref(false);

const currentSong = ref(null);

const option = store.state.searchOptions.sorting.find(option => option.value === 'oldest');
store.commit('updateSortingOrder', option);

const songs = computed(() => store.state.songs);
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

function toggleDeleteModal() {
  isDeleteModalOpen.value = !isDeleteModalOpen.value;
}

function toggleUpdateModal(song) {
  currentSong.value = song;
  isUpdateModalOpen.value = !isUpdateModalOpen.value;
}

function toggleAddModal() {
  isAddModalOpen.value = !isAddModalOpen.value;
}

function deleteSong() {
  store.dispatch('deleteSong', currentSong).then(() => {
    isDeleteModalOpen.value = false;
  });
}
</script>

<style scoped>

</style>

