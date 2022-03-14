<template>
  <form v-on:submit.prevent="register">
    <h1>register</h1>
    <br />
    <div class="mb-3">
      <label for="name" class="form-label">name</label>
      <input
        class="form-control"
        type="text"
        placeholder="Appareil"
        id="name"
        v-model="name"
      />
    </div>
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
   
    <button type="submit" @click="createAccount()" class="btn btn-primary mb-3" :class="{'disabled': !validateFields}" >register</button>
  </form>
</template>

<script>
// import AuthService from "@/services/AuthService.js";
export default {
  data() {
    return {
      name: "",
      email: "",
      password: ""
    };
  },
  computed:{
    validateFields:function(){
      if(this.email!="" && this.name!="" && this.password!=""){
        return true;
      }else{
        return false;
      }
    }
  },
  methods: {
    createAccount() {
      const self=this;
      this.$store.dispatch('createAccount',{
        name:this.name,
        email:this.email,
        password:this.password
      })
      .then(function(response){
        console.log(response);
         self.$router.push('/login');
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
