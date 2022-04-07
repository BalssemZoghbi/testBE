<template>
  <v-app>
 
    <v-main>
      <!-- <login/> -->
      <router-view />
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