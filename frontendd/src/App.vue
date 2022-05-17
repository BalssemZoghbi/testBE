<template>
  <v-app>
 
    <!-- <v-main> -->
      <!-- <h1 >transparent</h1> -->
      <NavDash v-if="((this.$route.path).indexOf('Connexion'))<0" />
      <router-view />
      <!-- <div class="loading">
      <font-awesome-icon icon="spinner" spin class="mr-3" /> loading...
    </div> -->
    <!-- </v-main> -->
  </v-app>
</template>

<script>
// import NavDash from "./components/NavDash.vue";
import NavDash from "./components/NavDash.vue";
export default {
  name: "App",
  components:{
    NavDash,
  },
  data: () => ({
    //
  }),
  
};
</script>
<style >


</style>