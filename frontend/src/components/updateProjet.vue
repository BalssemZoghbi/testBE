<template>
  <form v-on:submit.prevent="updateprojet">
    <br />
    <label for="appareil">appareil</label>
    <input type="text" id="appareil" v-model="projet.appareil" /> <br /><br />
    <label for="reference">reference</label>
    <input type="text" id="reference" v-model="projet.reference" /><br /><br />
    <label for="client">client</label>
    <input type="text" id="client" v-model="projet.client" /><br /><br />
    <label for="elaborateur">elaborateur</label>
    <input type="text" id="elaborateur"  v-model="projet.elaborateur"/><br /><br />
    <label for="refClient">refClient</label>
    <input type="text" id="refClient" v-model="projet.refClient" /><br /><br />
    <button type="submit">submit</button>

  </form>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
// import { reactive } from "vue";
  // import axios from "axios";
export default {
  data() {
    return {
        projet:{
            appareil: "",
            reference: "",
            client: "",
            elaborateur: "",
            refClient: ""
      }
    };
  },
  methods:{
    updateprojet(){
      const projets = { 
        id:undefined,
        appareil: this.projet.appareil,
        reference: this.projet.reference,
        client: this.projet.client,
        elaborateur: this.projet.elaborateur,
        refClient: this.projet.refClient
      };
      console.log(projets);
      ProjetService.updateProjet(this.$route.params.id,projets).then(response => this.id = response.data.id);
    }
  },
  async mounted(){
    const result = await ProjetService.getProjetById(this.$route.params.id);
    this.projet=result.data.data;
    console.log(result.data);
  }
};
</script>
