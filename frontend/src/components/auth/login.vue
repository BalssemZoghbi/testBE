<template>
  <form v-on:submit.prevent="loginn">
    <h1>login</h1>
    <br />

    <div class="mb-3">
      <label for="email" class="form-label">email</label>
      <input
        class="form-control"
        placeholder="email"
        type="email"
        id="email"
        v-model="email"
      />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">password</label>
      <input
        class="form-control"
        type="password"
        placeholder="password"
        id="password"
        v-model="password"
      />
    </div>
   
    <button type="submit" @click="login()" class="btn btn-primary mb-3" :class="{'disabled': !validateFields}" >
      <span v-if="status=='loading'"> connexion en cours ..</span>
      <span v-else> connexion</span>
    </button>
  </form>
</template>

<script>
import {mapState} from 'vuex';
export default {
  data() {
    return {
      email: "",
      password: ""
    };
  },
  computed:{
    validateFields:function(){
      if(this.email!="" && this.password!=""){
        return true;
      }else{
        return false;
      }
    },
    ...mapState(['status'])

  },
 
  methods: {
    login() {
      let self = this
      this.$store.dispatch('login',{
        email:this.email,
        password:this.password
      })
      .then(function(response){
        console.log(response);
         self.$router.push('/');
      })
      .error(function(error){
        console.log(error);
      })
      
    },
  },
};
</script>

<style scoped>
form {
  width: 50%;
  height: 50%;
  margin-left: 20%;
}
</style>
