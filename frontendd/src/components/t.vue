<template>
  <nav>
    <v-app-bar color="#366ca8" dark app>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title class="text">
        <!-- <span class="font-weight-light">Sacem</span>
        <span>autocite</span>    -->
        <navbarUpdate/>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <!-- projetnav -->
      <!-- <div v-if="links.route='/' ">
       
        <li><button class="nav-link" @click="create()" >Crée</button></li>
        
        <li><button class="nav-link "  @click="logout()"><v-icon >fas fa-sign-out-alt</v-icon>
</button></li>
       -->
      <v-spacer></v-spacer><ul >
        <li><router-link class="nav-link" to=""><i class="fa-solid fa-file-import"></i></router-link></li></ul>
      <v-menu offset-y>
      <template v-slot:activator="{ on }">
      <!-- <v-icon v-on="on" dark>mdi-account-circle</v-icon> -->
            <span style="cursor: pointer" v-bind="attrs" v-on="on">
          <v-chip link>
            <v-badge dot bottom color="green" offset-y="10" offset-x="10">
              <v-avatar size="40">
               <v-icon v-on="on" dark>mdi-account-circle</v-icon>
              </v-avatar>
            </v-badge>
            <span class="ml-3">{{ user.name }}</span>
          </v-chip>
        </span>
      </template>
      <v-card
    class="mx-auto"
    max-width="300"
    tile
  >

    <v-list width="250" class="py-0">
      <!-- <v-subheader>Espace {{ user.name }}</v-subheader> -->
           <v-list-item two-line>
          <v-list-item-avatar>
            <img src="https://randomuser.me/api/portraits/women/81.jpg" />
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>{{ user.name }}</v-list-item-title>
            <v-list-item-subtitle>Connecter</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-divider />
      <v-spacer></v-spacer>
      <v-list-item router>
         <v-list-item-action>
           <v-icon small>fas fa-sign-out-alt</v-icon>
         </v-list-item-action>
         <v-list-item-content>
           <!-- <v-flex> --><v-list-item-title>
          <a class="nav-link"  @click="logout" >Logout</a>
         <!-- </v-flex> --></v-list-item-title>
         </v-list-item-content>
        </v-list-item>
        
        <v-list-item router>
         <v-list-item-action>
           <v-icon small color="black">mdi-account</v-icon>
         </v-list-item-action>
         <v-flex class="mt-4 mb-4">
                <Profile />
          </v-flex>
        </v-list-item>
    </v-list>
      </v-card>
            </v-menu>
            <!-- <nav align="center">{{ user.name }}</nav> -->
    </v-app-bar>
      <v-spacer></v-spacer>
    <v-navigation-drawer  v-model="drawer" dark app class="main-sidebar sidebar-dark-primary elevation-4">
      <v-list-item class="px-2 py-5"> <img
                      src="../assets/trans.png"
                      width="42%"
                      alt="sacemindustries"
                  />
            <v-list-item-title class="text-capitalize" align="center">
             
                <!-- <v-icon x-large color="#EB800E">fas fa-balance-scale</v-icon>  -->
                <span class="brand-text titel"><b>SACEM</b></span>
            </v-list-item-title>
        </v-list-item>
          <v-list flat>
              <v-list-item  v-for="link in links" :key="link.text" router :to="link.route">
                  <v-list-item-action>
                     <v-icon >{{link.icon}}</v-icon>
                  </v-list-item-action>
                  <v-list-item-content >
                      <v-list-item-title >{{link.text}}</v-list-item-title>
                  </v-list-item-content>
              </v-list-item>
               <v-menu
      :rounded="rounded"
      offset-y
    >
      <template v-slot:activator="{ on, attrs }">
         <v-list flat>
            <v-list-item >
        <v-list-item-action>
         <v-icon >fa-solid fa-bars-staggered</v-icon></v-list-item-action>
       <v-list-item-content >
        <v-list-item-title
          color="primary"
          class="white--text ma-5"
          v-bind="attrs"
          v-on="on"
        >

          Paramétres
        </v-list-item-title></v-list-item-content > </v-list-item ></v-list>
      </template>

      <v-list color="primary" dark >
        <v-list-item style="color: rgba(0, 0, 0, 0.87);"
        >
          <v-list-item-title >Garantie</v-list-item-title>
        </v-list-item>
        <v-list-item
        >
          <v-list-item-title>Bobinage</v-list-item-title>
        </v-list-item>
       
      </v-list>
    </v-menu>
          </v-list>
      </v-navigation-drawer>
   <Footer/>   
  </nav>
</template>
<script>
import Footer from '@/components/Footer';
import Profile from '@/components/Profile';
import navbarUpdate from '@/components/navbarUpdate';
import axios from 'axios';
import { mapGetters } from 'vuex';

  export default {
    components: {
    Footer,
    Profile,
    navbarUpdate
  },  data() {
    
    return {
      
      search: '',
      token:null,
      // user: '',
      email: '',
    drawer: true,
    links: [{ icon: "fas fa-tachometer-alt", text: "Tableau de bord", route: "/dashboard" },
    { icon: "apps", text: "projet", route: "/" },
    { icon: "fa-solid fa-user", text: "Utilisateur", route: "/user" },
    { icon: "fa-solid fa-bars-staggered", text: "Garantie", route: "/garantie24" },
    { icon: "fa-solid fa-table-cells", text: "Bobinage", route: "/saillie" },
    ]
  }
},
methods:{
logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      this.$store.dispatch('user',null);
      this.$router.push("/Connexion");
    },
},
async created() {
  const response=await axios.get('user');
    this.$store.dispatch('user',response.data);

  this.user=response.data;
},
computed: {
  ...mapGetters(['user'])
}
    
  }
</script>

<style scoped>
.border {
  border-left: 4px solid #0ba518;
}
.titel{
  padding:2px 8px ;
  font-size: 26px!important;
}
.sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active,
.sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
  background-color: #366ca8;
  color: #fff;
}
.lien{
  text-align: center;
  border-bottom:0px ;
  padding: .8125rem .5rem 0rem .5rem
}
.theme--dark.v-navigation-drawer {
    background-color: #366ca8;
}
img {
    width: 32%;
    margin-left: 0%;
    margin-top: -0%;
}
ul{
  display: flex;
  flex-wrap: wrap;
  list-style: none;
}
ul li{
  margin: 0 5px;
}
ul li .nav-link{
  color: rgb(234, 243, 246);
  text-decoration: none;
  font-size: 20px;
  font-weight: 500;
  margin-top: -14%;
  padding: 8px 15px;
  border-radius: 5px;
  letter-spacing: 1px;
  transition: all 0.3s ease;
}
ul li .nav-link.active,
ul li .nav-link:hover{
  color: #366ca8;
  background: #fff;
}
.menu-btn i{
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
 .menu-btn i{
    display: block;
  }
  #click:checked ~ .menu-btn i:before{
    content: "\f00d";
	/* content: icon; */
  }
 ul{
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
 ul li{
    width: 100%;
    margin: 40px 0;
  }
 ul li a{
    width: 100%;
    margin-left: -100%;
    display: block;
    font-size: 20px;
    transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  }
  #click:checked ~ ul li a{
    margin-left: 0px;
  }
 ul li a.active,
 ul li a:hover{
    background: none;
    color: cyan;
  }}
.theme--dark.v-chip:not(.v-chip--active) {
    background: #156397;
}
</style>
