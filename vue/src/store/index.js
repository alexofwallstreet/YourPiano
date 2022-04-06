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
        midiPath: '',
        speed: 1
      }
    },
    songs: {
      loading: false,
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
    adminSideBarOpen: false
  },
  getters: {
    adminSideBarOpen: state => {
      return state.adminSideBarOpen
    }
  },
  actions: {
    getSong({commit}, id) {
      commit('setSongLoading', true);
      return axiosClient.get(`/songs/${id}`).then(res => {
        commit('setSongLoading', false);
        commit('setSong', res.data);
        return res;
      })
    },
    getSongMidi({commit},id) {
      console.log(id);
      return axiosClient.get(`/songs/${id}/midi`, {
        responseType: 'arraybuffer',
      });
    },
    getSongs({commit}) {
      commit('setSongsLoading', true);
      return axiosClient.get('/songs').then(res => {
        commit('setSongsLoading', false);
        commit('setSongs', res.data);
        return res;
      })
    },
    register({ commit }, user) {
      return axiosClient.post('/register', user)
        .then(({data}) => {
          commit('setUser', data);
          return data;
        })
    },

    login({ commit }, user) {
      return axiosClient.post('/login', user)
        .then(({data}) => {
          commit('setUser', data);
          return data;
        })
    },

    logout({ commit }) {
      return axiosClient.post('/logout')
        .then(res => {
          return res;
        }).finally(() => {
          commit('logout');
        })
    },

    toggleAdminSidebar(context) {
      context.commit('toggleAdminSidebar')
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
    setSong: (state, songs) => {
      state.song.data = songs.data;
    },
    setSongs: (state, songs) => {
      state.songs.data = songs.data;
    },
    toggleAdminSidebar (state) {
      console.log(state.adminSideBarOpen)
      state.adminSideBarOpen = !state.adminSideBarOpen
    }
  },
  modules: {}
})

export default store;
