<template>
  <div>
    <navbarUpdate />
    <NavDash />
    <div class="body">
      <v-stepper v-model="e1">
        <v-stepper-header>
          <v-stepper-step :complete="e1 > 1" step="1"> Frame 1 </v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step :complete="e1 > 2" step="2"> Frame 2 </v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step :complete="e1 > 3" step="3"> Frame 3 </v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step :complete="e1 > 4" step="4"> Frame 4 </v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step step="5"> Frame 5 </v-stepper-step>
        </v-stepper-header>

        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-12" color="rgb(5 48 96 / 78%) " height="450px">
              <div class="body">
                <div class="container">
                  <div class="title">Calcul bobine</div>
                  <div class="content">
                    <form v-on:submit.prevent="updateprojet">
                      <div class="user-details">
                        <div class="input-box">
                          <div class="form__div">
                            <input
                              type="number"
                              class="form__input"
                              placeholder=" "
                              id="nbBrin1"
                              v-model="projet.scu2"
                            />
                            <label for="" class="form__label">scu2</label>
                          </div>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="nbBrin2"
                            v-model="projet.j2"
                          />
                          <label for="" class="form__label">j2</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="nbcoucheMT"
                            v-model="projet.nbcoucheBT"
                          />
                          <label for="" class="form__label">nbcoucheBT</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="nbBrin1"
                            v-model="projet.rigiditePapierBT"
                          />
                          <label for="" class="form__label"
                            >rigiditePapierBT</label
                          >
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="nbrPapierBT"
                            v-model="projet.nbrPapierBT"
                          />
                          <label for="" class="form__label">nbrPapierBT</label>
                        </div>
                        <div class="form__div framei">
                          <v-select
                            :items="typeCanaux"
                            label="typeCanauxBT"
                            v-model="projet.typeCanauxBT"
                            dense
                            outlined
                          ></v-select>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="scu2"
                            v-model="projet.canauxBT"
                            readonly
                          />
                          <label for="" class="form__label">canauxBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="j2"
                            v-model="projet.lgCalesBT"
                            readonly
                          />
                          <label for="" class="form__label">lgCales</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="sp/couche"
                            v-model="projet.DintBT"
                          />
                          <label for="" class="form__label">DintBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="e2ax"
                            v-model="projet.BintBT"
                          />
                          <label for="" class="form__label">BintBT</label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </v-card>

            <v-btn color="primary" @click="e1 = 2"> Continue </v-btn>
          </v-stepper-content>

          <v-stepper-content step="2">
            <v-card class="mb-12" color="rgb(5 48 96 / 78%)" height="450px">
              <div class="body">
                <div class="container">
                  <div class="title">Calcul bobine</div>
                  <div class="content">
                    <form v-on:submit.prevent="updateprojet">
                      <div class="user-details">
                        <div class="input-box">
                          <div class="form__div">
                            <input
                              type="number"
                              class="form__input"
                              placeholder=" "
                              id="e2r"
                              :items="e2r"
                              dense
                              outlined
                              v-model="projet.EpxBT"
                            />

                            <label for="" class="form__label">EpxBT</label>
                          </div>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="rigiditePapier"
                            v-model="projet.EpyBT"
                          />
                          <label for="" class="form__label">EpyBT</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="ep1Papier"
                            v-model="projet.DextBT"
                          />
                          <label for="" class="form__label">DextBT</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="HSFS"
                            v-model="projet.BextBT"
                          />
                          <label for="" class="form__label">BextBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="nbrPapier"
                            v-model="projet.poidBT"
                          />
                          <label for="" class="form__label">poidBT</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="canauxBT"
                            v-model="projet.majPoidBT"
                          />
                          <label for="" class="form__label">majPoidBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="lgCales"
                            v-model="projet.EpCylindreBT"
                            readonly
                          />
                          <label for="" class="form__label">EpCylindre</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="scu2d"
                            v-model="projet.scu2d"
                          />
                          <label for="" class="form__label">scu2d</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="J2D"
                            v-model="projet.J2D"
                          />
                          <label for="" class="form__label">J2D</label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </v-card>

            <v-btn @click="e1 = 1"> précédente </v-btn>
            <v-btn color="primary" @click="e1 = 3"> Continue </v-btn>
          </v-stepper-content>

          <v-stepper-content step="3">
            <v-card class="mb-12" color="rgb(5 48 96 / 78%)" height="450px">
              <div class="body">
                <div class="container">
                  <div class="title">Calcul bobine</div>
                  <div class="content">
                    <form v-on:submit.prevent="updateprojet">
                      <div class="user-details">
                        <div class="input-box">
                          <div class="form__div">
                            <input
                              type="number"
                              class="form__input"
                              placeholder=" "
                              id="D1d"
                              v-model="projet.D2d"
                            />
                            <label for="" class="form__label">D2d</label>
                          </div>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="filobtenueNue"
                            v-model="projet.filobtenueNueBT"
                          />
                          <label for="" class="form__label"
                            >filobtenueNueBT</label
                          >
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="filobtenueIsoler"
                            v-model="projet.filobtenueIsolerBT"
                          />
                          <label for="" class="form__label"
                            >filobtenueIsolerBT</label
                          >
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="DistanceBTMTSec"
                            v-model="projet.DistanceBTMTSec"
                          />
                          <label for="" class="form__label"
                            >DistanceBTMTSec</label
                          >
                        </div>
                        <div class="form__div framei">
                          <input
                            type="text"
                            class="form__input"
                            placeholder=" "
                            id="choix"
                            v-model="projet.choixBT"
                          />
                          <label for="" class="form__label">choix</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="brinParallele"
                            v-model="projet.brinParalleleBT"
                          />
                          <label for="" class="form__label"
                            >brinParallele</label
                          >
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="SpchB"
                            v-model="projet.SpchBBT"
                            readonly
                          />
                          <label for="" class="form__label">SpchB</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="NchB"
                            v-model="projet.NchBBT"
                            readonly
                          />
                          <label for="" class="form__label">NchB</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="SpchA"
                            v-model="projet.SpchABT"
                          />
                          <label for="" class="form__label">SpchA</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="NchA"
                            v-model="projet.NchABT"
                          />
                          <label for="" class="form__label">NchA</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="HCondMt"
                            v-model="projet.HCondBt"
                          />
                          <label for="" class="form__label">HCondMt</label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </v-card>
            <v-btn @click="e1 = 2"> précédente </v-btn>
            <v-btn color="primary" @click="e1 = 4"> Continue </v-btn>
          </v-stepper-content>

          <v-stepper-content step="4">
            <v-card class="mb-12" color="rgb(5 48 96 / 78%)" height="450px">
              <div class="body">
                <div class="container">
                  <div class="title">Calcul bobine</div>
                  <div class="content">
                    <form v-on:submit.prevent="updateprojet">
                      <div class="user-details">
                        <div class="input-box">
                          <div class="form__div"></div>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="HCollierBT"
                            v-model="projet.HCollierBT"
                          />
                          <label for="" class="form__label">HCollier</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="EpfeuillePapier"
                            v-model="projet.EpfeuillePapierBT"
                          />
                          <label for="" class="form__label"
                            >EpfeuillePapier</label
                          >
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="EpaiseurPapier"
                            v-model="projet.EpaiseurPapierBT"
                          />
                          <label for="" class="form__label"
                            >EpaiseurPapier</label
                          >
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="EpaisseurPapierCanaux"
                            v-model="projet.EpaisseurPapierCanauxBT"
                          />
                          <label for="" class="form__label"
                            >EpaisseurPapierCanaux</label
                          >
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="HbobineBtSec"
                            v-model="projet.HbobineBtSec"
                          />
                          <label for="" class="form__label">HbobineBtSec</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="N2cmax"
                            v-model="projet.N2cmax"
                          />
                          <label for="" class="form__label">N2cmax</label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </v-card>
            <v-btn @click="e1 = 3"> précédente </v-btn>

            <v-btn color="primary" @click="updateprojet"> Valider </v-btn>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </div>
  </div>
