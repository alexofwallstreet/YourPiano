<template>
  <!-- component -->
  <div class="bg-white py-8 rounded-md w-full">
    <div class=" flex items-center justify-center">
      <h2 class="text-gray-600 text-3xl font-extrabold">Топ {{ users.length }} пользователей YourPiano</h2>
    </div>
    <div class="w-full">
      <div class="py-4 overflow-x-auto w-full">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
          <table class="min-w-full leading-normal">
            <thead>
            <tr>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Место
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Пользователь
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Уровень
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Очки
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, i) of users" :key="i">
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <div class="flex items-center">
                  <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                      {{ i+1 }}
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <div class="flex items-center">
                  <div class="flex-shrink-0 w-10 h-10">
                    <img class="w-full h-full rounded-full object-cover"
                         :src="user.profile_photo"
                         alt=""/>
                  </div>
                  <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                      {{user.name}}, ({{user.email}})
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  <StatusLabel :status="user.userStatus"></StatusLabel>
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 font-bold text-xl whitespace-no-wrap">
                  {{ user.points ?? 0 }}
                </p>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import StatusLabel from "./StatusLabel.vue";
export default {
  name: "Table",
  components: {StatusLabel},
  props: {
    users: Array
  }
}
</script>

<style scoped>

</style>
