<template>
  <div class="opacity-0 animate-fade-in-down">
    <div>
      <img class="mx-auto h-12 w-auto" src="/logo-dark.svg"
           alt="Workflow"/>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Зарегистрируйтесь</h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Или
        {{ ' ' }}
        <router-link :to="{name: 'Login'}" class="font-medium text-indigo-600 hover:text-indigo-500">
          войдите в свой аккаунт
        </router-link>
      </p>
    </div>
    <form class="mt-8 space-y-6" @submit.prevent="register">
      <ErrorMessage v-if="Object.keys(errors).length" class="flex items-stretch justify-start text-sm">

        <ul>
          <li v-for="(field, i) of Object.keys(errors)" :key="i">
          <ul>
            <li v-for="(error, i) of errors[field] || []" :key="i">
              {{ DISTIONARY[error] ? DISTIONARY[error] : error }}
            </li>
          </ul>
          </li>
        </ul>

        <div class="flex items-start">
          <span @click="errors={}" class="ml-auto w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </span>
        </div>


      </ErrorMessage>
      <!--      <div v-if="errorMsg"-->
      <!--           class="flex items-center justify-between py-3 px-5 bg-red-500 text-white rounded opacity-0 animate-fade-in-down">-->
      <!--        {{ errorMsg }}-->
      <!--        <span @click="errorMsg=''"-->
      <!--              class="w-8 h-8 flex items-center justify-center cursor-pointer rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]">-->
      <!--        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
      <!--          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>-->
      <!--        </svg>-->
      <!--      </span>-->
      <!--      </div>-->
      <input type="hidden" name="remember" value="true"/>
      <div class="rounded-md shadow-sm -space-y-px">
        <div class="relative">
          <label for="full-name" class="sr-only">Имя</label>
          <input id="full-name" name="name" type="text" autocomplete="name" required="" v-model="user.name"
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                 placeholder="Имя"/>
        </div>
        <div class="relative">
          <label for="email" class="sr-only">Электронная почта</label>
          <input id="email" name="email" type="email" autocomplete="email" required="" v-model="user.email"
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                 placeholder="Электронная почта"/>
          <Tooltip :text="'Электронная почта должна быть уникальной'"></Tooltip>
        </div>
        <div class="relative">
          <label for="password" class="sr-only">Пароль</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required=""
                 v-model="user.password"
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                 placeholder="Пароль"/>
          <Tooltip :text="'Минимум 8 символов, цифра, строчная и прописная буквы'"></Tooltip>
        </div>
        <div>
          <label for="password-confirm" class="sr-only">Подтверждение пароля</label>
          <input id="password-confirm" name="password-confirm" type="password" autocomplete="current-password-confirm"
                 required="" v-model="user.password_confirm"
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                 placeholder="Подтверждение пароля"/>
        </div>

      </div>

      <div>
        <button :disabled="loading" type="submit" :class="{'cursor-not-allowed hover:bg-indigo-500' : loading}"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <LockClosedIcon v-if="!loading" class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                                            aria-hidden="true"/>
              <svg v-if="loading"
                   class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                   xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </span>
          Зарегистрироваться
        </button>
      </div>
    </form>
  </div>

</template>

<script setup>
import {LockClosedIcon} from '@heroicons/vue/solid'
import store from "../store";
import {useRouter} from "vue-router";
import {ref} from "vue";
import ErrorMessage from "./ui/ErrorMessage.vue";
import Tooltip from "./ui/Tooltip.vue";

// * The password and password confirm must match.
// * The password must be at least 8 characters.
// * The password must contain at least one uppercase and one lowercase letter.
// * The password must contain at least one symbol.
const DISTIONARY = {
  'The password and password confirm must match.': 'Пароли не совпадают.',
  'The password must be at least 8 characters.': 'Пароль должен содержать не менее 8 символов.',
  'The password must contain at least one uppercase and one lowercase letter.': 'Пароль должен содержать хотя бы одну букву верхнего и нижнего регистров.',
  'The password must contain at least one symbol.': 'Пароль должен содержать один символ (!, ?, @ и др.).',
  'The email has already been taken.': 'Данная электронная почта уже занята.',
  'The password must contain at least one number.': 'Пароль должен содержать хотя бы одну цифру',
}

const router = useRouter();
const user = {
  name: '',
  email: '',
  password: '',
  password_confirm: ''
}

const loading = ref(false);
let errors = ref({});

function register() {
  loading.value = true;
  store.dispatch('register', user)
    .then(() => {
      router.push({
        name: 'Dashboard'
      })
    })
    .catch((err) => {
      if (err.response.status === 422) {
        errors.value = err.response.data.errors;
      }
    })
    .finally(() => {
      loading.value = false;
    })
}

</script>
