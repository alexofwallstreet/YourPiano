<template>
  <section class="animate-pulse">
    <header class="max-w-7xl mx-auto px-4 opacity-0 animate-fade-in-right">
      <div class="relative z-10 flex items-baseline justify-between pt-16 pb-6 border-b border-gray-200">
        <div class="w-1/2 h-5 bg-slate-200 rounded"></div>
      </div>
    </header>
    <div class="relative max-w-screen-xl px-4 py-8 mx-auto">
      <div class="grid gap-8 lg:items-start lg:grid-cols-4">
        <div class="lg:col-span-3">

          <div class="relative mt-4 flex gap-6 flex-wrap lg:justify-start justify-center">
            <div  class="w-64 rounded-xl h-64 bg-slate-200 opacity-0 animate-fade-in-right"/>

            <div class="info flex flex-col justify-between opacity-0 animate-fade-in-down">
              <div>
                <div class="w-20 h-4 rounded bg-slate-200 inline-block"></div>
                <div class="w-4 inline-block"></div>
                <div class="w-20 h-4 rounded bg-slate-200 inline-block"></div>

                <div class="w-96 h-10 rounded bg-slate-200 mt-4"/>
                <div class="w-1/2 h-6 rounded bg-slate-200 mt-2"/>
              </div>
              <div class="mt-2">
                <div class="h-12 w-64 rounded bg-slate-200"></div>
              </div>
              <div class="w-36 h-4 rounded bg-slate-200 mt-2" />
            </div>
          </div>
        </div>

        <div class="lg:top-0 lg:sticky opacity-0 animate-fade-in-left">
          <form class="space-y-4 lg:pt-8 text-center lg:text-left">
            <div
              class="w-auto lg:w-full rounded bg-slate-200 h-10"
            />
            <div
              class="w-auto lg:w-full rounded bg-slate-200 h-10"
            />
            <div class="flex justify-between">
              <div
                class="w-auto lg:w-2/3 rounded bg-slate-200 h-10"
              />
              <div
                class="w-auto lg:w-1/4 rounded bg-slate-200 h-10"
              />
            </div>
          </form>
        </div>

        <div class="lg:col-span-3">
          <div class="prose max-w-none">
            <div
              v-for="i in 10" class="w-full h-2 bg-slate-200 mt-2 opacity-0 animate-fade-in-down"
              :style="{animationDelay: `${i * 20}ms`}"
            ></div>
            <div
              class="bg-slate-200 w-full h-96 rounded-xl mt-4 opacity-0 animate-fade-in-up"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "single-song-skeleton"
}
</script>

<style scoped>

</style>
