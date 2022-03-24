// import { stringify } from "vue-router";
import { createStore } from "vuex";
const axios=require('axios');
const instance = axios.create({
  baseURL: 'http://127.0.0.1:8000/api'
});
let user=localStorage.getItem('user');
if(!user){
  user={
    id:-1,
    token:''
  };
}else{
  try{
    user=JSON.parse(user);
    instance.defaults.headers.common['Authorization']=user.token;
  }catch(ex){
    user={
      id:-1,
      token:''
    };
}
}
export default createStore({
  state: {
    status:'',
    user:user,
    // userInfos:{
    //   name:'',
    //   email:'',
    //   password:'',
    // }
  },
  mutations: {
    setStatus: function(state,status){
    state.status=status;
    },
    logUser:function(state,user){
      instance.defaults.headers.common['Authorization']=user.token;
      localStorage.setItem('user',JSON.stringify(user) );
      state.user=user;
    },
    // userInfos:function(state,userInfos){
    //   state.userInfos=userInfos;
    // },
    logout:function(state){
      state.user={
        id:-1,
        token:'',
      }
      localStorage.removeItem('user')
    }
  },
  actions: { 
    login:async({commit},userInfos) => {
      commit;
      commit('setStatus','loading');
     await instance.post('/login', userInfos)
      .then(function (response) {
        commit('setStatus','');
        commit('logUser', response.data);
        return response.data;
      })
      .catch(function (error) {
        commit('setStatus','error_login');
        console.log(error);
      });
    },
    createAccount:({commit},userInfos) => {
      commit;
      instance.post('/register', userInfos)
      .then(function (response) {
        commit('setStatus','created');
        console.log(response);
      })
      .catch(function (error) {
        commit('setStatus','error_create');
        console.log(error);
      });
    },
    // getUserInfos:({commit})=>{
    //   instance.post('/about')
    //   .then(function (response) {
    //     commit('userInfos',response.data.infos);
    //     console.log(response);
    //   })
    //   .catch(function (error) {
    //     console.log(error);
    //   });
    // },
    
  
  },
  modules: {},
});
