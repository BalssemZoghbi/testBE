<template>
  <div>
   <NavDash :conducteur="projet.conducteur" :conducteurSec="projet.conducteurSec"/>
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <v-stepper-step :complete="e1 > 1" step="1">
          Données Generale
        </v-stepper-step>
        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-6">
              <div class="title">Données Electrique</div>
              <div class="content">
                <form v-on:submit.prevent="updateprojet">
                  <div class="user-details">
                    <div class="input-box">
                      <div class="form__div">
                        <v-select
                          :items="colonnes"
                          label="colonnes"
                          id="colonnes"
                          v-model="projet.colonnes"
                          dense
                          outlined
                        ></v-select>
                      </div>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="pn"
                        v-model="projet.puissance"
                      />
                      <label for="" class="form__label">pn</label>
                    </div>

                    <div class="form__div framei">
                      <v-select
                        :items="frequences"
                        label="frequence"
                        v-model="projet.frequence"
                        dense
                        outlined
                      ></v-select>
                    </div>

                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="u1n"
                        v-model="projet.u1n"
                      />
                      <label for="" class="form__label">u1n</label>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="classeU1"
                        v-model="projet.classeU1"
                      />
                      <label for="" class="form__label">classeU1</label>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="tenueFr1"
                        v-model="projet.tenueFr1"
                      />
                      <label for="" class="form__label">tenueFr1</label>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="tenueChoc1"
                        v-model="projet.tenueChoc1"
                      />
                      <label for="" class="form__label">tenueChoc1</label>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="u2o"
                        v-model="projet.u2o"
                      />
                      <label for="" class="form__label">u2o</label>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="classeU2"
                        v-model="projet.classeU2"
                      />
                      <label for="" class="form__label">classeU2</label>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="tenueFr2"
                        v-model="projet.tenueFr2"
                      />
                      <label for="" class="form__label">tenueFr2</label>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="tenueChoc2"
                        v-model="projet.tenueChoc2"
                      />
                      <label for="" class="form__label">tenueChoc2</label>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="priseSoustractive"
                        v-model="projet.priseSoustractive"
                      />
                      <label for="" class="form__label"
                        >Prise soustractive</label
                      >
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="priseAdditive"
                        v-model="projet.priseAdditive"
                      />
                      <label for="" class="form__label">Prise additive</label>
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="echelonSousctractive"
                        v-model="projet.echelonSousctractive"
                      />
                      <label for="" class="form__label"
                        >Echelon Sousctractive</label
                      >
                    </div>
                    <div class="form__div framei">
                      <input
                        type="number"
                        class="form__input"
                        placeholder=" "
                        id="echelonAdditive"
                        v-model="projet.echelonAdditive"
                      />
                      <label for="" class="form__label">echelon Additive</label>
                    </div>
                  </div>
                </form>
              </div>
            </v-card>
            <router-link class="nav-link" :to="'/projet/update/' + projet.id"
              ><v-btn color="primary" @click="updateprojet">
                précédent
              </v-btn></router-link
            >
            <v-btn color="success" @click="e1 = 2"> suivant </v-btn>
          </v-stepper-content>

          <v-stepper-step :complete="e1 > 2" step="2">
            Couplage
          </v-stepper-step>

          <v-stepper-content step="2">
            <v-card class="mb-6">
              <div class="title">Couplage</div>
              <div class="content">
                <form v-on:submit.prevent="updateprojet">
                  <div class="user-details">
                    <v-row align="center">
                      <v-col class="d-flex" cols="12" sm="6">
                        <v-select
                          :items="couplagePrimaire"
                          label="couplage Primaire"
                          v-model="projet.couplagePrimaire"
                          outlined
                          dense
                        ></v-select>
                      </v-col>

                      <v-col class="d-flex" cols="12" sm="6">
                        <v-select
                          :items="couplageSecondaire"
                          label="couplage Secondaire"
                          v-model="projet.couplageSecondaire"
                          outlined
                          dense
                        ></v-select>
                      </v-col>

                      <v-col class="d-flex" cols="12" sm="6">
                        <v-select
                          :items="indiceHoraire"
                          label="indice Horaire"
                          v-model="projet.indiceHoraire"
                          outlined
                          dense
                        ></v-select>
                      </v-col>
                      <v-col class="d-flex" cols="12" sm="6">
                        <v-text-field
                          label="Couplage"
                          id="couplage"
                          readonly
                          outlined
                          v-model="couplage"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </div>
                </form>
              </div>
            </v-card>
            <v-btn color="primary" @click="e1 = 1"> précédent </v-btn>
            <v-btn color="success" @click="e1 = 3"> suivant </v-btn>
          </v-stepper-content>
          <v-stepper-step :complete="e1 > 3" step="3">
            puissance
          </v-stepper-step>
          <v-stepper-content step="3">
            <v-card class="mb-6">
              <div class="content">
                <form v-on:submit.prevent="updateprojet">
                  <div class="user-details">
                    <v-chip style="text-align: left"
                      >Puissance :
                      {{ projet.puissance }}
                    </v-chip>
                    <div class="field10">
                      <v-text-field
                        label="U1ligne"
                        v-model="projet.PrimaireUligne"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="U1Phase"
                        v-model="projet.PrimaireUPhase"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="I1ligne"
                        v-model="projet.PrimaireIligne"
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="I1Phase"
                        v-model="projet.PrimaireIPhase"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                        label="U2ligne"
                        v-model="projet.secondaireUligne"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="U2Phase"
                        v-model="projet.secondaireUPhase"
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="I2ligne"
                        v-model="projet.secondaireIligne"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="I2Phase"
                        v-model="projet.secondaireIPhase"
                        outlined
                      ></v-text-field>
                         <v-text-field
                        label="Uz"
                        v-model="projet.Uz"
                        outlined
                      ></v-text-field>
                    </div>
                  </div>
                </form>
              </div>
            </v-card>
            <v-btn color="primary mb-14" @click="e1 = 2"> précédent </v-btn>
            <v-btn color="success mb-14" @click="updateprojet"> Valider </v-btn>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </div>
  </div>
