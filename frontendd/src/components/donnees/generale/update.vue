<template>
<form v-on:submit.prevent="updateprojet">
    <h1>changer le projet n° {{ projet.id }}</h1>
    <br />
    <div class="mb-3">
      <label for="appareil" class="form-label">appareil:  </label>
      <input
        type="text"
        class="form-control"
        placeholder="Appareil"
        id="appareil"
        v-model="projet.appareil"
      />
    </div>
    <div class="mb-3">
      <label for="reference" class="form-label">reference   </label>
      <input
        type="text"
        class="form-control"
        placeholder="Reference"
        id="reference"
        v-model="projet.reference"
      />
    </div>
    <div class="mb-3">
      <label for="client" class="form-label">client  </label>
      <input
        type="text"
        class="form-control"
        placeholder="Client"
        id="client"
        v-model="projet.client"
      />
    </div>

    <div class="mb-3">
      <label for="refClient" class="form-label">refClient  </label>
      <input
        type="text"
        class="form-control"
        placeholder="RefClient"
        id="refClient"
        v-model="projet.refClient"
      />
    </div>
      <div class="mb-3">
      <label for="temperatureMax" class="form-label">temperatureMax  </label>
      <input
        class="form-control"
        type="text"
        placeholder="temperatureMax"
        id="temperatureMax"
        v-model="projet.temperatureMax"
      />
    </div>
    <div class="mb-3">
      <label for="attitudeMax" class="form-label">attitudeMax  </label>
      <input
        class="form-control"
        type="text"
        placeholder="attitudeMax"
        id="attitudeMax"
        v-model="projet.attitudeMax"
      />
    </div>
    <div class="mb-3">
      <label for="type" class="form-label">type  </label>
      <input
        class="form-control"
        type="text"
        placeholder="type"
        id="type"
        v-model="projet.type"
      />
    </div>
    <div class="mb-3">
      <label for="remplissage" class="form-label">remplissage  </label>
      <input
        class="form-control"
        type="text"
        placeholder="remplissage"
        id="remplissage"
        v-model="projet.remplissage"
      />
    </div>
    <div class="mb-3">
      <label for="installation" class="form-label">installation  </label>
      <input
        class="form-control"
        type="text"
        placeholder="installation"
        id="installation"
        v-model="projet.installation"
      />
    </div>
    <div class="mb-3">
      <label for="montage" class="form-label">montage  </label>
      <input
        class="form-control"
        type="text"
        placeholder="montage"
        id="montage"
        v-model="projet.montage"
      />
    </div>
    <div class="mb-3">
      <label for="echangeurs" class="form-label">echangeurs  </label>
      <input
        class="form-control"
        type="text"
        placeholder="echangeurs"
        id="echangeurs"
        v-model="projet.echangeurs"
      />
    </div>
    <div class="mb-3">
      <label for="dielectrique" class="form-label">dielectrique  </label>
      <input
        class="form-control"
        type="text"
        placeholder="dielectrique"
        id="dielectrique"
        v-model="projet.dielectrique"
      />
    </div>
    <div class="mb-3">
      <label for="fonctionnement" class="form-label">fonctionnement  </label>
      <input
        class="form-control"
        type="text"
        placeholder="fonctionnement"
        id="fonctionnement"
        v-model="projet.fonctionnement"
      />
    </div>
    <div class="mb-3">
      <label for="refroidissement" class="form-label">refroidissement  </label>
      <input
        class="form-control"
        type="text"
        placeholder="refroidissement"
        id="refroidissement"
        v-model="projet.refroidissement"
      />
    </div>
    <div class="mb-3">
      <label for="user_id" class="form-label">elaborateur  </label>
      <input
        class="form-control"
        type="text"
        placeholder="user_id"
        id="user_id"
        v-model="projet.user_id"
      />
    </div>

    <button type="submit" class="btn btn-primary mb-3">Changer</button>
  </form>
</template>

<script>
// import { reactive } from "vue";
import axios from "axios";
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
      montage: "",
      echangeurs: "",
      dielectrique: "",
      fonctionnement: "",
      refroidissement: "",
      user_id: "",
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
        montage: this.projet.montage,
        echangeurs: this.projet.echangeurs,
        dielectrique: this.projet.dielectrique,
        fonctionnement: this.projet.fonctionnement,
        refroidissement: this.projet.refroidissement,
        user_id: this.projet.user_id,
      };
      axios.put('projets/edit/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id, console.log(response.data))
        
      );
      this.$router.push({ name: "Home" });
    },
  },
  async mounted() {
    const result = await axios.get('projets/'+this.$route.params.id);
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