<template>
  <div>
    <NavDash
      :conducteurMT="projet.conducteurMT"
      :conducteurBT="projet.conducteurBT"
    />
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <v-stepper-step step=""> Données Generale </v-stepper-step>
        <v-stepper-content step="1">
          <v-card class="mb-6">
            <div class="title">Données Generale</div>
            <div class="content">
              <form v-on:submit.prevent="updateprojet">
                <!-- <div class="user-details"> -->
                <div class="grid">
                  <div class="form__div">
                    <input
                      type="text"
                      class="form__input"
                      placeholder=" "
                      id="appareil"
                      v-model="projet.appareil"
                    />
                    <label for="" class="form__label">Appareil</label>
                  </div>
                  <div class="form__div">
                    <input
                      type="text"
                      class="form__input"
                      placeholder=" "
                      id="reference"
                      v-model="projet.reference"
                    />
                    <label for="" class="form__label">Reference</label>
                  </div>
                  <div class="input-box">
                    <div class="form__div">
                      <input
                        type="text"
                        class="form__input"
                        placeholder=" "
                        id="refClient"
                        v-model="projet.refClient"
                      />
                      <label for="" class="form__label">refClient</label>
                    </div>
                  </div>
                  <div class="form__div">
                    <input
                      type="text"
                      class="form__input"
                      placeholder=" "
                      id="client"
                      v-model="projet.client"
                    />
                    <label for="" class="form__label">Client</label>
                  </div>
                  <div class="form__div">
                    <input
                      type="text"
                      class="form__input"
                      placeholder=" "
                      id="user_id"
                      v-model="projet.elaborateur"
                    />
                    <label for="" class="form__label">Elaboré par</label>
                  </div>
                  <div class="form__div">
                    <input
                      type="number"
                      class="form__input"
                      placeholder=" "
                      id="temperatureMax"
                      v-model="projet.temperatureMax"
                    />
                    <label for="" class="form__label">temperatureMax</label>
                  </div>
                  <div class="form__div">
                    <input
                      type="number"
                      class="form__input"
                      placeholder=" "
                      id="attitudeMax"
                      v-model="projet.attitudeMax"
                    />
                    <label for="" class="form__label">attitudeMax</label>
                  </div>
                  <div class="form__div">
                    <v-select
                      :items="types"
                      label="type"
                      v-model="projet.type"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div">
                    <v-select
                      :items="remplissages"
                      label="remplissage"
                      v-model="projet.remplissage"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div">
                    <v-select
                      :items="installations"
                      label="installation"
                      v-model="projet.installation"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div">
                    <v-select
                      :items="montages"
                      label="montage"
                      v-model="projet.montage"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div">
                    <v-select
                      :items="dielectriques"
                      label="dielectrique"
                      v-model="projet.dielectrique"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div">
                    <v-select
                      :items="fonctionnements"
                      label="fonctionnement"
                      v-model="projet.fonctionnement"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div">
                    <v-select
                      :items="echangeurs"
                      label="Echangeurs"
                      v-model="projet.echangeurs"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div">
                    <v-select
                      :items="refroidissements"
                      label="Refroidissement"
                      v-model="projet.refroidissement"
                      dense
                      outlined
                    ></v-select>
                  </div>
                </div>
              </form>
            </div>
          </v-card>
          <router-link
            class="nav-link"
            :to="'/projet/electrique/update/' + projet.id"
            ><v-btn color="primary mb-14" @click="updateprojet">
              Valider
            </v-btn></router-link
          >
        </v-stepper-content>
      </v-stepper>
    </div>
  </div>
