<template>
  <form v-on:submit.prevent="storeprojet">
    <br />
    <label for="appareil">appareil</label>
    <input type="text" id="appareil" v-model="appareil"/> <br /><br />
    <label for="reference">reference</label>
    <input type="text" id="reference" v-model="reference" /><br /><br />
    <label for="client">client</label>
    <input type="text" id="client" v-model="client" /><br /><br />
    <label for="elaborateur">elaborateur</label>
    <input type="text" id="elaborateur"  v-model="elaborateur"/><br /><br />
    <label for="refClient">refClient</label>
    <input type="text" id="refClient" v-model="refClient" /><br /><br />
    <button type="submit">submit</button>
  </form>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
import router from "vue-router";
export default {
  data() {
    return {
      appareil: "",
      reference: "",
      client: "",
      elaborateur: "",
      refClient: "",
    };
  },
  methods:{
    storeprojet(){
      const projet = { 
        id:undefined,
        appareil: this.appareil,
        reference: this.reference,
        client: this.client,
        elaborateur: this.elaborateur,
        refClient: this.refClient
      };
      ProjetService.createProjet(projet).then(response => this.id = response.data.id);
      router.push({ path: '/', replace: true })
    }
  },
};
</script>
