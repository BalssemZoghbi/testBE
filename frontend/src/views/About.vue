
<template>
  <div class="about">
    <h1>This is an about projet {{ projet.id }}</h1>
    <h3>reference : {{ projet.reference }}</h3>
    <h3>appareil : {{ projet.appareil }}</h3>
    <h3>client : {{ projet.client }}</h3>
    <h3>elaborateur : {{ projet.elaborateur }}</h3>
    <h3>reference Client : {{ projet.refClient }}</h3>
    <h3>temperatureMax : {{ projet.temperatureMax }}</h3>
    <h3>attitudeMax : {{ projet.attitudeMax }}</h3>
    <h3>type : {{ projet.type }}</h3>
    <h3>remplissage : {{ projet.remplissage }}</h3>
    <h3>installation : {{ projet.installation }}</h3>
    <h3>echangeurs : {{ projet.echangeurs }}</h3>
    <h3>dielectrique : {{ projet.dielectrique }}</h3>
    <h3>fonctionnement : {{ projet.fonctionnement }}</h3>
    <h3>refroidissement : {{ projet.refroidissement }}</h3>
  </div>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
export default {
  name: "about",
  data() {
    return {
      projet: Object,
      user:{
      }
    };
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
