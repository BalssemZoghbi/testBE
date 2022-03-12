<template>
  <form v-on:submit.prevent="updateprojet">
    <h1>changer le projet n° {{ projet.id }}</h1>
    <br />
    <div class="mb-3">
      <label for="appareil" class="form-label">appareil</label>
      <input
        type="text"
        class="form-control"
        placeholder="Appareil"
        id="appareil"
        v-model="projet.appareil"
      />
    </div>
    <div class="mb-3">
      <label for="reference" class="form-label">reference</label>
      <input
        type="text"
        class="form-control"
        placeholder="Reference"
        id="reference"
        v-model="projet.reference"
      />
    </div>
    <div class="mb-3">
      <label for="client" class="form-label">client</label>
      <input
        type="text"
        class="form-control"
        placeholder="Client"
        id="client"
        v-model="projet.client"
      />
    </div>

    <div class="mb-3">
      <label for="refClient" class="form-label">refClient</label>
      <input
        type="text"
        class="form-control"
        placeholder="RefClient"
        id="refClient"
        v-model="projet.refClient"
      />
    </div>
      <div class="mb-3">
      <label for="temperatureMax" class="form-label">temperatureMax</label>
      <input
        class="form-control"
        type="text"
        placeholder="temperatureMax"
        id="temperatureMax"
        v-model="temperatureMax"
      />
    </div>
    <div class="mb-3">
      <label for="attitudeMax" class="form-label">attitudeMax</label>
      <input
        class="form-control"
        type="text"
        placeholder="attitudeMax"
        id="attitudeMax"
        v-model="attitudeMax"
      />
    </div>
    <div class="mb-3">
      <label for="type" class="form-label">type</label>
      <input
        class="form-control"
        type="text"
        placeholder="type"
        id="type"
        v-model="type"
      />
    </div>
    <div class="mb-3">
      <label for="remplissage" class="form-label">remplissage</label>
      <input
        class="form-control"
        type="text"
        placeholder="remplissage"
        id="remplissage"
        v-model="remplissage"
      />
    </div>
    <div class="mb-3">
      <label for="installation" class="form-label">installation</label>
      <input
        class="form-control"
        type="text"
        placeholder="installation"
        id="installation"
        v-model="installation"
      />
    </div>
    <div class="mb-3">
      <label for="echangeurs" class="form-label">echangeurs</label>
      <input
        class="form-control"
        type="text"
        placeholder="echangeurs"
        id="echangeurs"
        v-model="echangeurs"
      />
    </div>
    <div class="mb-3">
      <label for="dielectrique" class="form-label">dielectrique</label>
      <input
        class="form-control"
        type="text"
        placeholder="dielectrique"
        id="dielectrique"
        v-model="dielectrique"
      />
    </div>
    <div class="mb-3">
      <label for="refroidissement" class="form-label">refroidissement</label>
      <input
        class="form-control"
        type="text"
        placeholder="refroidissement"
        id="refroidissement"
        v-model="refroidissement"
      />
    </div>

    <button type="submit" class="btn btn-primary mb-3">Changer</button>
  </form>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
// import { reactive } from "vue";
// import axios from "axios";
export default {
  data() {
    return {
      projet: {
       appareil: "",
      reference: "",
      client: "",
      refClient: "",
      temperatureMax: "",
      attitudeMax: "",
      type: "",
      remplissage: "",
      installation: "",
      echangeurs: "",
      dielectrique: "",
      fonctionnement: "",
      refroidissement: "",
      },
    };
  },
  methods: {
    updateprojet() {
      const projets = {
        id: undefined,
        appareil: this.projet.appareil,
        reference: this.projet.reference,
        client: this.projet.client,
        refClient: this.projet.refClient,
         temperatureMax:this.projet.temperatureMax,
        attitudeMax: this.projet.attitudeMax,
        type: this.projet.type,
        remplissage: this.projet.remplissage,
        installation: this.projet.installation,
        echangeurs: this.projet.echangeurs,
        dielectrique: this.projet.dielectrique,
        fonctionnement: this.projet.fonctionnement,
        refroidissement: this.projet.refroidissement,
      };
      console.log(projets);
      ProjetService.updateProjet(this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id)
       
      );
       console.log(this.projets);
      this.$router.push({ name: "Home" });
    },
  },
  async mounted() {
    const result = await ProjetService.getProjetById(this.$route.params.id);
    this.projet = result.data.data;
  },
};
</script>
<style scoped>
form {
  width: 50%;
  height: 50%;
  margin-left: 20%;
}
</style>
