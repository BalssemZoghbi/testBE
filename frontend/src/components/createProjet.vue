<template>
<div>
<navbar2/>
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
      <label for="refClient" class="form-label">refClient</label>
      <input
        class="form-control"
        type="text"
        placeholder="RefClient"
        id="refClient"
        v-model="refClient"
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
      <label for="montage" class="form-label">montage</label>
      <input
        class="form-control"
        type="text"
        placeholder="montage"
        id="montage"
        v-model="montage"
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
      <label for="fonctionnement" class="form-label">fonctionnement</label>
      <input
        class="form-control"
        type="text"
        placeholder="fonctionnement"
        id="fonctionnement"
        v-model="fonctionnement"
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
    <div class="mb-3">
      <label for="user_id" class="form-label">user_id</label>
      <input
        class="form-control"
        type="text"
        placeholder="user_id"
        id="user_id"
        v-model="user_id"
      />
    </div>

    <button type="submit" class="btn btn-primary mb-3">Créer</button>
  </form>
</div>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
import navbar2 from './navbar2.vue';
export default {
  components: { navbar2 },
  data() {
    return {
      appareil: "",
      reference: "",
      client: "",
      refClient: "",
      temperatureMax: "",
      attitudeMax: "",
      type: "",
      remplissage: "",
      installation: "",
      montage: "",
      echangeurs: "",
      dielectrique: "",
      fonctionnement: "",
      refroidissement: "",
      user_id: "",
    };
  },
  methods: {
    storeprojet() {
      const projet = {
        id: undefined,
        appareil: this.appareil,
        reference: this.reference,
        client: this.client,
        refClient: this.refClient,
        temperatureMax: this.temperatureMax,
        attitudeMax: this.attitudeMax,
        type: this.type,
        remplissage: this.remplissage,
        installation: this.installation,
        montage: this.montage,
        echangeurs: this.echangeurs,
        dielectrique: this.dielectrique,
        fonctionnement: this.fonctionnement,
        refroidissement: this.refroidissement,
        user_id: this.user_id,
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