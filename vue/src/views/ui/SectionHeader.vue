<template>
  <div class="max-w-xl mb-10 md:mx-auto lg:max-w-2xl md:mb-12"
       :class="!centerContent ? 'text-center' : ''">
    <div>
      <p class="inline-block px-3 py-px mb-4 text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-indigo-600">
        {{ label }}
      </p>
    </div>
    <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl"
        :class="!centerContent ? 'mx-auto' : ''">
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
    label: String,
    centerContent: Boolean
  }
}
</script>

<style scoped>

</style>
