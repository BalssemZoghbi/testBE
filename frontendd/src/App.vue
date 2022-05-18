<template>
  <v-app>
 
    <v-main>
      <!-- <h1 >transparent</h1> -->
      <NavDash />
      <router-view />
      <!-- <div class="loading">
      <font-awesome-icon icon="spinner" spin class="mr-3" /> loading...
    </div> -->
    </v-main>
  </v-app>
</template>

<script>
import NavDash from "./components/NavDash.vue";
export default {
  name: "App",
  component:{
    NavDash,
  },
  data: () => ({
    //
  }),
   mounted() {
    let user = localStorage.getItem("user");
    if (!user) {
      this.$router.push("/Connexion");
    }
  },
};
</script>
<style >


</style>