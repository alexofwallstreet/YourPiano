import {createStore} from "vuex";
import axiosClient from '../axios'

const store = createStore({
  state: {
    user: {
      data: JSON.parse(sessionStorage.getItem('user')),
      token: sessionStorage.getItem('TOKEN')
    },
    song: {
      loading: false,
      data: {
        id: Number,
        title: '',
        author: '',
        description: '',
        difficulty: Number,
        genre: Number,
        imagePath: '',
        ratingPoints: Number,
        isFavorite: Boolean
      }
    },
    songs: {
      loading: false,
      links: [],
      data: []
    },
    gameModes: {
      FREE_PLAY_MODE: 'free-play-mode',
      TUTORIAL_MODE: 'tutorial-mode',
      RATING_GAME_MODE: 'rating-game-mode'
    },
    uiElements: {
      navbarHeight: '4rem'
    },
    adminSideBarOpen: false,
    searchOptions: {
      filters: [
        {
          id: 'genre',
          name: 'Жанр',
          options: [
            {label: 'Поп', value: 1, checked: false},
            {label: 'Рок', value: 2, checked: false},
            {label: 'Хип-хоп', value: 3, checked: false},
            {label: 'Рэп', value: 4, checked: false},
            {label: 'Электронная', value: 5, checked: false},
            {label: 'Классическая', value: 6, checked: false},
            {label: 'Джаз', value: 7, checked: false},
            {label: 'R&B', value: 8, checked: false},
          ],
        },
        {
          id: 'difficulty',
          name: 'Сложность',
          options: [
            {label: "Простой", value: 1, checked: false},
            {label: "Средний", value: 2, checked: false},
            {label: "Сложный", value: 3, checked: false},
          ],
        },
      ],
      searchTitleInput: '',
      searchAuthorInput: '',
      sorting: [
        {name: 'Сначала популярные', value: 'popularity', current: true},
        {name: 'Сначала новые', value: 'newest', current: false},
        {name: 'Сначала старые', value: 'oldest', current: false},
      ]
    },
    stats: {
      loading: false,
      data: {
        playedSongs: Number,
        totalPoints: Number,
        userStatus: String,
        userPlace: Number,
        usersTop10: Array
      }
    }
  },
  getters: {
    adminSideBarOpen: state => {
      return state.adminSideBarOpen
    },
  },
  actions: {

    getStats({commit}) {
      commit('setStatsLoading', true);
      return axiosClient.get(`/users/${store.state.user.data.id}/stats`).then(res => {
        commit('setStatsLoading', false);
        commit('setStats', res);
        return res;
      })
    },

    getSong({commit}, id) {
      commit('setSongLoading', true);
      return axiosClient.get(`/songs/${id}?user_id=${store.state.user.data?.id}`).then(res => {
        commit('setSongLoading', false);
        commit('setSong', res.data);
        return res;
      })
    },

    getSongMidi({commit}, id) {
      console.log(id);
      return axiosClient.get(`/songs/${id}/midi`, {
        responseType: 'arraybuffer',
      });
    },

    getSongs({commit}, {url = null} = {}) {
      url = url || '/songs?page=1';
      commit('setSongsLoading', true);
      const searchOptions = store.state.searchOptions;
      let searchQuery = '';
      searchQuery += `&user_id=${store.state.user.data ? store.state.user.data.id : 'guest'}`;
      searchQuery += searchOptions.searchTitleInput ? `&title=${searchOptions.searchTitleInput}` : '';
      searchQuery += searchOptions.searchAuthorInput ? `&author=${searchOptions.searchAuthorInput}` : '';
      searchQuery += `&orderBy=${searchOptions.sorting.find(sort => sort.current).value}`;
      searchOptions.filters[0].options.forEach(genre => {
        if (genre.checked) {
          searchQuery += `&genre[]=${genre.value}`;
        }
      });
      searchOptions.filters[1].options.forEach(difficulty => {
        if (difficulty.checked) {
          searchQuery += `&difficultyLevel[]=${difficulty.value}`;
        }
      });
      return axiosClient.get(`${url}${searchQuery}`).then(res => {
        commit('setSongsLoading', false);
        commit('setSongs', res.data);
        return res;
      })
    },

    getLikedSongs({commit}, {url = null} = {}) {
      commit('setSongsLoading', true);
      url = url || '/user-song-likes?page=1';
      return axiosClient.get(`${url}&user_id=${store.state.user.data?.id}`).then(res => {
        commit('setSongsLoading', false);
        commit('setSongs', res.data);
        return res;
      })
    },

    likeSong({commit}, {song, user}) {
      return axiosClient.post(`/songs/${song.id}/like`, {"user_id": user?.id})
        .then(() => {
          return true;
        })
    },

    dislikeSong({commit}, {song, user}) {
      return axiosClient.post(`/songs/${song.id}/dislike`, {"user_id": user.id})
        .then(() => {
          return true;
        })
    },

    register({commit}, user) {
      return axiosClient.post('/register', user)
        .then(({data}) => {
          commit('setUser', data);
          return data;
        })
    },

    login({commit}, user) {
      return axiosClient.post('/login', user)
        .then(({data}) => {
          commit('setUser', data);
          return data;
        })
    },

    logout({commit}) {
      return axiosClient.post('/logout')
        .then(res => {
          return res;
        }).finally(() => {
          commit('logout');
        })
    },

    toggleAdminSidebar(context) {
      context.commit('toggleAdminSidebar')
    },

    userSongRatingPlay({commit}, {song, user, points}) {
      console.log(song, user, points)
      return axiosClient.post(`/songs/${song.id}/rating-play`, {user_id: user.id, rating_points: parseInt(points)})
        .then(() => {
          return true;
        })
    }

  },

  mutations: {

    logout: state => {
      state.user.data = null;
      state.user.token = null;
      sessionStorage.clear();
    },

    setUser: (state, userData) => {
      state.user.token = userData.token;
      state.user.data = userData.user;
      sessionStorage.setItem('TOKEN', userData.token);
      sessionStorage.setItem('user', JSON.stringify(userData.user));
    },

    setSongsLoading: (state, loading) => {
      state.songs.loading = loading;
    },

    setSongLoading: (state, loading) => {
      state.song.loading = loading;
    },

    setStatsLoading: (state, loading) => {
      state.stats.loading = loading;
    },

    setStats: (state, stats) => {
      state.stats.data = stats.data;
    },

    setSong: (state, songs) => {
      state.song.data = songs.data;
    },

    setSongs: (state, songs) => {
      state.songs.links = songs.meta.links;
      state.songs.data = songs.data;
    },

    updateSearchTitleInput: (state, value) => {
      state.searchOptions.searchTitleInput = value;
    },

    updateSearchAuthorInput: (state, value) => {
      state.searchOptions.searchAuthorInput = value;
    },

    setSearchOptions: (state, options) => {
      state.searchOptions = options;
    },

    updateSortingOrder: (state, newSort) => {
      state.searchOptions.sorting.find(sort => sort.current).current = false;
      state.searchOptions.sorting.find(sort => sort.name === newSort.name).current = true;
    },

    toggleAdminSidebar(state) {
      console.log(state.adminSideBarOpen)
      state.adminSideBarOpen = !state.adminSideBarOpen
    }
  },
  modules: {}
})

export default store;
