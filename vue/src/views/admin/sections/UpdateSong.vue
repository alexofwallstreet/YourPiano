<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="toggleModalCallback()">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                         leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"/>
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300"
                         enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                         leave-from="opacity-100 translate-y-0 sm:scale-100"
                         leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <form @submit.prevent="updateSong"
                class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start w-full">
                <div
                  class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                  <MusicNoteIcon class="h-6 w-6 text-indigo-600" aria-hidden="true"/>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                  <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">Редактировать песню
                  </DialogTitle>
                  <div class="mt-2">
                    <div class="rounded-md shadow-sm -space-y-px">
                      <div class="py-2">
                        <label class="block text-sm font-medium text-gray-700" for="title">Название песни:</label>
                        <input id="title" name="title" type="text" autocomplete="title" required="" v-model="song.title"
                               class="appearance-none relative block w-full px-3 py-2 border
                               border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mt-1
                               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Название песни"/>
                      </div>
                      <div class="py-2">
                        <label class="block text-sm font-medium text-gray-700" for="author">Автор песни:</label>
                        <input id="author" name="author" type="text" autocomplete="author" required=""
                               v-model="song.author"
                               class="appearance-none relative block w-full px-3 py-2 border
                               border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mt-1
                               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Автор песни"/>
                      </div>
                      <div class="py-2">
                        <label class="block text-sm font-medium text-gray-700" for="description">Описание песни:</label>
                        <textarea id="description" name="description" type="text" autocomplete="description" required=""
                                  v-model="song.description" rows="10"
                                  class="appearance-none relative block w-full px-3 py-2 border
                               border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mt-1
                               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                  placeholder="Описание песни"> </textarea>
                      </div>
                      <div class="py-2">
                        <label class="block text-sm font-medium text-gray-700" for="difficulty_level_id">Уровень сложности:</label>
                        <div class="relative w-full flex items-center">
                          <input id="difficulty_level_id" name="difficulty_level_id" type="number" max="3" min="1"
                                 autocomplete="difficulty_level_id" required="" v-model="song.difficulty_level_id"
                                 class="appearance-none relative block w-1/2 px-3 py-2 border
                               border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mt-1
                               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                 placeholder="Уровень сложности"/>
                          <div class="absolute left-2 z-50">
                            <DifficultyLabel :level-id="song.difficulty_level_id"></DifficultyLabel>
                          </div>
                        </div>
                      </div>
                      <div class="py-2">
                        <label class="block text-sm font-medium text-gray-700" for="genre_id">Жанр песни:</label>
                        <div class="relative w-full flex items-center select-none">
                          <input id="genre_id" name="genre_id" type="number" max="8" min="1" autocomplete="genre_id"
                                 required="" v-model="song.genre_id"
                                 class="appearance-none relative block w-1/2 px-3 py-2 border
                               border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mt-1 text‑transparent
                               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                 placeholder="Уровень сложности"/>
                          <div class="absolute left-2 z-50">
                            <GenreLabel :genre-id="song.genre_id"></GenreLabel>
                          </div>
                        </div>
                      </div>
                      <div class="py-2">
                        <label class="block text-sm font-medium text-gray-700" for="genre_id">Максимальное количество очков:</label>
                        <div class="relative w-full flex items-center select-none">
                          <input id="rating_points" name="rating_points" type="number" max="100" min="1" autocomplete="genre_id"
                                 required="" v-model="song.rating_points"
                                 class="appearance-none relative block w-1/2 px-3 py-2 border
                               border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mt-1 text‑transparent
                               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                 placeholder="Количество очков"/>
                        </div>
                      </div>

                      <div class="py-2">
                        <label class="block text-sm font-medium text-gray-700">Обложка песни</label>
                        <div v-if="song.image_file_url" class="flex justify-center w-full h-24">
                          <img v-if="song.image_file_url" :src="song.image_file_url" alt="New Image"
                               class="h-full w-full object-cover">
                        </div>
                        <div v-else-if="item" class="flex justify-center w-full h-24">
                          <img v-if="item.imagePath" :src="item.imagePath" alt="New Image"
                               class="h-full w-full object-cover">
                        </div>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                          <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                              <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                              <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Загрузите обложку</span>
                                <input id="file-upload" @change="onImageChoose" name="file-upload" accept=".jpg, .jpeg, .png" type="file" class="sr-only" />
                              </label>
                              <p class="pl-1">или перетяните ее сюда</p>
                            </div>
                            <p class="text-xs text-gray-500">JPG, JPEG, PNG до 10MB</p>
                          </div>
                        </div>
                      </div>

                      <div class="py-2">
                        <label class="block text-sm font-medium text-gray-700">Midi файл</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                          <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                              <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                              <label for="midi-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Загрузите midi</span>
                                <input id="midi-upload" @change="onMidiChoose" name="midi-upload" accept=".mid" type="file" class="sr-only" />
                              </label>
                              <p class="pl-1">или перетяните сюда</p>
                            </div>
                            <p class="text-xs text-gray-500">MID до 10MB</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <ErrorMessage v-if="errorMsg">
              {{ errorMsg }}
              <span @click="errorMsg=''"
                    class="w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </span>
            </ErrorMessage>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex justify-end">
              <button type="submit"
                      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
              >Обновить
              </button>
              <button type="button"
                      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-500 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                      @click="toggleModalCallback()">Отмена
              </button>
            </div>
          </form>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import {onMounted, onUpdated, ref} from 'vue'
import {Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {MusicNoteIcon} from '@heroicons/vue/outline'
import store from "../../../store";
import ErrorMessage from "../../ui/ErrorMessage.vue";
import GenreLabel from "../../ui/GenreLabel.vue";
import DifficultyLabel from "../../ui/DifficultyLabel.vue";

const loading = ref(false);
let errorMsg = ref('');
let midiFileName = ref('');

const props = defineProps({
  open: false,
  title: String,
  item: Object,
  toggleModalCallback: Function
})

const song = ref({
  id: null,
  title: '',
  author: '',
  description: '',
  difficulty_level_id: 1,
  genre_id: 1,
  image_file: null,
  image_file_url: null,
  midi_file: null,
  rating_points: 100,
});

onUpdated(() => {
  song.value = {
    id: props.item?.id,
    title: props.item?.title,
    author: props.item?.author,
    description: props.item?.description,
    difficulty_level_id: props.item?.difficulty,
    genre_id: props.item?.genre,
    image_file: null,
    image_file_url: null,
    midi_file: null,
    rating_points: props.item?.ratingPoints,
  }
})

function updateSong() {
  loading.value = true;
  store.dispatch('updateSong', song)
    .then(() => {
      store.dispatch('getSongs').then(() => {
        props.toggleModalCallback();
        loading.value = false;
      })
    })
    .catch((err) => {
      errorMsg.value = 'Ошибка сох';
    })
}

function onImageChoose(ev) {
  const file = ev.target.files[0];
  const reader = new FileReader();
  reader.onload = () => {
    //the field to send on the backend and apply validation
    song.value.image_file = reader.result;
    //the field to display here
    song.value.image_file_url = reader.result;
  }
  reader.readAsDataURL(file);
}

function onMidiChoose(ev) {
  const file = ev.target.files[0];
  midiFileName.value = file.name;
  const reader = new FileReader();
  reader.onload = () => {
    //the field to send on the backend and apply validation
    song.value.midi_file = reader.result;
  }
  reader.readAsDataURL(file);
}
</script>

<style scoped>
input:a[type=number] {
  visibility: hidden;
}
</style>
