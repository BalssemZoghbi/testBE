import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
axios.defaults.baseURL = "http://127.0.0.1:8000/api";
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user:null
  },
  getters:{
    user:(state)=>{
      return state.user;
    }
  },
  mutations: {
    user(state,user){
      state.user=user
    }
  },
  actions: {
    user(context,user){
      context.commit('user',user)
    }
  },
  modules: {},
});
