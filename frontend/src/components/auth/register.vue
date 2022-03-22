<template>
<div class="body">
    <div class="center">
      <img src="../../assets/ava.svg">
      <h1>WELCOME</h1>
      <form v-on:submit.prevent="register" method="post">
           <div class="txt_field">
          <input type="text" id="name"
        v-model="name" required>
          <span></span>
          <label>Name</label>
        </div>
        <div class="txt_field">
          <input type="email" id="email"
        v-model="email" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" id="password"
        v-model="password" required>
          <span></span>
          <label>Password</label>
        </div>
         <div class="txt_field">
          <input type="password" id="password_confirm"
        v-model="password_confirm" required>
          <span></span>
          <label>Confirmed Password</label>
        </div>
        <input type="submit" @click="createAccount()" :class="{'disabled': !validateFields}" value="Register">
        <div class="signup_link">
          already have an account! <router-link  to="/login">Login</router-link>

        </div>
      </form>
    </div>
    </div>
</template>

<script>
// import AuthService from "@/services/AuthService.js";
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirm:""
    };
  },
  computed:{
    validateFields:function(){
      if(this.email!="" && this.name!="" && this.password!="" &&this.password_confirm!="" ){
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
        password:this.password,
        password_confirm:this.password_confirm
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

img{
  width: 455px;
  height: 100px;
  margin-top: 20px;
}
h1{
	color: #fff;
	text-transform: uppercase;
	font-size: 2.9rem;
}
.body{
  margin: 0;
  padding: 0;
  background: white;
  height: 100vh;
  overflow: hidden;
}
.center{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 480px;
  background: #3895d3;
  border-radius: 10px;
  box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
}
.center h1{
  text-align: center;
  padding: 20px 0;
  border-bottom: 1px solid white;
}
.center form{
  padding: 0 40px;
  box-sizing: border-box;
}
form .txt_field{
  position: relative;
  border-bottom: 2px solid white;
  margin: 30px 0;
}
.txt_field input{
  width: 100%;
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
}
.txt_field label{
  position: absolute;
  top: 50%;
  left: 5px;
  color: white;
  transform: translateY(-50%);
  font-size: 16px;
  pointer-events: none;
  transition: .5s;
}
.txt_field span::before{
  content: '';
  position: absolute;
  top: 40px;
  left: 0;
  width: 0%;
  height: 2px;
  background: white;
  transition: .5s;
}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
  top: -5px;
  color: white;
}
.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{
  width: 100%;
}
.pass{
  margin: -5px 0 20px 5px;
  color: white;
  cursor: pointer;
}
.pass:hover{
  text-decoration: underline;
}
input[type="submit"]{
  width: 100%;
  height: 50px;
  border: 1px solid;
  background: white;
  border-radius: 25px;
  font-size: 18px;
  color: #3895d3;
  font-weight: 700;
  cursor: pointer;
  outline: none;
}
input[type="submit"]:hover{
  border-color: white;
  transition: .5s;
}
.signup_link{
  margin: 30px 0;
  text-align: center;
  font-size: 16px;
  color: #242121;
}
.signup_link a{
  color: white;
  text-decoration: none;
}
.signup_link a:hover{
  text-decoration: underline;
}
</style>
