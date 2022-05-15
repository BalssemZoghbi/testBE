<template>
  <v-app>
 
    <v-main>
      <!-- <h1 >transparent</h1> -->
      <!-- <login/> -->
      <router-view />
      <!-- <div class="loading">
      <font-awesome-icon icon="spinner" spin class="mr-3" /> loading...
    </div> -->
    </v-main>
  </v-app>
</template>

<script>
import login from "./views/Login.vue"
export default {
  name: "App",
  component:{
    login,
  },
  data: () => ({
    //
  }),
};
</script>
<style >


</style>