</template>
<script>
import NavDash from "@/components/NavDash.vue";
import axios from "axios";
export default {
  components: {
    NavDash,
  },
  data() {
    return {
      barre: [],
      types: ["cabine", "poteau", "h61", "h59", "sec"],
      remplissages: ["à matelas d`air", "integral", "respirant"],
      installations: ["interieure", "exterieure", "interieur&exterieure"],
      montages: ["sur galets", "sur pieds"],
      echangeurs: ["ondes", "radiateurs", "parois"],
      dielectriques: [
        "huile biodegradable",
        "huile minerale inhibée",
        "huile siliconne",
        "huile minerale non inhibée",
      ],
      fonctionnements: ["abaisseur", "elevateur", "isolement"],
      refroidissements: ["onan", "onaf"],
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
        elaborateur: "",
        user_id: "",
        garantie_id: "",
        electrique_id: "",
        bobinage_id: "",
        gradin_id: "",
        bobinage_secs_id: "",
        volt_spires_id: "",
        pcc_uccs_id: "",
        circuitmagnetiques_id: "",
      },
      e1: 1,
    };
  },
  methods: {
    updateprojet() {
      let token = localStorage.getItem("token");
      const projets = {
        id: undefined,
        appareil: this.projet.appareil,
        reference: this.projet.reference,
        client: this.projet.client,
        refClient: this.projet.refClient,
        temperatureMax: this.projet.temperatureMax,
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
        garantie_id: this.projet.garantie_id,
        electrique_id: this.projet.electrique_id,
        bobinage_id: this.projet.bobinage_id,
        gradin_id: this.projet.gradin_id,
        bobinage_secs_id: this.projet.bobinage_secs_id,
        volt_spires_id: this.projet.volt_spires_id,
        pcc_uccs_id: this.projet.pcc_uccs_id,
        circuitmagnetiques_id: this.projet.circuitmagnetiques_id,
        elaborateur: this.projet.elaborateur,
      };
      axios
        .put("projets/edit/" + this.$route.params.id, projets, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => (this.id = response.data.id));
    },
    getbarre() {
      axios
        .get("/getdesignationBarre")
        .then(
          (response) => ((this.barre = response.data), console.log(this.barre))
        );
    },
  },
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
  },
};
</script>
<style scoped>
.grid {
  display: grid;
  grid-template-columns: repeat(4, 3fr);
  grid-gap: 2%;
}
.form {
  width: 360px;
  padding: 4rem 2rem;
  border-radius: 1rem;
}
.form__title {
  font-weight: 400;
  margin-bottom: 3rem;
}
.form__div {
  position: relative;
  height: 48px;
  margin-bottom: 1.5rem;
}
.form__input {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 89%;
  font-size: 1rem;
  border: 1px solid rgb(152, 149, 149);
  border-radius:0.3rem;
  outline: none;
  padding: 1rem;
  background: none;
  z-index: 1;
}
.form__label {
  position: absolute;
  left: 1rem;
  top: 0.7rem;
  padding: 0 0.25rem;
  background-color: #fff;
  color: #000000ad;
  font-size: 1rem;
  transition: 0.3s;
}

/*Input focus move up label*/
.form__input:focus + .form__label {
  top: -0.5rem;
  left: 0.8rem;
  color: #4797d1;
  font-size: 0.75rem;
  font-weight: 500;
  z-index: 10;
}

/*Input focus sticky top label*/
.form__input:not(:placeholder-shown).form__input:not(:focus) + .form__label {
  top: -0.5rem;
  left: 0.8rem;
  font-size: 0.75rem;
  font-weight: 500;
  z-index: 1;
}

.form__input:focus {
  border: 1.5px solid #4797d1;
}

.body {
  height: 100%;
  padding: 20px;
  max-height: calc(100vh - 50px);
}
.title {
  font-size: 25px;
  font-weight: 500;
  margin-bottom: 3.5%;
  position: relative;
}
.title::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -4px;
  height: 3px;
  width: 250px;
  border-radius: 5px;
  background: linear-gradient(135deg, #0b65a0, #71b7e6);
}
.content form .user-details {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .user-details .input-box {
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
}
form .input-box span.details {
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}
.user-details .input-box input {
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  transition: all 0.3s ease;
}
form .gender-details .gender-title {
  font-size: 20px;
  font-weight: 500;
}
form .category {
  display: flex;
  width: 80%;
  margin: 14px 0;
  justify-content: space-between;
}
form .category label {
  display: flex;
  align-items: center;
  cursor: pointer;
}
form .category label .dot {
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}
#dot-1:checked ~ .category label .one,
#dot-2:checked ~ .category label .two,
#dot-3:checked ~ .category label .three {
  background: #71b7e6;
  border-color: #d9d9d9;
}
form input[type="radio"] {
  display: none;
}
form .button input {
  height: 100%;
  width: 100%;
  border-radius: 5px;
  border: none;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  letter-spacing: 1px;
  cursor: pointer;
  transition: all 0.3s ease;
  background: linear-gradient(135deg, #4797d1, #4797d1);
}
form .button input:hover {
  background: linear-gradient(-135deg, #71b7e6, #71b7e6);
}
.framei {
  width: 22%;
  justify-content: space-between;
}

.v-sheet.v-card:not(.v-sheet--outlined) {
  box-shadow: 0px 0px 0px 0px;
}
.v-stepper--vertical {
  padding-bottom: 0px;
}
@media (max-width: 1000px) {
  form .user-details .input-box {
    margin-bottom: 15px;
    width: 100%;
  }
  .content form .user-details {
    max-height: 300px;
    overflow-y: scroll;
  }
  .user-details::-webkit-scrollbar {
    width: 5px;
  }
  .grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-column-gap: 2%;
  }
  .v-btn:not(.v-btn--round).v-size--default {
    height: 36px;
    margin-top: 15%;
    min-width: 64px;
    padding: 0 16px;
  }
}
@media (max-width: 459px) {
  .grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 2%;
  }
  .v-btn:not(.v-btn--round).v-size--default {
    height: 36px;
    margin-top: 15%;
    min-width: 64px;
    padding: 0 16px;
  }
}
</style>
