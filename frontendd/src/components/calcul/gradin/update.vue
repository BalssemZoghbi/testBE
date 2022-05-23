<template>
  <div>
    <NavDash
      :conducteurMT="projet.conducteurMT"
      :conducteurBT="projet.conducteurBT"
    />
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <Loading v-if="spinner" />
        <v-stepper-step :complete="e1 > 1" step="1"> Calcul </v-stepper-step>
        <v-stepper-content step="1">
          <v-card class="mb-6">
            <div class="title">Gradin</div>
            <div class="content">
              <form>
                <div class="user-details">
                  <div class="div">
                    <div class="field10">
                      <v-select
                        :items="toles"
                        label="toles"
                        v-model="projet.tole"
                        dense
                        outlined
                      ></v-select>

                      <v-select
                        :items="pas"
                        label="pas"
                        v-model="projet.pas"
                        dense
                        outlined
                      ></v-select>

                      <v-text-field
                        label="coeffRemplissage"
                        v-model="projet.coeffRemplissage"
                        outlined
                        dense
                      ></v-text-field>
                            <v-text-field
                        label="Diametre propose"
                        v-model="diamPropose"
                        success
                        dense
                        readonly
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Diametre Nominale"
                        dense
                        id="diamNominale"
                        v-model="projet.diamNominale"
                        outlined
                      ></v-text-field>
                

                      <v-text-field
                        label="nbrGradin"
                        v-model="projet.nbrGradin"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="demiGradin"
                        dense
                        v-model="projet.demiGradin"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="largeurMin"
                        dense
                        v-model="projet.largeurMin"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="CMBT"
                        v-model="projet.CMBT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        success
                        label="Sbrut"
                        dense
                        v-model="Sbrut"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        success
                        label="Snette"
                        dense
                        v-model="Snette"
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="EpaisseurTot"
                        dense
                        success
                        v-model="EpaisseurTot"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="grid2">
                      <div style="transform: rotate(-180deg)">
                        <div
                          v-for="item in projet.nbrGradin"
                          :key="item"
                          :style="{
                            width: largeur[projet.nbrGradin - item] + 'px',
                            height: epaisseur[projet.nbrGradin - item] + 'px',
                            'background-color': 'blue',
                          }"
                        ></div>
                        <div
                          v-for="item in projet.nbrGradin"
                          :key="item"
                          v-bind:style="{
                            width: largeur[item - 1] + 'px',
                            height: epaisseur[item - 1] + 'px',
                            'background-color': 'blue',
                          }"
                        ></div>
                      </div>
                      <div>
                        <div
                          v-for="item in projet.nbrGradin"
                          :key="item"
                          v-bind:style="{
                            width: largeur[projet.nbrGradin - item] + 'px',
                            height: epaisseur[projet.nbrGradin - item] + 'px',
                            'background-color': 'blue',
                          }"
                        ></div>
                        <div
                          v-for="item in projet.nbrGradin"
                          :key="item"
                          v-bind:style="{
                            width: largeur[item - 1] + 'px',
                            height: epaisseur[item - 1] + 'px',
                            'background-color': 'blue',
                          }"
                        ></div>
                      </div>
                      <!-- <div  :v-for="index in 3" this.largeur.length :style="{width:'30%', 'height':'30%','background-color':blue}"> -->
                      <!-- <div
                        :v-for="item in largeur"
                        v-bind:style="{
                          width: item + 'px',
                          height: item + 'px',
                          'background-color': 'blue',
                        }"
                      > -->
                      <!-- {{ item }} -->
                      <!-- :v-for="(item, index) in this.largeur"-->
                      <!-- width: epaisseur[index]+'px', -->
                      <!-- </div> -->
                      <!-- </div> -->

                      <!-- <div class="grid2">
                          <div style="transform : rotate(-180deg)">
                          <div>
                        <div  v-bind:style="{'background-color':'blue', width: this.largeur[7] + 'px', height: this.epaisseur[7] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[6] + 'px', height: this.epaisseur[6] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[5] + 'px', height: this.epaisseur[5] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[4] + 'px', height: this.epaisseur[4] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[3] + 'px', height: this.epaisseur[3] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[2] + 'px', height: this.epaisseur[2] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[1] + 'px', height: this.epaisseur[1] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[0] + 'px', height: this.epaisseur[0] + 'px'}"  > </div>
                    
                     </div>
                          <div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[0] + 'px', height: this.epaisseur[0] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[1] + 'px', height: this.epaisseur[1] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[2] + 'px', height: this.epaisseur[2] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[3] + 'px', height: this.epaisseur[3] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[4] + 'px', height: this.epaisseur[4] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[5] + 'px', height: this.epaisseur[5] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[6] + 'px', height: this.epaisseur[6] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[7] + 'px', height: this.epaisseur[7] + 'px'}"  > </div>
                     </div>
                      </div>


