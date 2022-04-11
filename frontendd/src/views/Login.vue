<template>
<div class="body">
    <div class="center">
      <img src="../assets/logosacem.jpg">
      <h1>Bienvenue</h1>
      <form @submit.prevent="handleSubmit" method="post">
      <error v-if="error" :error="error"/>
        <div class="txt_field">
          <input type="email" id="email"
        v-model="email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" id="password" v-model="password" required>
          <span></span>
          <label>Mot de passe</label>
        </div>
        <div class="pass"><router-link class="nav-link"  to="/forgot">Mot de passe oublié ?</router-link></div>
        <input type="submit" :class="{'disabled': !validateFields}"  value="Connexion">
        <div class="signup_link">
          Vous n'etes pas un membre? <router-link  to="/register">Inscription</router-link>
        </div>
      </form>
    </div>
    </div>
</template>

<script>
import axios from "axios";
import Error from "@/components/Error"
import {mapState} from 'vuex';
export default {
name:'Login',
components:{
Error
},
data(){
  return{
    email:'',
    password:'' ,
    error:''
  }
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
methods:{
 async handleSubmit(){
   try{
      const response= await axios.post('/login',{
      email:this.email,
      password:this.password,

    });
   

  localStorage.setItem('token',response.data.token);
  this.$store.dispatch('user',response.data.user);
 this.$router.push('/dashboard');
  }catch(e){
    this.error=' Email ou mot de passe incorrect';
    
  }
  }
}


}
</script>

<style scoped>
img{
     width: 25%;
    /* height: 23%; */
    margin-left: 37%;
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
  /* margin-top: ; */
  margin:-20px 0 10px -10px;
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
