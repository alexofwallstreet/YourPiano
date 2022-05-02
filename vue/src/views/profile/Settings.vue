<template>
  <DeleteModal
    :open="isDeleteResultsModalOpen"
    :toggle-modal-callback="toggleDeleteResultsModal"
    :delete-callback="deleteResult"
    :title="'Вы уверены, что хотите удалить все ваши результаты? Восстановить их будет невозможно'"
  ></DeleteModal>

  <DeleteModal
    :open="isDeleteAccountModalOpen"
    :toggle-modal-callback="toggleDeleteAccountModal"
    :delete-callback="deleteAccount"
    :title="'Вы уверены, что хотите удалить ваш аккаунт? Все данные и результаты будут потеряны'"
  ></DeleteModal>

  <div class="mt-12 opacity-0 animate-fade-in-down">
    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Профиль</h3>
            <p class="mt-1 text-sm text-gray-600">
              Информация, которая будет видна всем пользователям приложения YourPiano
            </p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <form @submit.prevent="update">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <ErrorMessage v-if="errorMsg">
                  {{ errorMsg }}
                  <span @click="errorMsg=''"
                        class="w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                       stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </span>
                </ErrorMessage>
                <SuccessMessage v-if="successMsg">
                  {{ successMsg }}
                  <span @click="successMsg=''"
                        class="w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                       stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </span>
                </SuccessMessage>
                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-3 sm:col-span-2">
                    <label for="first-name" class="block text-sm font-medium text-gray-700"> Имя пользователя </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                             v-model="updateModel.name"
                             class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                    </div>
                  </div>
                </div>

                <div>
                  <label for="email-address" class="block text-sm font-medium text-gray-700"> Электронная почта </label>
                  <div class="mt-1">
                    <input type="text" name="email-address" id="email-address" autocomplete="email"
                           v-model="updateModel.email"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700"> Фото профиля </label>
                  <div class="mt-1 flex items-center">
                  <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                     <img v-if="!loading" :src="updateModel.profile_photo_url ?? store.state.user.data.imagePath" alt="New Image"
                          class="h-full w-full object-cover">
                    <LoadingSpinner v-else class="w-12 h-12"></LoadingSpinner>
                  </span>
                    <input type="file" @change="onImageChoose"
                           class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"/>
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" :disabled="_.isEqual(startModel, updateModel)"
                        :class="_.isEqual(startModel, updateModel) ? 'bg-gray-300 cursor-not-allowed' : 'bg-indigo-600  hover:bg-indigo-700'"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <LockClosedIcon v-if="!loading" class="-ml-1 mr-3 h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                                  :class="_.isEqual(startModel, updateModel) ? 'fill-gray-50' : 'fill-indigo-300'"
                                  aria-hidden="true"/>
                  <svg v-else
                       class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                       xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Сохранить
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
      <div class="py-5">
        <div class="border-t border-gray-200"/>
      </div>
    </div>

    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Изменить пароль</h3>
            <p class="mt-1 text-sm text-gray-600">Рекомендуется как можно чаще менять пароль.</p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <form @submit.prevent="changePassword">
            <div class="shadow overflow-hidden sm:rounded-md">
              <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-6">
                    <ErrorMessage v-if="errorPasswordMsg">
                      {{ errorPasswordMsg }}
                      <span @click="errorPasswordMsg=''"
                            class="w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                       stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </span>
                    </ErrorMessage>
                    <SuccessMessage v-if="successPasswordMsg">
                      {{ successPasswordMsg }}
                      <span @click="successPasswordMsg=''"
                            class="w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                       stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </span>
                    </SuccessMessage>
                  </div>

                  <div class="col-span-6 sm:col-span-5">
                    <label for="old-password" class="block text-sm font-medium text-gray-700">Текущий пароль</label>
                    <input type="password" required name="old-password" id="old-password" autocomplete="given-name"
                           v-model="changePasswordModel.old_password"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                  </div>
                  <div class="col-span-6 sm:col-span-5">
                    <label for="new-password" class="block text-sm font-medium text-gray-700">Новый пароль</label>
                    <input type="password" required name="new-password" id="new-password" autocomplete="given-name"
                           v-model="changePasswordModel.new_password"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                  </div>
                  <div class="col-span-6 sm:col-span-5">
                    <label for="new-password-repeat" class="block text-sm font-medium text-gray-700">Повторите новый
                      пароль</label>
                    <input type="password" required name="new-password-repeat" id="new-password-repeat" autocomplete="given-name"
                           v-model="changePasswordModel.new_password_confirm"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Сохранить
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
      <div class="py-5">
        <div class="border-t border-gray-200"/>
      </div>
    </div>

    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Действия с аккаунтом</h3>
            <p class="mt-1 text-sm text-gray-600">
              Здесь можно очистить результаты профиля, удалить свой аккаунт
            </p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <form action="#" method="POST">
            <div class="shadow overflow-hidden sm:rounded-md">
              <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <fieldset>
                  <div class="py-3" v-if="successDeleteResultsMsg || errorDeleteResultsMsg">
                    <ErrorMessage v-if="errorDeleteResultsMsg">
                      {{ errorDeleteResultsMsg }}
                      <span @click="errorDeleteResultsMsg=''"
                            class="w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </span>
                    </ErrorMessage>
                    <SuccessMessage v-if="successDeleteResultsMsg">
                      {{ successDeleteResultsMsg }}
                      <span @click="successDeleteResultsMsg=''"
                            class="w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </span>
                    </SuccessMessage>
                  </div>
                  <legend class="text-base font-medium text-gray-900">Удалить все результаты</legend>
                  <p class="text-sm text-gray-600">
                    Удаление результатов приведет к тому, что все очки, набранные вами за сыгранные песни, будут удалены.
                  </p>
                  <div class="mt-1 space-y-4">
                    <div>
                      <div class="mt-2 flex items-center">
                        <button type="button" @click="toggleDeleteResultsModal"
                                class="bg-red-500 text-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Удалить результаты
                        </button>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <fieldset>
                  <div class="py-3" v-if="errorDeleteAccountMsg">
                    <ErrorMessage v-if="errorDeleteAccountMsg">
                      {{ errorDeleteAccountMsg }}
                      <span @click="errorDeleteAccountMsg=''"
                            class="w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </span>
                    </ErrorMessage>
                  </div>
                  <legend class="text-base font-medium text-gray-900">Удалить аккаунт</legend>
                  <p class="text-sm text-gray-600">
                    Удаление всех данных профиля, включая лайки и набранные очки.
                  </p>
                  <div class="mt-1 space-y-4">
                    <div>
                      <div class="mt-2 flex items-center">
                        <button type="button" @click="toggleDeleteAccountModal"
                                class="bg-red-500 text-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Удалить аккаунт
                        </button>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</template>