<div>
                          <div  >
                        <div  v-bind:style="{'background-color':'blue', width: this.largeur[7] + 'px', height: this.epaisseur[7] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[6] + 'px', height: this.epaisseur[6] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[5] + 'px', height: this.epaisseur[5] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[4] + 'px', height: this.epaisseur[4] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[3] + 'px', height: this.epaisseur[3] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[2] + 'px', height: this.epaisseur[2] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[1] + 'px', height: this.epaisseur[1] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[0] + 'px', height: this.epaisseur[0] + 'px'}"  > </div>
                    
                     </div>
                          <div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[0] + 'px', height: this.epaisseur[0] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[1] + 'px', height: this.epaisseur[1] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[2] + 'px', height: this.epaisseur[2] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[3] + 'px', height: this.epaisseur[3] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[4] + 'px', height: this.epaisseur[4] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[5] + 'px', height: this.epaisseur[5] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[6] + 'px', height: this.epaisseur[6] + 'px'}"  > </div>
                      <div  v-bind:style="{'background-color':'blue', width: this.largeur[7] + 'px', height: this.epaisseur[7] + 'px'}"  > </div>
                     </div>
                      </div>


                     </div> -->
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </v-card>

          <router-link class="nav-link" :to="'/projet/bobine/' + projet.id">
            <v-btn color="primary mb-14" @click="e1 = 2"> précédent </v-btn>
          </router-link>
          <v-btn color="success mb-14" @click="e1 = 2"> suivant </v-btn>
        </v-stepper-content>

        <v-stepper-step :complete="e1 > 2" step="2"> Gadin </v-stepper-step>

        <v-stepper-content step="2">
          <div class="title">Gadin</div>
          <div class="content">
            <v-row cols="2" md="4" class="ml-4">
              <v-card outlined tile>
                <template>
                  <v-row>
                    <v-col>
                      <v-card>
                        <v-card-title class="subheading font-weight-bold">
                          Largeur
                        </v-card-title>

                        <v-divider></v-divider>

                        <v-list dense>
                          <v-list-item v-for="item in largeur" :key="item">
                            <v-list-item-content>{{
                              item
                            }}</v-list-item-content>
                            <v-list-item-content class="align-end">
                            </v-list-item-content>
                          </v-list-item>
                        </v-list>
                      </v-card>
                    </v-col>
                  </v-row>
                </template>
              </v-card>
              <v-card cols="2" md="4" class="ml-4" outlined tile>
                <template style="width: 33%">
                  <v-card-title class="subheading font-weight-bold">
                    Epaisseur
                  </v-card-title>

                  <v-divider></v-divider>

                  <v-list dense>
                    <v-list-item
                      v-for="item in epaisseur"
                      :key="item"
                      style="width: 176% !important"
                    >
                      <v-list-item-content vertical>{{
                        item
                      }}</v-list-item-content>
                      <v-list-item-content
                        class="align-end"
                        v-model="projet.spire"
                      >
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                </template>
              </v-card>
            </v-row>
          </div>
          <v-btn color="primary mb-14" @click="e1 = 1"> précédent </v-btn>
          <v-btn color="success mb-14" @click="updateprojet"> Valider </v-btn>
        </v-stepper-content>
      </v-stepper>
    </div>
  </div>
</template>

<script>
import NavDash from "@/components/NavDash.vue";
import Loading from "@/components/Loading.vue";
import axios from "axios";