</template>

<script>
import NavDash from "@/components/NavDash.vue";

import axios from "axios";
export default {
  components: { NavDash },
  data() {
    return {
      barre: [],
      conducteur: ["meplat guipé", "Rond emaille", "feuillard"],
      materiau: ["cuivre", "aluminium"],
      typeCanaux: ["complet", "lune"],
      projet: {
        id: undefined,
        materiauSec: "",
        conducteurSec: "",

        scu2: "",
        j2: "",
        nbcoucheBT: "",
        rigiditePapierBT: "",
        nbrPapierBT: "",
        typeCanauxBT: "",
        canauxBT: "",
        lgCalesBT: "",
        N2cmax: "",
        DintBT: "",
        BintBT: "",
        EpxBT: "",
        EpyBT: "",
        DextBT: "",
        BextBT: "",
        poidBT: "",
        majPoidBT: "",

        EpCylindreBT: "",
        scu2d: "",
        J2D: "",
        D2d: "",
        filobtenueNueBT: "",
        filobtenueIsolerBT: "",
        choixBT: "",
        brinParalleleBT: "",
        SpchBBT: "",
        NchBBT: "",
        SpchABT: "",
        NchABT: "",
        HCondBt: "",
        DistanceBTMTSec: "",
        HCollierBT: "",
        EpfeuillePapierBT: "",
        EpaiseurPapierBT: "",
        EpaisseurPapierCanauxBT: "",
        HbobineBtSec: "",
      },
      e1: 1,
    };
  },
  methods: {
    updateprojet() {
      const projets = {
        id: undefined,
        materiauSec: this.projet.materiauSec,
        conducteurSec: this.projet.conducteurSec,
        scu2: this.projet.scu2,
        j2: this.projet.j2,
        nbcoucheBT: this.projet.nbcoucheBT,
        rigiditePapierBT: this.projet.rigiditePapierBT,
        nbrPapierBT: this.projet.nbrPapierBT,
        typeCanauxBT: this.projet.typeCanauxBT,
        canauxBT: this.projet.canauxBT,
        N2cmax: this.projet.N2cmax,

        DintBT: this.projet.DintBT,
        BintBT: this.projet.BintBT,
        EpxBT: this.projet.EpxBT,
        EpyBT: this.projet.EpyBT,
        DextBT: this.projet.DextBT,
        BextBT: this.projet.BextBT,
        poidBT: this.projet.poidBT,
        majPoidBT: this.projet.majPoidBT,
        EpCylindreBT: this.projet.EpCylindreBT,
        scu2d: this.projet.scu2d,
        J2D: this.projet.J2D,
        filobtenueNueBT: this.projet.filobtenueNueBT,
        filobtenueIsolerBT: this.projet.filobtenueIsolerBT,
        choixBT: this.projet.choixBT,
        brinParalleleBT: this.projet.brinParalleleBT,
        SpchBBT: this.projet.SpchBBT,
        NchBBT: this.projet.NchBBT,
        SpchABT: this.projet.SpchABT,
        NchABT: this.projet.NchABT,
        HCondBt: this.projet.HCondBt,
        DistanceBTMTSec: this.projet.DistanceBTMTSec,
        HCollierBT: this.projet.HCollier,
        EpfeuillePapierBT: this.projet.EpfeuillePapierBT,
        EpaiseurPapierBT: this.projet.EpaiseurPapierBT,
        EpaisseurPapierCanauxBT: this.projet.EpaisseurPapierCanauxBT,
        HbobineBtSec: this.projet.HbobineBtSec,
      };
      axios
        .put("bobinesec/update/" + this.$route.params.id, projets)
        .then(
          (response) => ((this.id = response.data.id), console.log(projets))
        );
      this.$router.push("/");
    },
  },
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
  },
  created() {
    axios
      .get("/getdesignationBarre")
      .then((response) => (this.barre = response.data));
    axios
      .get("/getValeurHbrin")
      .then((response) => (this.hbrin = response.data));
    axios
      .get("/getValeurSaillie")
      .then((response) => (this.saillie = response.data));
  },
};
</script>
<style scoped>
/* Googlefont Poppins CDN Link */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");

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
  /* background: linear-gradient(135deg,rgb(5 48 96 / 78%), rgb(5 48 96 / 78%)); */
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
.container .title {
  font-size: 25px;
  font-weight: 500;
  position: relative;
  color: #56a5da;
}
.container .title::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -2px;
  height: 3px;
  width: 250px;
  border-radius: 5px;
  /* margin-bottom: 5%; */
  /* background: linear-gradient(135deg, #71b7e6, #71b7e6); */
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
  border: 1px solid #ccc;
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
