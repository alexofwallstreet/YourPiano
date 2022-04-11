<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="toggleFunc">
      <form class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
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
          <div
            class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start w-full">
                <div
                  class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                  <PhotographIcon class="h-6 w-6 text-indigo-600" aria-hidden="true"/>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                  <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">Загрузите новое фото профиля</DialogTitle>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">Фотография не должна превышать размер 2МБ</p>
                    <div class="flex justify-center mt-4">
                      <img v-if="model.image_url" :src="model.image_url" alt="New Image"
                           class="h-24 w-24 object-cover rounded-full">
                    </div>
                    <div class="relative border-dotted mt-2 h-16 cursor-pointer rounded-lg border-dashed border-2 border-indigo-700 bg-gray-100 flex justify-center items-center">
                      <div class="absolute">
                        <div class="flex flex-col items-center"> <i class="fa fa-folder-open fa-4x text-blue-700"></i> <span class="block text-gray-400 font-normal">Прикрепите картинку сюда</span> </div>
                      </div>
                      <input
                        accept=".jpg, .jpeg, .png"
                        @change="onImageChoose"
                        type="file"
                        class="h-full w-full opacity-0 cursor-pointer"
                        name="file">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <div type="button"
                      class="cursor-pointer w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-400 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                      @click="toggleFunc">Отмена
              </div>
              <button
                :disabled="!isImageUpload"
                :class="isImageUpload ? '' : 'bg-indigo-200 hover:bg-indigo-200'"
                type="button"
                      class="flex justify-between items-center w-full mt-2 sm:mt-0 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                      @click.prevent="updatePhoto">
                <LockClosedIcon v-if="!loading" class="h-5 w-5 mr-3 text-indigo-500 group-hover:text-indigo-400 stroke-indigo-50"
                                aria-hidden="true"/>
                <svg v-else
                     class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Обновить</span>
              </button>

            </div>
          </div>
        </TransitionChild>
      </form>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import {ref} from 'vue'
import {Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {PhotographIcon, LockClosedIcon} from '@heroicons/vue/outline';
import store from "../../store";

const isImageUpload = ref(false);
const loading = ref(false);

// Create empty image
let model = ref({
  image: null,
  image_url: null,
});

function onImageChoose(ev) {
  const file = ev.target.files[0];
  const reader = new FileReader();
  reader.onload = () => {
    isImageUpload.value = true;
    //the field to send on the backend and apply validation
    model.value.image = reader.result;

    //the field to display here
    model.value.image_url = reader.result;
  }
  reader.readAsDataURL(file);
}

function updatePhoto() {
  loading.value = true;
  store.dispatch('updateUserImage', model.value.image)
    .then(() => {
      loading.value = false;
      isImageUpload.value = false;
      props.toggleFunc();
      model.value.image = null;
      model.value.image_url = null;
    })
}

const props = defineProps({
  open: false,
  toggleFunc: Function
})
</script>
