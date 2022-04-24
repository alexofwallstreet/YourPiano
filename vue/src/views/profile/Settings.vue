<template>
  <div class="opacity-0 animate-fade-in-down mt-6">
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
        <form action="#" method="POST">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="first-name" class="block text-sm font-medium text-gray-700"> Имя пользователя </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                  </div>
                </div>
              </div>

              <div>
                <label for="email-address" class="block text-sm font-medium text-gray-700"> Электронная почта </label>
                <div class="mt-1">
                  <input type="text" name="email-address" id="email-address" autocomplete="email"
                         class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                </div>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700"> Фото профиля </label>
                <div class="mt-1 flex items-center">
                  <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                      <path
                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                  </span>
                  <button type="button"
                          class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Поменять
                  </button>
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
          <h3 class="text-lg font-medium leading-6 text-gray-900">Изменить пароль</h3>
          <p class="mt-1 text-sm text-gray-600">Рекомендуется как можно чаще менять пароль.</p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="#" method="POST">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-5">
                  <label for="old-password" class="block text-sm font-medium text-gray-700">Текущий пароль</label>
                  <input type="text" name="old-password" id="old-password" autocomplete="given-name"
                         class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                </div>
                <div class="col-span-6 sm:col-span-5">
                  <label for="new-password" class="block text-sm font-medium text-gray-700">Новый пароль</label>
                  <input type="text" name="new-password" id="new-password" autocomplete="given-name"
                         class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                </div>
                <div class="col-span-6 sm:col-span-5">
                  <label for="new-password-repeat" class="block text-sm font-medium text-gray-700">Повторите новый
                    пароль</label>
                  <input type="text" name="new-password-repeat" id="new-password-repeat" autocomplete="given-name"
                         class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                </div>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit"
                      class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
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
                <legend class="text-base font-medium text-gray-900">Удалить все результаты</legend>
                <p class="text-sm text-gray-600">
                  Удаление результатов приведет к тому, что все очки, набранные вами за сыгранные песни, будут удалены.
                </p>
                <div class="mt-1 space-y-4">
                  <div>
                    <div class="mt-2 flex items-center">
                      <button type="button"
                              class="bg-red-500 text-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Удалить результаты
                      </button>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend class="text-base font-medium text-gray-900">Удалить аккаунт</legend>
                <p class="text-sm text-gray-600">
                  Удаление всех данных профиля, включая лайки и набранные очки.
                </p>
                <div class="mt-1 space-y-4">
                  <div>
                    <div class="mt-2 flex items-center">
                      <button type="button"
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
</template>


<script>
export default {
  name: "Settings"
}
</script>

<style scoped>

</style>