</template>
<script>
// import { reactive } from "vue";
import NavDash from "@/components/NavDash.vue";

// import navbarUpdate from "../../navbarUpdate.vue";

import axios from "axios";
export default {
  components: {
    // navbarUpdate
    NavDash,
  },
  data() {
    return {
      frequences: ["50", "60"],
      couplagePrimaire: ["YN", "Y", "D"],
      couplageSecondaire: ["d", "zn", "z", "yn", "y"],
      indiceHoraire: [
        "0",
        "1",
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8",
        "9",
        "10",
        "11",
      ],
      colonnes: ["3", "4"],
      projet: {
        id: undefined,
        nbrePosition: "",
        colonnes: "",
        frequence: "",
        u1n: "",
        u2o: "",
        couplagePrimaire: ["YN", "Y", "D"],
        couplageSecondaire: ["d", "zn", "z", "yn", "y"],
        indiceHoraire: [
          "0",
          "1",
          "2",
          "3",
          "4",
          "5",
          "6",
          "7",
          "8",
          "9",
          "10",
          "11",
        ],
        priseSoustractive: "",
        priseAdditive: "",
        echelonSousctractive: "",
        echelonAdditive: "",
        fonctionnement: "",
        PrimaireUligne: "",
        PrimaireUPhase: "",
        PrimaireIligne: "",
        PrimaireIPhase: "",
        secondaireUligne: "",
        secondaireUPhase: "",
        secondaireIligne: "",
        secondaireIPhase: "",
        Uz: "",
        // nbrePosition: "",
        tenueFr2: "",
        tenueChoc2: "",
        classeU2: "",
        puissance: "",
        tenueChoc1: "",
        classeU1: "",
        tenueFr1: "",
      },
      e1: 1,
    };
  },
  methods: {
    updateprojet() {
      const projets = {
        id: undefined,
        colonnes: this.projet.colonnes,
        frequence: this.projet.frequence,
        u1n: this.projet.u1n,
        u2o: this.projet.u2o,
        couplagePrimaire: this.projet.couplagePrimaire,
        couplageSecondaire: this.projet.couplageSecondaire,
        indiceHoraire: this.projet.indiceHoraire,
        priseSoustractive: this.projet.priseSoustractive,
        priseAdditive: this.projet.priseAdditive,
        echelonSousctractive: this.projet.echelonSousctractive,
        echelonAdditive: this.projet.echelonAdditive,
        puissance: this.projet.puissance,
        classeU1: this.projet.classeU1,
        tenueFr1: this.projet.tenueFr1,
        tenueChoc1: this.projet.tenueChoc1,
        classeU2: this.projet.classeU2,
        tenueFr2: this.projet.tenueFr2,
        tenueChoc2: this.projet.tenueChoc2,
        PrimaireUligne: this.projet.PrimaireUligne,
        PrimaireUPhase: this.projet.PrimaireUPhase,
        PrimaireIligne: this.projet.PrimaireIligne,
        PrimaireIPhase: this.projet.PrimaireIPhase,
        secondaireUligne: this.projet.secondaireUligne,
        secondaireUPhase: this.projet.secondaireUPhase,
        secondaireIligne: this.projet.secondaireIligne,
        secondaireIPhase: this.projet.secondaireIPhase,
        Uz: this.projet.Uz,
        nbrePosition: this.projet.nbrePosition,
      };
      axios
        .put("electrique/edit/" + this.$route.params.id, projets)
        .then(
          (response) => (
            (this.id = response.data.id), console.log(response.data.id)
          )
        );

      this.$router.push("/garantie/" + this.$route.params.id);
    },
  },
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
  },
  computed: {
    couplage() {
      return (
        this.projet.couplagePrimaire +
        this.projet.couplageSecondaire +
        this.projet.indiceHoraire
      );
    },
  },
};
</script>
<style scoped>
.field10 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-template-rows: 1fr 1fr;
  grid-gap: 10px;
  margin-right: 5%;
}
/*===== FORM =====*/

.form {
  /* width: 360px; */
  /* padding: 4rem 2rem; */
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
.frame {
  width: 250px;
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
.v-btn:not(.v-btn--round).v-size--default {
  height: 36px;
  min-width: 64px;
  padding: 16px;
  margin: 3px;
}
</style>
