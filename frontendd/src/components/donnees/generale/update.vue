<template>
  <div>
    <NavDash :conducteur="projet.conducteur" :conducteurSec="projet.conducteurSec"/>
    <!-- <navbarUpdate :elec_id='projet.electrique_id' :id='projet.id'/> -->
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <!-- <v-stepper-header> -->
        <v-stepper-step :complete="e1 > 1" step="1">
          Données Generale
        </v-stepper-step>

        <!-- <v-divider></v-divider> -->

        <!-- <v-divider></v-divider> -->

        <!-- </v-stepper-header> -->

        <!-- <v-stepper-items> -->
        <v-stepper-content step="1">
          <v-card class="mb-6">
            <!-- <div class="body"> -->
            <!-- <div class="container"> -->
            <div class="title">Données Generale</div>
            <div class="content">
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div class="form__div framei">
                    <input
                      type="text"
                      class="form__input"
                      placeholder=" "
                      id="appareil"
                      v-model="projet.appareil"
                    />
                    <label for="" class="form__label">Appareil</label>
                  </div>
                  <div class="form__div framei">
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

                  <div class="form__div framei">
                    <input
                      type="text"
                      class="form__input"
                      placeholder=" "
                      id="client"
                      v-model="projet.client"
                    />
                    <label for="" class="form__label">Client</label>
                  </div>

                  <div class="form__div framei">
                    <input
                      type="text"
                      class="form__input"
                      placeholder=" "
                      id="user_id"
                      v-model="projet.elaborateur"
                    />
                    <label for="" class="form__label">Elaboré par</label>
                    <!-- <v-select
                                :items="frequences"
                                label="frequence"
                                v-model="projet.frequence"
                                dense
                                outlined
                              ></v-select> -->
                  </div>
                  <div class="form__div framei">
                    <input
                      type="number"
                      class="form__input"
                      placeholder=" "
                      id="temperatureMax"
                      v-model="projet.temperatureMax"
                    />
                    <label for="" class="form__label">temperatureMax</label>
                  </div>
                  <div class="form__div framei">
                    <input
                      type="number"
                      class="form__input"
                      placeholder=" "
                      id="attitudeMax"
                      v-model="projet.attitudeMax"
                    />
                    <label for="" class="form__label">attitudeMax</label>
                  </div>
                  <div class="form__div framei">
                    <v-select
                      :items="types"
                      label="type"
                      v-model="projet.type"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div framei">
                    <v-select
                      :items="remplissages"
                      label="remplissage"
                      v-model="projet.remplissage"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div framei">
                    <v-select
                      :items="installations"
                      label="installation"
                      v-model="projet.installation"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div framei">
                    <v-select
                      :items="montages"
                      label="montage"
                      v-model="projet.montage"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div framei">
                    <v-select
                      :items="dielectriques"
                      label="dielectrique"
                      v-model="projet.dielectrique"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div framei">
                    <v-select
                      :items="fonctionnements"
                      label="fonctionnement"
                      v-model="projet.fonctionnement"
                      dense
                      outlined
                    ></v-select>
                  </div>

                  <div class="form__div framei">
                    <v-select
                      :items="echangeurs"
                      label="Echangeurs"
                      v-model="projet.echangeurs"
                      dense
                      outlined
                    ></v-select>
                  </div>

                  <div class="form__div framei">
                    <v-select
                      :items="refroidissements"
                      label="Refroidissement"
                      v-model="projet.refroidissement"
                      dense
                      outlined
                    ></v-select>
                  </div>
                  <div class="form__div framei">
                    <input
                      type="text"
                      class="form__input"
                      placeholder=" "
                      id="Modele"
                      v-model="projet.Modele"
                      readonly
                    />
                    <label for="" class="form__label">Modele</label>
                  </div>
                </div>
              </form>
            </div>
            <!-- </div> -->
            <!-- </div> -->
          </v-card>

          <router-link
            class="nav-link"
            :to="'/electrique/update/' + projet.id"
            ><v-btn
              color="primary"
              @click="updateprojet"
              style="margin-top: -3% !important; margin-bottom: 5% !important"
            >
              Valider
            </v-btn></router-link
          >
        </v-stepper-content>
        <!-- <v-stepper-content >
        </v-stepper-content> -->
      </v-stepper>
    </div>
  </div>
</template>

<script>
// import { reactive } from "vue";
// import navbarUpdate from '../../navbarUpdate';
import NavDash from "@/components/NavDash.vue";
import axios from "axios";
export default {
  components: {
    // navbarUpdate
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
        Modele: "",
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
        Modele: this.projet.Modele,
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
h1 {
  margin: 0;
}

/*===== FORM =====*/
.l-form {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.form {
  width: 360px;
  padding: 4rem 2rem;
  border-radius: 1rem;
  /* box-shadow: 0 10px 25px rgba(92,99,105,.2); */
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
  height: 100%;
  font-size: 1rem;
  border: 1px solid #dadce0;
  border-radius: 0.5rem;
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
.form__button {
  display: block;
  margin-left: auto;
  padding: 0.75rem 2rem;
  outline: none;
  border: none;
  background-color: #4797d1;
  color: #fff;
  font-size: 1rem;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: 0.3s;
}
.form__button:hover {
  box-shadow: 0 10px 36px rgba(0, 0, 0, 0.15);
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

/*Input focus*/
.form__input:focus {
  border: 1.5px solid #4797d1;
}

.body {
  height: 100%;
  /* display: flex; */
  /* justify-content: center;
  align-items: center; */
  padding: 20px;
  max-height: calc(100vh - 50px);

  /* margin: 0.5%; */
  /* background: linear-gradient(135deg,#71b7e675, #71b7e675); */
}
.container {
  max-width: 98%;
  /* height: 80%; */
  margin-top: 2%;
  width: 100%;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgb(0 0 0 / 15%);
}
.title {
  font-size: 25px;
  font-weight: 500;
  /* margin-top:-1% ; */
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
  /* border: 1px solid #ccc; */
  /* border-bottom-width: 2px; */
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
form .button {
  height: 45px;
  margin-top: 10px;
  margin-left: 80%;
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
  /* transform: scale(0.99); */
  background: linear-gradient(-135deg, #71b7e6, #71b7e6);
}
.framei {
  width: 22%;
  justify-content: space-between;
}
.frameii {
  /* width: calc(100% /1 - 2px); */
  width: 100%;
  border-color: #000;
}
.v-sheet.v-card:not(.v-sheet--outlined) {
  box-shadow: 0px 0px 0px 0px;
}
.v-stepper--vertical {
  padding-bottom: 0px;
}
@media (max-width: 584px) {
  .container {
    max-width: 100%;
  }
  form .user-details .input-box {
    margin-bottom: 15px;
    width: 100%;
  }
  form .category {
    width: 100%;
  }
  .content form .user-details {
    max-height: 300px;
    overflow-y: scroll;
  }
  .user-details::-webkit-scrollbar {
    width: 5px;
  }
}
@media (max-width: 459px) {
  .container .content .category {
    flex-direction: column;
  }
}
</style>
