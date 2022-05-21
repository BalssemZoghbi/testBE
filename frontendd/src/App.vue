<template>
  <v-app>
    <v-main>
      <!-- <h1>balssem</h1> -->
      <NavDash  v-if="((this.$route.path).indexOf('Connexion'))<0"  />
    <!-- <NavDashEmp v-if="user.type== 'employe'&&((this.$route.path).indexOf('Connexion'))<0" /> -->
      <!-- <NavDash v-if="((this.$route.path).indexOf('Connexion'))<0" /> -->
      <Connexion v-if="((this.$route.path).indexOf('Connexion'))>0" />
      <!-- <router-view /> -->
       </v-main>
  </v-app>
</template>

<script>
// import NavDash from "./components/NavDash.vue";
import NavDash from "./components/NavDash.vue";
import Connexion from "./components/Auth/Connexion.vue";

export default {
  name: "App",
  components:{
    NavDash,
    Connexion
  },
  data: () => ({
    //
  }),
 mounted(){
   
 }
  
};
</script>
<style scoped>

</style>