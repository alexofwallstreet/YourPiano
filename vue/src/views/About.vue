<template>
  <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative z-10 flex items-baseline justify-between pt-16 pb-6 border-b border-gray-200">
      <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">О сайте</h1>
    </div>
  </header>
  <main class="bg-indigo-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <!-- Replace with your content -->
      <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg shadow-md">
          <!-- First Screen -->
          <section>
            <div class="px-4 py-16 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-8 text-center text-white bg-indigo-600 sm:col-span-2 sm:p-16 lg:py-24">
                  <div class="max-w-lg mx-auto space-y-8 animate-fade-in-down" :style="{animationDelay: `100ms`}">
                    <p class="text-3xl font-extrabold sm:text-4xl">
                      Всегда мечтали научиться играть на фортепиано?
                    </p>

                    <p class="text-lg">
                      Обучение с YourPiano - это весело и увлекательно.
                      Зарабатывайте очки за каждую сыгранную песню и повышайте свой уровень
                    </p>

                    <a
                      href="#begin"
                      class="animate-bounce inline-flex items-center px-4 py-4 mt-16 font-medium text-indigo-600 bg-white rounded-full hover:opacity-75"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="flex-shrink-0 w-4 h-4 rotate-90"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                      </svg>
                    </a>
                  </div>
                </div>

                <div class="relative h-64 lg:order-first lg:h-full bg-indigo-800 rounded-3xl hidden sm:block ">
                  <img
                    src="/images/piano-woman.png"
                    alt="Sunset with palm trees"
                    :style="{animationDelay: `400ms`}"
                    class="absolute inset-0 object-cover w-full h-full animate-fade-in-right"
                  />
                </div>

                <div class="relative h-64 lg:h-full bg-indigo-800 rounded-3xl ">
                  <img
                    src="/images/piano-woman-2.png"
                    alt="Man in a hat and yellow jumper"
                    :style="{animationDelay: `400ms`}"
                    class="absolute inset-0 object-cover w-full h-full animate-fade-in-left"
                  />
                </div>
              </div>
            </div>
          </section>

          <!-- Second Screen -->
          <section id="begin" class="px-4 py-8 mx-auto max-w-screen-2xl sm:px-6 lg:px-8 border shadow">
            <div class="relative overflow-hidden text-gray-900 lg:flex">
              <div class="w-full p-12 text-center lg:w-1/2 sm:p-16 lg:p-24 lg:text-left">
                <div class="max-w-xl mx-auto lg:ml-0 animate-fade-in-down">
                  <p class="text-sm font-medium">Lorem ipsum dolor sit amet.</p>

                  <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit
                  </p>

                  <p class="hidden lg:mt-4 lg:block">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et, egestas
                    tempus tellus etiam sed. Quam a scelerisque amet ullamcorper eu enim et
                    fermentum, augue. Aliquet amet volutpat quisque ut interdum tincidunt
                    duis.
                  </p>

                  <router-link
                    to="about"
                    class="inline-block px-5 py-3 mt-8 text-sm font-medium text-white bg-indigo-500 rounded-lg hover:bg-indigo-600"
                  >
                    Get started today
                  </router-link>
                </div>
              </div>

              <div class="relative w-full h-64 sm:h-96 lg:w-1/2 lg:h-auto bg-indigo-800 rounded-3xl">
                <img
                  src="/images/pianist.png"
                  alt="Women smiling at college"
                  class="absolute inset-0 object-contain w-full h-full p-12 animate-fade-in-left" :style="{animationDelay: `1000ms`}"
                />
              </div>
            </div>
          </section>

          <!-- Third Screen -->
          <section class="px-4 mx-auto py-8 max-w-screen-2xl sm:px-6 lg:px-8 border shadow">
            <div class="relative overflow-hidden text-gray-900 lg:flex">
              <div class="relative w-full h-64 sm:h-96 lg:w-1/2 lg:h-auto bg-indigo-800 rounded-3xl">
                <img
                  src="/images/piano-woman-3.png"
                  alt="Women smiling at college"
                  class="absolute inset-0 object-cover w-full h-full animate-fade-in-right" :style="{animationDelay: `1000ms`}"
                />
              </div>
              <div class="w-full p-12 text-center lg:w-1/2 sm:p-16 lg:p-24 lg:text-left animate-fade-in-down">
                <div class="max-w-xl mx-auto lg:ml-0">
                  <p class="text-sm font-medium">Lorem ipsum dolor sit amet.</p>

                  <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit
                  </p>

                  <p class="hidden lg:mt-4 lg:block">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et, egestas
                    tempus tellus etiam sed. Quam a scelerisque amet ullamcorper eu enim et
                    fermentum, augue. Aliquet amet volutpat quisque ut interdum tincidunt
                    duis.
                  </p>

                  <a
                    href=""
                    class="inline-block px-5 py-3 mt-8 text-sm font-medium text-white bg-indigo-500 rounded-lg hover:bg-indigo-600"
                  >
                    Get started today
                  </a>
                </div>
              </div>
            </div>
          </section>

          <!-- Quote Screen -->
          <div class="max-w-5xl px-4 py-8 mx-auto mt-7 animate-fade-in-down">
            <section class="p-8 bg-gray-100 rounded-lg shadow-xl">
              <div class="grid grid-cols-1 gap-12 sm:grid-cols-3 sm:items-center">
                <div class="relative">
                  <div class="aspect-w-1 aspect-h-1">
                    <img
                      src="https://www.hyperui.dev/photos/man-5.jpeg"
                      alt=""
                      class="object-cover rounded-lg"
                    />
                  </div>

                  <div
                    class="absolute inline-flex px-4 py-2 bg-white rounded-lg shadow-xl -bottom-4 -right-4"
                  >
                    <span class="inline-flex items-center justify-center w-12 h-10 bg-gray-100 rounded-lg font-extrabold text-4xl">"</span>
                  </div>
                </div>

                <blockquote class="sm:col-span-2">
                  <p class="text-xl font-bold sm:text-2xl">
                    Слова иногда нуждаются в музыке, но музыка не нуждается ни в чём.
                  </p>

                  <cite class="inline-flex items-center mt-8 not-italic">
                    <span class="hidden w-6 h-px bg-gray-400 sm:inline-block"></span>
                    <p class="text-sm text-gray-500 uppercase sm:ml-3">
                      <i>Алексей Волчков</i>, создатель сайта YourPiano
                    </p>
                  </cite>
                </blockquote>
              </div>
            </section>
          </div>

          <!-- Promo Section -->
          <section class="text-gray-900 animate-fade-in-up">
            <div class="max-w-screen-xl px-4 py-32 mx-auto lg:items-center lg:flex">
              <div class="max-w-3xl mx-auto text-center">
                <h1
                  class="text-3xl font-extrabold text-transparent sm:text-5xl bg-clip-text bg-gradient-to-r from-blue-500 via-indogo-500 to-indigo-600">
                  Начинай учиться
                  <span class="sm:block">
                  прямо сейчас
                  </span>
                </h1>

                <p class="max-w-xl mx-auto mt-4 sm:leading-relaxed sm:text-xl">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt illo tenetur fuga ducimus numquam
                  ea!
                </p>

                <div class="flex flex-wrap justify-center gap-4 mt-8">
                  <a
                    class="block w-full px-12 py-3 text-sm font-medium text-white bg-indigo-600 border border-blue-600 rounded sm:w-auto active:text-opacity-75 hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring"
                    href="/get-started">
                    Get Started
                  </a>

                  <a
                    class="block w-full px-12 py-3 text-sm font-medium text-white border bg-indigo-500 border-blue-600 rounded sm:w-auto hover:bg-indigo-600 active:bg-indigo-500 focus:outline-none focus:ring"
                    href="/about">
                    Learn More
                  </a>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
      <!-- /End replace -->
    </div>
  </main>
</template>

<script>
export default {
  name: "About"
}
</script>

<style scoped>

</style>
