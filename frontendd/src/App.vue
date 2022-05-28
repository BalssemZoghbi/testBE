<template>
  <v-app>
    <v-main>
      <NavDash  v-if="((this.$route.path).indexOf('Connexion'))<0"  />
      <router-view />
       </v-main>
  </v-app>
</template>

<script>
import NavDash from "./components/NavDash.vue";

export default {
  name: "App",
  components:{
    NavDash,
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