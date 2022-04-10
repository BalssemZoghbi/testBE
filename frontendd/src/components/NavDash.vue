<template>
  <nav>
    <v-app-bar color="#366ca8" dark app>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title class="text">
        <span class="font-weight-light">Sacem</span>
        <span>autocite</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-spacer></v-spacer>
      <v-menu offset-y>
      <template v-slot:activator="{ on }">
      <v-icon v-on="on" dark>mdi-account-circle</v-icon>
      </template>
      <v-card
    class="mx-auto"
    max-width="300"
    tile
  >

    <v-list dense>
      <v-subheader>Espace {{ user.name }}</v-subheader>
      <v-spacer></v-spacer>
      <v-list-item router>
         <v-list-item-action>
           <v-icon small>fas fa-sign-out-alt</v-icon>
         </v-list-item-action>
         <v-list-item-content>
           <v-flex>
          <a class="nav-link"  @click="logout" >Logout</a>
         </v-flex>
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
            <nav align="center">{{ user.name }}</nav>
    </v-app-bar>
      <v-spacer></v-spacer>
    <v-navigation-drawer  v-model="drawer" dark app class="main-sidebar sidebar-dark-primary elevation-4">
      <v-list-item class="px-2 py-5">
            <v-list-item-title class="text-capitalize" align="center">
                <!-- <v-icon x-large color="#EB800E">fas fa-balance-scale</v-icon>  -->
                <span class="brand-text titel"><b>Autocite</b>Pro</span>
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
          </v-list>
      </v-navigation-drawer>
   <Footer/>   
  </nav>
</template>
<script>
import Footer from '@/components/Footer';

import Profile from '@/components/Profile';
import axios from 'axios';
import { mapGetters } from 'vuex';

  export default {
    components: {
    Footer,
    Profile
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
    { icon: "fa-solid fa-user-check", text: "demande", route: "/demande" },
 { icon: "fa-solid fa-bars-staggered", text: "Garantie24", route: "/garantie24" },
    { icon: "fa-solid fa-table-cells", text: "Garantie36", route: "/garantie36" },
    ]
  }
},
methods:{
logout() {
      localStorage.removeItem('token');
      this.$store.dispatch('user',null);
      this.$router.push("/login");
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
</style>
