<template>
  <nav>
      <div class="logo"><a href="sacemindustries.com"
                    ><img
                      src="../assets/sacem.png"
                      width="150px"
                      alt="sacemindustries"
                  /></a></div>
      <input type="checkbox" id="click">
      <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
      </label>
      <ul>
        <li><router-link class="nav-link active" to="/">Accueil</router-link></li>
         <!-- :to="'/projet/update/'+this.createprojet.id" -->
        <li><button class="nav-link" @click="create()" >Crée</button></li>
		 <li><router-link class="nav-link" to="/dashboard">Tableau de bord</router-link></li>
        <li><router-link class="nav-link" to="">Importer</router-link></li>
        <li><button class="nav-link "  @click="logout()"><v-icon >fas fa-sign-out-alt</v-icon>
</button></li>
      </ul>
    </nav>
</template>
<script>
import axios from "axios"; 

 export default {
  name: "navbar",
   data: () => ({
    createprojet:{}
   }),
  methods:{
    logout(){
      // localStorage.clear();
      // this.$router.push('/login');
     localStorage.removeItem('token');
      this.$store.dispatch('user',null);
      this.$router.push("/login");
    },
    create(){
     let token= localStorage.getItem('token')
       axios.post('projets/create',{}, {
    headers: {
    'Authorization': token
    }
  }).then(
        (response) => (
          this.createprojet = response.data,
          this.$router.push('/projet/update/'+response.data.id))
      );
      

    }
  }
};
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

nav{
  display: flex;
  height: 80px;
  width: 100%;
  background: #a2c7ff;
  align-items: center;
  justify-content: space-between;
  padding: 0 50px 0 100px;
  flex-wrap: wrap;
}
nav .logo{
  color: #fff;
  font-size: 35px;
  font-weight: 600;
}
nav ul{
  display: flex;
  flex-wrap: wrap;
  list-style: none;
}
nav ul li{
  margin: 0 5px;
}
nav ul li .nav-link{
  color: rgb(234, 243, 246);
  text-decoration: none;
  font-size: 18px;
  font-weight: 500;
  margin-top: -14%;
  padding: 8px 15px;
  border-radius: 5px;
  letter-spacing: 1px;
  transition: all 0.3s ease;
}
nav ul li .nav-link.active,
nav ul li .nav-link:hover{
  color: #366ca8;
  background: #fff;
}
nav .menu-btn i{
  color: #fff;
  font-size: 22px;
  cursor: pointer;
  display: none;
}
input[type="checkbox"]{
  display: none;
}
@media (max-width: 1000px){
  nav{
    padding: 0 40px 0 50px;
  }
}
@media (max: width 1000px) {
  nav .menu-btn i{
    display: block;
  }
  #click:checked ~ .menu-btn i:before{
    content: "\f00d";
	/* content: icon; */
  }
  nav ul{
    position: fixed;
    top: 80px;
    left: -100%;
    background: rgb(226, 234, 150);
    height: 100vh;
    width: 100%;
    text-align: center;
    display: block;
    transition: all 0.3s ease;
  }
  #click:checked ~ ul{
    left: 0;
  }
  nav ul li{
    width: 100%;
    margin: 40px 0;
  }
  nav ul li a{
    width: 100%;
    margin-left: -100%;
    display: block;
    font-size: 20px;
    transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  }
  #click:checked ~ ul li a{
    margin-left: 0px;
  }
  nav ul li a.active,
  nav ul li a:hover{
    background: none;
    color: cyan;
  }
}


</style>