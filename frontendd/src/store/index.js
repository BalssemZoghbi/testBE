import Vue from "vue";
import Vuex from "vuex";
// import axios from "axios";
// axios.defaults.baseURL = "http://127.0.0.1:8000/api";
// axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
import auth from "./auth";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    // user:null,
    projet:null
  },
  getters:{
    // user:(state)=>{
    //   return state.user;
    // },
    projet:(state)=>{
      return state.projet;
    }
  },
  mutations: {
    // user(state,user){
    //   state.user=user
    // },
    projet(state,projet){
      state.projet=projet
    }
  },
  actions: {
    // user(context,user){
    //   context.commit('user',user)
    // },
    projet(context,projet){
      context.commit('projet',projet)
    }
  },
  modules: {auth},
});
