<template>
  <div class="about">
    <h1>This is an about projet {{ projet.id}}</h1>
    <h3> reference : {{ projet.reference}}</h3>
    <h3> appareil : {{ projet.appareil}}</h3>
    <h3> client : {{ projet.client}}</h3>
    <h3> elaborateur : {{ projet.elaborateur}}</h3>
    <h3> reference Client : {{ projet.refClient}}</h3>
  </div>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
export default {
  name: "about",
  data() {
    return {
      projet: Object,
    };
  },
  created() {
    ProjetService.getProjetById(this.$route.params.id).then((resp) => {
      this.projet = resp.data.data;
      console.log(this.projet)
    });
  },
};
</script>
