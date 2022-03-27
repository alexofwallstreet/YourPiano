import {createStore} from "vuex";
import axiosClient from '../axios'

const store = createStore({
  state: {
    user: {
      data: JSON.parse(sessionStorage.getItem('user')),
      token: sessionStorage.getItem('TOKEN')
    }
  },
  getters: {},
  actions: {
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
          commit('logout');
          return res;
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
    }
  },
  modules: {}
})

export default store;
