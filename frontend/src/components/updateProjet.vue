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
      <label for="elaborateur" class="form-label">elaborateur</label>
      <input
        type="text"
        class="form-control"
        placeholder="Elaborateur"
        id="elaborateur"
        v-model="projet.elaborateur"
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
        elaborateur: "",
        refClient: "",
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
        elaborateur: this.projet.elaborateur,
        refClient: this.projet.refClient,
      };
      console.log(projets);
      ProjetService.updateProjet(this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id)
      );
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
