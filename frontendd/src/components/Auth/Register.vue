<template>
<div class="body">
    <div class="center">
      <img src="../../assets/sacem.png">
      <h1>Bienvenue</h1>
      <form v-on:submit.prevent="register" method="post">
           <div class="txt_field">
          <input type="text" id="name"
        v-model="name" required>
          <span></span>
          <label>Nom</label>
        </div>
        <div class="txt_field">
          <input type="email" id="email"
        v-model="email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" id="password"
        v-model="password" required>
          <span></span>
          <label>Mot de passe</label>
        </div>
         <div class="txt_field">
          <input type="password" id="password_confirm"
        v-model="password_confirm" required>
          <span></span>
          <label>Confirmé le mot de passe</label>
        </div>
        <input type="submit" @click="createAccount()" :class="{'disabled': !validateFields}" value="Inscription">
        <div class="signup_link">
          Vous avez deja un compte! <router-link  to="/login">Connecter</router-link>

        </div>
      </form>
    </div>
    </div>
</template>

<script>
import axios from "axios";
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
    async createAccount() {
      let self = this
      let result= await axios.post("/register",{
        email:this.email,
        name:this.name,
        password:this.password,
        password_confirm:this.password_confirm,
      });
      console.log(result);
      if(result.status==200){
        self.$router.push('/login');
      }

    },
  },
};
</script>

<style scoped>
img{
     width: 32%;
    /* height: 23%; */
    margin-left: 30%;
    margin-top: 11px;
    margin-bottom: -5%;
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
