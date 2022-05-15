<template>
  <v-app>
 
    <v-main>
      <!-- <h1 >transparent</h1> -->
      <NavDash />
      <router-view />
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
  
};
</script>
<style >


</style>