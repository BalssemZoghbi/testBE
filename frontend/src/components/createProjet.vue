<template>
<div>
 <navbar2 />
 <br>
  <form v-on:submit.prevent="storeprojet">
    <h1>Créer un nouveau projet</h1>
    <br />
    <div class="mb-3">
      <label for="appareil" class="form-label">appareil</label>
      <input
        class="form-control"
        type="text"
        placeholder="Appareil"
        id="appareil"
        v-model="appareil"
      />
    </div>
    <div class="mb-3">
      <label for="reference" class="form-label">reference</label>
      <input
        class="form-control"
        placeholder="Reference"
        type="text"
        id="reference"
        v-model="reference"
      />
    </div>
    <div class="mb-3">
      <label for="client" class="form-label">client</label>
      <input
        class="form-control"
        type="text"
        placeholder="Client"
        id="client"
        v-model="client"
      />
    </div>
    <div class="mb-3">
      <label for="elaborateur" class="form-label">elaborateur</label>
      <input
        class="form-control"
        type="text"
        placeholder="Elaborateur"
        id="elaborateur"
        v-model="elaborateur"
      />
    </div>
    <div class="mb-3">
      <label for="refClient" class="form-label">refClient</label>
      <input
        class="form-control"
        type="text"
        placeholder="RefClient"
        id="refClient"
        v-model="refClient"
      />
    </div>
    <button type="submit" class="btn btn-primary mb-3">Créer</button>
  </form>
</div>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";

import navbar2 from "@/components/navbar2";
export default {
  name: "createProjet",
  components: {
    navbar2,
  },
  data() {
    return {
      appareil: "",
      reference: "",
      client: "",
      elaborateur: "",
      refClient: "",
    };
  },
  methods: {
    storeprojet() {
      const projet = {
        id: undefined,
        appareil: this.appareil,
        reference: this.reference,
        client: this.client,
        elaborateur: this.elaborateur,
        refClient: this.refClient,
      };
      ProjetService.createProjet(projet).then(
        (response) => (this.id = response.data.id)
      );
      this.$router.push({ name: "Home" });
    },
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
