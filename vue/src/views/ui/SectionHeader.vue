<template>
  <div class="max-w-xl mb-10 md:mx-auto text-center lg:max-w-2xl md:mb-12">
    <div>
      <p class="inline-block px-3 py-px mb-4 text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-indigo-600">
        {{ label }}
      </p>
    </div>
    <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl mx-auto">
        <span class="relative inline-block">
          <svg viewBox="0 0 52 24" fill="currentColor" class="absolute top-0 left-0 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
            <defs>
              <pattern id="7b568941-9ed0-4f49-85a0-5e21ca6c7ad6" x="0" y="0" width=".135" height=".30">
                <circle cx="1" cy="1" r=".7"></circle>
              </pattern>
            </defs>
          </svg>
        </span>
      {{ title }}
    </h2>
    <p class="text-base text-gray-700 md:text-lg">
      {{ content }}
    </p>
  </div>
</template>

<script>
export default {
  name: "SectionHeader",
  props: {
    title: String,
    content: String,
    label: String
  }
}
</script>

<style scoped>

</style>
