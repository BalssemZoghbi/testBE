<template>
  <div class="about">
    <h1>This is an about projet {{ projet.id }}</h1>
    <h3>reference : {{ projet.reference }}</h3>
    <h3>appareil : {{ projet.appareil }}</h3>
    <h3>client : {{ projet.client }}</h3>
    <h3>elaborateur : {{ projet.elaborateur }}</h3>
    <h3>reference Client : {{ projet.refClient }}</h3>
    <h1>user {{ this.user.id }} </h1>
    <h3>name : {{ this.name }}</h3>
    <h3>email  : {{ this.$store.state.user.email }}</h3>
    <h3>password : {{ this.$store.state.user.password }}</h3>
  </div>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
// import {mapState} from 'vuex';
export default {
  name: "about",
  data() {
    return {
      projet: Object,
      user:{
      }
    };
  },
  computed:{
    
  },
  created() {
    ProjetService.getProjetById(this.$route.params.id).then((resp) => {
      this.projet = resp.data.data;
      console.log(this.projet);
    });
  },
  mounted:function(){
    console.log(this.$store.state.user);
    if(this.$store.state.user.id==-1){
      this.$router.push('/login');
    }
    this.user=localStorage.getItem('user');
    console.log(this.user);
  }
};
</script>
