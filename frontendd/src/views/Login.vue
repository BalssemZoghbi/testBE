<template>
<div class="body">
    <div class="center">
      <!-- <img src="../../assets/ava.svg"> -->
      <h1>WELCOME</h1>
      <form v-on:submit.prevent="loginn" method="post">
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
        <div class="pass">Forgot Password?</div>
        <input type="submit" @click="login()" :class="{'disabled': !validateFields}" value="Login">
        <div class="signup_link">
          Not a member? <router-link  to="/register">Signup</router-link>
        </div>
      </form>
    </div>
    </div>
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
 async login() {
      let self = this
    await this.$store.dispatch('login',{
        email:this.email,
        password:this.password
      })
      .then(function(response){
        console.log(response);
         self.$router.push('/');
      })
      .catch(function(error){
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
	color: #333;
	text-transform: uppercase;
	font-size: 2.9rem;
}
.body{
  margin: 0;
  padding: 0;
  background: linear-gradient(120deg,#2980b9, #449dad);
  height: 100vh;
  overflow: hidden;
}
.center{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 450px;
  background: white;
  border-radius: 10px;
  box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
}
.center h1{
  text-align: center;
  padding: 20px 0;
  border-bottom: 1px solid silver;
}
.center form{
  padding: 0 40px;
  box-sizing: border-box;
}
form .txt_field{
  position: relative;
  border-bottom: 2px solid #adadad;
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
  color: #adadad;
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
  background: #2691d9;
  transition: .5s;
}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
  top: -5px;
  color: #2691d9;
}
.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{
  width: 100%;
}
.pass{
  margin: -5px 0 20px 5px;
  color: #a6a6a6;
  cursor: pointer;
}
.pass:hover{
  text-decoration: underline;
}
input[type="submit"]{
  width: 100%;
  height: 50px;
  border: 1px solid;
  background: #2691d9;
  border-radius: 25px;
  font-size: 18px;
  color: #e9f4fb;
  font-weight: 700;
  cursor: pointer;
  outline: none;
}
input[type="submit"]:hover{
  border-color: #2691d9;
  transition: .5s;
}
.signup_link{
  margin: 30px 0;
  text-align: center;
  font-size: 16px;
  color: #666666;
}
.signup_link a{
  color: #2691d9;
  text-decoration: none;
}
.signup_link a:hover{
  text-decoration: underline;
}

</style>