export default {
  components: {
    Loading,
    NavDash,
  },
  data() {
    return {
      epaisseurGraph: 100,
      largeurGraph: 150,
      spinner: true,
      toles: [],
      pas: ["10", "20"],
      projet: {
        id: undefined,
        tole: "",
        diamPropose: "",
        diamNominale: "",
        pas: "",
        coeffRemplissage: "",
        nbrGradin: "",
        demiGradin: "",
        largeur: "",
        epaisseur: "",
        Sbrut: "",
        Snette: "",
        EpaisseurTot: "",
        largeurMin: "",
        CMBT: "",
      },
      e1: 1,
    };
  },
  methods: {
    updateprojet() {
      const projets = {
        id: undefined,
        tole: this.projet.tole,
        diamPropose: this.projet.diamPropose,
        diamNominale: this.projet.diamNominale,
        pas: this.projet.pas,
        coeffRemplissage: this.projet.coeffRemplissage,
        nbrGradin: this.projet.nbrGradin,
        demiGradin: this.projet.demiGradin,
        largeur: this.projet.largeur,
        epaisseur: this.projet.epaisseur,
        Sbrut: this.projet.Sbrut,
        Snette: this.projet.Snette,
        EpaisseurTot: this.projet.EpaisseurTot,
        echauffementEnroulement: this.projet.echauffementEnroulement,
        largeurMin: this.projet.largeurMin,
        CMBT: this.projet.CMBT,
      };
      console.log(this.projets);

      axios
        .put("/gradin/update/" + this.$route.params.id, projets)
        .then((response) => (this.id = response.data.id));
      this.$router.push("/projet/VoltSpires/" + this.$route.params.id);
    },
    DeuxChiffre(x) {
      return Math.round(x * 100) / 100;
    },
  },
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
  },
  async created() {
    const result = await axios.get("/projets/" + this.$route.params.id);
    this.projet = result.data;

    axios.get("/getTole").then((response) => (this.toles = response.data));
    this.spinner = false;
  },
  computed: {
    diamPropose() {
      if (this.projet.materiauMT == "cuivre") {
        return (
          parseFloat(Math.pow(parseInt(this.projet.puissance) / 1000, 0.2316)) *
          220
        );
      } else if (this.projet.materiauMT == "aluminium") {
        return (
          parseFloat(Math.pow(parseInt(this.projet.puissance) / 1000, 0.2316)) *
          205
        );
      } else {
        return 0;
      }
    },
    largeur() {
      let diam = parseInt(Math.floor(this.projet.diamNominale / 10));
      let largeur = [];
      if (diam % 2 == 0) {
        diam -= 1;
      }
      diam = diam * 10;
      for (let i = 0; i < parseInt(this.projet.nbrGradin); i++) {
        largeur[i] = diam;
        diam -= this.projet.pas;
        if (largeur[i] == this.projet.largeurMin) {
          break;
        }
      }
      return largeur;
    },
    epaisseur() {
      let epaisseur = [];
      let precedent = 0;
      for (let i = 0; i < this.largeur.length; i++) {
        epaisseur[i] = this.DeuxChiffre(
          Math.sqrt(
            Math.pow(this.projet.diamNominale, 2) - Math.pow(this.largeur[i], 2)
          )
        );
        epaisseur[i] -= precedent;
        precedent += epaisseur[i];
      }
      let j = 0;
      let coeff = [0.5, 0.3, 0.25, 0.2];
      let prec = 0;
      for (let i = 0; i < this.largeur.length - this.projet.demiGradin; i++) {
        prec += epaisseur[i];
      }
      for (
        let i = this.largeur.length - this.projet.demiGradin;
        i < this.largeur.length;
        i++
      ) {
        epaisseur[i] = this.DeuxChiffre(
          (Math.sqrt(
            Math.pow(this.projet.diamNominale, 2) - Math.pow(this.largeur[i], 2)
          ) -
            prec) *
            coeff[j]
        );
        j++;
        prec += epaisseur[i];
      }
      return epaisseur;
    },
    Snette() {
      console.log(this.projet.coeffRemplissage);
      return this.DeuxChiffre(
        parseFloat(this.Sbrut) * parseFloat(this.projet.coeffRemplissage)
      );
    },
    EpaisseurTot() {
      let epaisseur = this.epaisseur;
      let somme = 0;
      for (let i = 0; i < epaisseur.length; i++) {
        somme += parseFloat(epaisseur[i]);
      }
      return this.DeuxChiffre(somme);
    },
    Sbrut() {
      let somme = 0;
      let epaisseur = this.epaisseur;
      let largeur = this.largeur;
      for (let i = 0; i < largeur.length; i++) {
        somme += parseFloat(largeur[i]) * parseFloat(epaisseur[i]);
      }
      return this.DeuxChiffre(somme);
    },
    // epaisseurGraph(){
    //   return 100;
    // },
    // largeurGraph(){
    //   return 150;
    // }
  },
};
</script>

<style scoped>
.grid2 {
  display: flex;
}
#graph {
  width: 80%;
  display: grid;
  grid-template-columns: repeat(1, 1fr);
}
.field10 {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  /* grid-template-rows: repeat(3, 1fr); */
  grid-gap: 10px;
  width: 80%;
  /* margin-right: 5%; */
}
.div2 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  /* grid-template-rows: repeat(2, 1fr); */
  grid-gap: 10px;
  width: 56%;
  /* margin-right: 5%; */
}

.div {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-gap: 10px;
}
.row {
  display: flex;
  flex: 1 1 auto;
  margin: -12px;
  flex-direction: row;
  align-content: space-between;
  justify-content: space-evenly;
  flex-wrap: wrap;
}
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
.titles {
  font-size: 20px;
  font-weight: 500;
  margin-top: -14%;
  margin-bottom: 55%;
  position: relative;
}
.titles::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -1px;
  height: 3px;
  width: 150px;
  border-radius: 5px;

  background: linear-gradient(135deg, #0b65a0, #71b7e6);
}
.content form .user-details {
  display: flex;
  flex-wrap: wrap-reverse;
  justify-content: space-between;
  margin: 10px 0 12px 0;
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
@media (max-width: 1245px) {
  .container {
    max-width: 100%;
  }
  form .field10 .input-box {
    margin-bottom: 15px;
    width: 100%;
  }
  form .category {
    width: 100%;
  }
  .content form .field10 {
    max-height: 300px;
    overflow-y: scroll;
  }
  .field10::-webkit-scrollbar {
    width: 8px;
  }
  .field10 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 10px;
    width: 80%;
  }
  .div2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 10px;
    width: 56%;
  }
  .div {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 10px;
  }
}
@media (max-width: 668px) {
  .container .content .category {
    flex-direction: column;
  }
  .field10 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 10px;
    width: 80%;
  }
  .div2 {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    grid-gap: 10px;
    width: 56%;
  }

  .div {
    display: grid;
    grid-template-columns: 1fr;
    grid-gap: 10px;
  }
}
.v-btn:not(.v-btn--round).v-size--default {
  /* height: 36px; */
  /* min-width: 64px; */
  padding: 16px;
  margin: 3px;
}
</style>
