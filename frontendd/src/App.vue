<template>
  <v-app>
    <v-main>
      <NavDash v-if="((this.$route.path).indexOf('Connexion'))<0&&((this.$route.path).indexOf('forgot'))<0&&((this.$route.path).indexOf('reset'))<0" :conducteurMT="projet.conducteurMT"  :conducteurBT="projet.conducteurBT" />
      <router-view />
       </v-main>
  </v-app>
</template>

<script>
import NavDash from "./components/NavDash.vue";
import axios from "axios";
export default {
  name: "App",
  components:{
    NavDash,
  },
  data: () => ({
    projet:[],
  }),
async created(){
  const result = await axios.get("projets/"  + this.$route.params.id);
this.$store.dispatch("projet", result.data);
    this.projet = result.data;
    console.log(this.projet.conducteurMT,this.projet.conducteurBT);
 }
  
};
</script>
<style scoped>

</style>