<script setup>
import store from "../../store";
import _ from 'lodash';
import {LockClosedIcon} from '@heroicons/vue/solid';
import {onMounted, ref} from "vue";
import ErrorMessage from "../ui/ErrorMessage.vue";
import SuccessMessage from "../ui/SuccessMessage.vue";
import DeleteModal from "../admin/sections/DeleteModal.vue";
import {useRouter} from "vue-router";
import LoadingSpinner from "../ui/LoadingSpinner.vue";

const router = useRouter();

const isImageUpload = ref(false);
const loading = ref(false);
const startModel = ref({});

const isDeleteResultsModalOpen = ref(false);
const isDeleteAccountModalOpen = ref(false);

let errorMsg = ref('');
let errorPasswordMsg = ref('');
let errorDeleteResultsMsg = ref('');
let errorDeleteAccountMsg = ref('');
let successMsg = ref('');
let successPasswordMsg = ref('');
let successDeleteResultsMsg = ref('');
let successDeleteAccountMsg = ref('');

// Create empty image
let updateModel = ref({
  name: '',
  email: '',
  profile_photo: null,
  profile_photo_url: null,
});

let changePasswordModel = ref({
  new_password: '',
  old_password: '',
  new_password_confirm: '',
})

function changePassword() {
  errorPasswordMsg.value = '';
  successPasswordMsg.value = '';
  store.dispatch('updatePassword', changePasswordModel.value)
    .then(() => {
      successPasswordMsg.value = 'Пароль успешно обновлен';
    })
    .catch((err) => {
      errorPasswordMsg.value = err.response.data.error ? 'Неверный пароль' : 'Пароли не совпадают или не соответствуют требованиям';
    })
}

onMounted(() => {
  updateStartModel();
})

function onImageChoose(ev) {
  const file = ev.target.files[0];
  const reader = new FileReader();
  reader.onload = () => {
    isImageUpload.value = true;
    //the field to send on the backend and apply validation
    updateModel.value.profile_photo = reader.result;

    //the field to display here
    updateModel.value.profile_photo_url = reader.result;
  }
  reader.readAsDataURL(file);
}

function updateStartModel() {
  updateModel.value.name = store.state.user.data.name;
  updateModel.value.email = store.state.user.data.email;
  startModel.value = _.clone(updateModel.value);
}

function update() {
  errorMsg.value = '';
  successMsg.value = '';
  loading.value = true;
  store.dispatch('updateUser', updateModel.value)
    .then(() => {
      successMsg.value = 'Данные успешно сохранены';
      isImageUpload.value = false;
      updateModel.value.profile_photo = null;
      updateModel.value.profile_photo_url = null;
      updateStartModel();
    })
    .catch((err) => {
      errorMsg.value = (Object.values(err.response.data.errors)).join(', ');
    })
    .finally(() => {
      loading.value = false;
    })
}

function toggleDeleteResultsModal() {
  isDeleteResultsModalOpen.value = !isDeleteResultsModalOpen.value;
}

function toggleDeleteAccountModal() {
  isDeleteAccountModalOpen.value = !isDeleteAccountModalOpen.value;
}

function deleteResult() {
  errorDeleteResultsMsg.value = '';
  successDeleteResultsMsg.value = '';
  store.dispatch('deleteUserResults')
    .then(() => {
      successDeleteResultsMsg.value = 'Результаты успешно удалены';
      toggleDeleteResultsModal();
      store.dispatch('getStats');
    })
    .catch((err) => {
      errorDeleteResultsMsg.value = 'Ошибка при удалении результатов';
    })
}

function deleteAccount() {
  store.dispatch('deleteAccount')
    .then(() => {
      store.dispatch('logout')
        .then(() => {
        }).finally(() => {
        router.push({
          name: 'Login'
        })
      });
    })
    .catch((err) => {
      errorDeleteAccountMsg.value = 'Ошибка при удалении аккаунта';
    })
}
</script>

<style scoped>

</style>
