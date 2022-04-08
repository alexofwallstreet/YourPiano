<template>
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
                <img class="w-20 h-20 md:w-40 md:h-40 object-cover rounded-full
                     border-2 border-indigo-600 p-1"
                     :src="store.state.user.data.imagePath"
                     alt="profile">
                <!-- profile meta -->
                <div class="w-8/12 md:w-7/12 mt-6">
                  <h2 class="text-3xl font-light sm:mb-0 text-center">
                    {{ store.state.user.data.name }}
                  </h2>
                  <!-- user meta form medium screens -->
                  <div class="hidden md:block mb-4 mt-1">
                    <h1 class="font-semibold text-center">{{store.state.user.data.email}}</h1>
                  </div>
                  <!-- post, following, followers list for medium screens -->
                  <ul class="hidden md:flex space-x-8 mb-4 justify-center">
                    <li>
                      <span class="font-semibold">136</span>
                      чего-то
                    </li>

                    <li>
                      <span class="font-semibold">40</span>
                      лайков
                    </li>
                    <li>
                      <span class="font-semibold">302</span>
                      место
                    </li>
                  </ul>
                </div>
              </header>

              <!-- posts -->
              <div class="px-px md:px-3">

                <!-- user following for mobile only -->
                <ul class="flex md:hidden justify-around space-x-8 border-t
                text-center p-2 text-gray-600 leading-snug text-sm">
                  <li>
                    <span class="font-semibold text-gray-800 block">136</span>
                    posts
                  </li>

                  <li>
                    <span class="font-semibold text-gray-800 block">40.5k</span>
                    followers
                  </li>
                  <li>
                    <span class="font-semibold text-gray-800 block">302</span>
                    following
                  </li>
                </ul>

                <!-- insta freatures -->
                <ul class="flex items-center justify-around md:justify-center space-x-12
                    uppercase tracking-widest font-semibold text-xs text-gray-600
                    border-t">
                  <!-- posts tab is active -->
                  <li class="md:border-t md:border-gray-700 md:-mt-px md:text-gray-700">
                    <a class="inline-block p-3" href="#">
                      <i class="fas fa-th-large text-xl md:text-xs"></i>
                      <span class="hidden md:inline">мой рейтинг</span>
                    </a>
                  </li>
                  <li>
                    <a class="inline-block p-3" href="#">
                      <i class="far fa-square text-xl md:text-xs"></i>
                      <span class="hidden md:inline">мои лайки</span>
                    </a>
                  </li>
                </ul>
                <!-- flexbox grid -->
                <div class="flex flex-wrap -mx-px md:-mx-3">

                  <!-- column -->
                  <div class="w-1/3 p-px md:px-3">
                    <!-- post 1-->
                    <a href="#">
                      <article class="post bg-gray-100 text-white relative pb-full md:mb-6">
                        <!-- post image-->
                        <img class="w-full h-full absolute left-0 top-0 object-cover"
                             src="https://images.unsplash.com/photo-1502791451862-7bd8c1df43a7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                             alt="image">

                        <i class="fas fa-square absolute right-0 top-0 m-1"></i>
                        <!-- overlay-->
                        <div class="overlay bg-gray-800 bg-opacity-25 w-full h-full absolute
                                left-0 top-0 hidden">
                          <div class="flex justify-center items-center
                                    space-x-4 h-full">
                  <span class="p-2">
                    <i class="fas fa-heart"></i>
                    412K
                  </span>

                            <span class="p-2">
                    <i class="fas fa-comment"></i>
                    2,909
                  </span>
                          </div>
                        </div>

                      </article>
                    </a>
                  </div>

                  <div class="w-1/3 p-px md:px-3">
                    <a href="#">
                      <!-- post 2 -->
                      <article class="post bg-gray-100 text-white relative pb-full md:mb-6">
                        <img class="w-full h-full absolute left-0 top-0 object-cover"
                             src="https://images.unsplash.com/photo-1498409570040-05bf6d3dd5b5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                             alt="image">

                        <!-- overlay-->
                        <div class="overlay bg-gray-800 bg-opacity-25 w-full h-full absolute
                                left-0 top-0 hidden">
                          <div class="flex justify-center items-center
                                    space-x-4 h-full">
                  <span class="p-2">
                    <i class="fas fa-heart"></i>
                    412K
                  </span>

                            <span class="p-2">
                    <i class="fas fa-comment"></i>
                    1,993
                  </span>
                          </div>
                        </div>

                      </article>
                    </a>
                  </div>

                  <div class="w-1/3 p-px md:px-3">
                    <a href="#">
                      <article class="post bg-gray-100 text-white relative pb-full  md:mb-6">
                        <img class="w-full h-full absolute left-0 top-0 object-cover"
                             src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                             alt="image">
                        <!-- overlay-->
                        <div class="overlay bg-gray-800 bg-opacity-25 w-full h-full absolute
                                left-0 top-0 hidden">
                          <div class="flex justify-center items-center
                                    space-x-4 h-full">
                  <span class="p-2">
                    <i class="fas fa-heart"></i>
                    112K
                  </span>

                            <span class="p-2">
                    <i class="fas fa-comment"></i>
                    2,090
                  </span>
                          </div>
                        </div>
                      </article>
                    </a>
                  </div>

                  <div class="w-1/3 p-px md:px-3">
                    <a href="#">
                      <article class="post bg-gray-100 text-white relative pb-full md:mb-6">
                        <img class="w-full h-full absolute left-0 top-0 object-cover"
                             src="https://images.unsplash.com/photo-1533105079780-92b9be482077?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                             alt="image">

                        <i class="fas fa-video absolute right-0 top-0 m-1"></i>

                        <!-- overlay-->
                        <div class="overlay bg-gray-800 bg-opacity-25 w-full h-full absolute
                                left-0 top-0 hidden">
                          <div class="flex justify-center items-center
                                    space-x-4 h-full">
                  <span class="p-2">
                    <i class="fas fa-heart"></i>
                    841K
                  </span>

                            <span class="p-2">
                    <i class="fas fa-comment"></i>
                    909
                  </span>
                          </div>
                        </div>

                      </article>
                    </a>
                  </div>

                  <div class="w-1/3 p-px md:px-3">
                    <a href="#">
                      <article class="post bg-gray-100 text-white relative pb-full md:mb-6">
                        <img class="w-full h-full absolute left-0 top-0 object-cover"
                             src="https://images.unsplash.com/photo-1475688621402-4257c812d6db?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80"
                             alt="image">
                        <!-- overlay-->
                        <div class="overlay bg-gray-800 bg-opacity-25 w-full h-full absolute
                                left-0 top-0 hidden">
                          <div class="flex justify-center items-center
                                    space-x-4 h-full">
                  <span class="p-2">
                    <i class="fas fa-heart"></i>
                    120K
                  </span>

                            <span class="p-2">
                    <i class="fas fa-comment"></i>
                    3,909
                  </span>
                          </div>
                        </div>

                      </article>
                    </a>
                  </div>

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
import store from "../store";
</script>

<style scoped>

</style>
