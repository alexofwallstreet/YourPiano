<template>
  <UpdatePhotoModal :open="modalOpen" :toggle-func="toggleModal"></UpdatePhotoModal>
  <div>
    <main class="profile-page">
      <section class="relative block h-64">
        <div class="relative top-0 w-full h-full bg-center bg-indigo-50">
        </div>
        <div
          class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
          style="height: 70px;"
        >
        </div>
      </section>
      <section class="relative py-16">
        <div class="container mx-auto px-4">
          <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">

            <div class="lg:w-8/12 lg:mx-auto mb-8">
              <header class="flex flex-wrap flex-col justify-center items-center p-4 md:py-8">
                <div class="inline-flex flex-col relative">
                  <img class="relative w-20 h-20 md:w-40 md:h-40 object-cover rounded-full
                     border-2 border-indigo-600 p-1"
                       :src="store.state.user.data.imagePath"
                       alt="profile">
                  <div
                    @click="toggleModal"
                    class="absolute cursor-pointer hover:bg-indigo-700 right-0 bottom-0
                    flex justify-center items-center w-6 h-6 md:w-10 md:h-10 bg-indigo-500 rounded-full">
                    <PencilIcon class="w-4 h-4 md:w-7 md:h-7 stroke-indigo-50 "></PencilIcon>
                  </div>
                </div>

                <!-- profile meta -->
                <div class="w-8/12 md:w-7/12 mt-6">
                  <h2 class="text-3xl font-light sm:mb-0 text-center">
                    {{ store.state.user.data.name }}
                  </h2>
                  <!-- user meta form medium screens -->
                  <div class="hidden md:block mb-4 mt-1">
                    <h1 class="font-semibold text-center">{{ store.state.user.data.email }}</h1>
                  </div>

                </div>
              </header>

              <!-- posts -->
              <div class="px-px md:px-3">

                <!-- insta freatures -->
                <ul class="flex items-center justify-around md:justify-center space-x-12
                    uppercase tracking-widest font-semibold text-xs text-gray-600
                    border-t">
                  <!-- posts tab is active -->
                  <li :class="$route.name === 'ProfileOverview' ? 'md:border-t md:border-gray-700 md:-mt-px md:text-gray-700' : ''">
                    <router-link :to="{name: 'ProfileOverview'}" class="inline-block p-3" href="#">
                      <i class="fas fa-th-large text-xl md:text-xs"></i>
                      <span class="hidden md:inline">мой рейтинг</span>
                    </router-link>
                  </li>
                  <li :class="$route.name === 'ProfileLikes' ? 'md:border-t md:border-gray-700 md:-mt-px md:text-gray-700' : ''">
                    <router-link :to="{name: 'ProfileLikes'}"  class="inline-block p-3" href="#">
                      <i class="far fa-square text-xl md:text-xs"></i>
                      <span class="hidden md:inline">мои лайки</span>
                    </router-link>
                  </li>
                </ul>
                <!-- flexbox grid -->
                <div class="flex flex-wrap justify-center w-full">
                  <router-view></router-view>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>
import { PencilIcon } from '@heroicons/vue/outline'
import {ref} from 'vue';
import store from "../store";
import UpdatePhotoModal from "./profile/UpdatePhotoModal.vue";
const modalOpen = ref(false);

function toggleModal() {
  modalOpen.value = !modalOpen.value;
  console.log(modalOpen.value);
}

</script>

<style scoped>

</style>
