<template>
  <div>
    <!-- <navbarUpdate /> -->
    <NavDash
      :conducteur="projet.conducteur"
      :conducteurSec="projet.conducteurSec"
    />
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <v-stepper-step :complete="e1 > 1" step="1">
          Bobinage du secondaire en fil méplat
        </v-stepper-step>
        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-4">
              <div class="title">Bobine base tension</div>
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div style="margin-bottom: 2%">
                    <v-chip
                      >N2c :
                      {{ projet.N2c }}
                    </v-chip>
                    <v-chip style="margin-left: 2%"
                      >I2ph :
                      {{ projet.secondaireIPhase }}
                    </v-chip>
                  </div>

                  <div class="div">
                    <div class="field10">
                      <v-select
                        :items="etage"
                        label="Etages"
                        v-model="projet.etageBT"
                        dense
                        outlined
                      ></v-select>

                      <v-select
                        :items="saillie"
                        label="saillieBT"
                        v-model="projet.saillieBT"
                        dense
                        outlined
                      ></v-select>
                      <v-select
                        :items="hbrin"
                        label="Hbrin 1BT"
                        v-model="projet.hbrin1BT"
                        dense
                        outlined
                      ></v-select>

                      <v-text-field
                        label="NbBrin 1BT"
                        v-model="projet.nbBrin1BT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-select
                        :items="hbrin"
                        label="Hbrin 2BT"
                        v-model="projet.hbrin2BT"
                        dense
                        outlined
                      ></v-select>
                        <v-text-field
                        label="NbBrin 2BT"
                        v-model="projet.nbBrin2BT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="scu2"
                        dense
                        id="scu2"
                        readonly
                        v-model="scu2"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="j2"
                        dense
                        id="j2"
                        readonly
                        v-model="j2"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                        label="NbcoucheBT"
                        v-model="projet.nbcoucheBT"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="Sp/CoucheBT"
                        v-model="spCouche"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="e2ax"
                        v-model="projet.e2ax"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="e2r"
                        v-model="projet.e2r"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="Rigidité Papier"
                        v-model="projet.rigiditePapierBT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        label="ep1PapierBT"
                        dense
                        v-model="projet.ep1PapierBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="nbrPapierBT"
                        dense
                        v-model="projet.nbrPapierBT"
                        outlined
                      ></v-text-field>
                    </div>
                  </div>
                </div>
              </form>
            </v-card>
            <router-link
              class="nav-link"
              :to="'/projet/VoltSpires/' + projet.id"
              ><v-btn color="primary mb-16" @click="updateprojet">
                précédent
              </v-btn></router-link
            >
            <v-btn color="success mb-16" @click="e1 = 2"> suivant </v-btn>
          </v-stepper-content>

          <v-stepper-step :complete="e1 > 2" step="2">
            Hauteur/caneaux
          </v-stepper-step>

          <v-stepper-content step="2">
            <v-card class="mb-4">
              <div class="title">Hauteur/caneaux</div>
              <!-- <div class="content"> -->
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div class="div">
                    <div class="div2">
                      <v-text-field
                        label="HspireBT"
                        v-model="hSpire"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="HSFS"
                        v-model="hsfs"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="HFS"
                        v-model="hfs"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="HbobineBt"
                        v-model="hbobt"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="CollierBT"
                        v-model="projet.collierBTSec"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        label="CollierBT2"
                        dense
                        v-model="collierBt2"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="div2">
                      <v-select
                        :items="typeCanaux"
                        label="typeCanaux"
                        v-model="projet.typeCanauxBT"
                        dense
                        outlined
                      ></v-select>
                      <v-text-field
                        label="CanauxBT"
                        dense
                        id="canauxBT"
                        
                        v-model="projet.canauxBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Lrg Cales"
                        dense
                        id="lgCales"
                        readonly
                        v-model="projet.lgCalesBT"
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="Ep1Papier"
                        v-model="projet.canauxEp1PapierBT"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="NbrPapier"
                        v-model="projet.canauxNbrPapierBT"
                        outlined
                        dense
                      ></v-text-field>
                    </div>
                  </div>
                </div>
              </form>
              <!-- </div> -->
            </v-card>
            <v-btn color="primary" @click="e1 = 1"> précédent </v-btn>
            <v-btn color="success" @click="e1 = 3"> suivant </v-btn>
          </v-stepper-content>
          <v-stepper-step :complete="e1 > 3" step="3">
            Diamétre
          </v-stepper-step>
          <v-stepper-content step="3">
            <v-card class="mb-4">
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div style="margin-bottom: 2%">
                    <v-chip
                      >Dn :
                      {{ projet.diamNominale }}
                    </v-chip>
                    <v-chip style="margin-left: 2%"
                      >CMBT :
                      {{ projet.CMBT }}
                    </v-chip>
                  </div>

                  <div class="div2">
                    <v-text-field
                      label="DintBT"
                      v-model="DintBint"
                      dense
                      outlined
                    ></v-text-field>

                    <v-text-field
                      label="BintBT"
                      v-model="DintBint"
                      dense
                      outlined
                    ></v-text-field>

                    <v-text-field
                      label="EpxBT"
                      v-model="Epx"
                      dense
                      outlined
                    ></v-text-field>
                    <v-text-field
                      label="EpyBT"
                      v-model="Epy"
                      dense
                      outlined
                    ></v-text-field>
                    <v-text-field
                      label="DextBT"
                      v-model="Dext"
                      outlined
                      dense
                    ></v-text-field>

                    <v-text-field
                      label="BextBT"
                      dense
                      v-model="Bext"
                      outlined
                    ></v-text-field>
                    <v-text-field
                      label="majPoid"
                      dense
                      v-model="projet.majPoidBT"
                      outlined
                    ></v-text-field>
                    <v-text-field
                      label="poidBT"
                      dense
                      v-model="poidBT"
                      outlined
                    ></v-text-field>
                  </div>
                </div>
              </form>
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
import NavDash from "@/components/NavDash.vue";

import axios from "axios";
export default {
  components: { NavDash },
  data() {
    return {
      saillie: [],
      hbrin: [],
      barre: [],
      conducteur: ["meplat guipé", "Rond emaille", "feuillard"],
      materiauSec: ["cuivre", "aluminium"],
      etage: ["1", "2"],
      typeCanaux: ["complet", "lune"],
      projet: {
        id: undefined,
        materiauSec: "",
        conducteurSec: "",
        etageBT: "",
        saillieBT: "",
        hbrin1BT: "",
        hbrin2BT: "",
        nbBrin1BT: "",
        nbBrin2BT: "",
        scu2: "",
        j2: "",
        nbcoucheBT: "",
        spCoucheBT: "",
        e2ax: "",
        e2r: "",
        rigiditePapierBT: "",
        ep1PapierBT: "",
        nbrPapierBT: "",
        typeCanauxBT: "",
        canauxBT: "",
        lgCalesBT: "",
        canauxEp1PapierBT: "",
        canauxNbrPapierBT: "",
        HspireBT: "",
        HSFSBT: "",
        HFSBT: "",
        collierBTSec: "",
        collierBT2Sec: "",
        CMBTSec: "",
        DintBT: "",
        BintBT: "",
        EpxBT: "",
        EpyBT: "",
        DextBT: "",
        BextBT: "",
        poidBT: "",
        majPoidBT: "",
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
        etageBT: this.projet.etageBT,
        saillieBT: this.projet.saillieBT,
        hbrin1BT: this.projet.hbrin1BT,
        hbrin2BT: this.projet.hbrin2BT,
        nbBrin1BT: this.projet.nbBrin1BT,
        nbBrin2BT: this.projet.nbBrin2BT,
        scu2: this.projet.scu2,
        j2: this.projet.j2,
        nbcoucheBT: this.projet.nbcoucheBT,
        spCoucheBT: this.projet.spCoucheBT,
        e2ax: this.projet.e2ax,
        e2r: this.projet.e2r,
        rigiditePapierBT: this.projet.rigiditePapierBT,
        ep1PapierBT: this.projet.ep1PapierBT,
        nbrPapierBT: this.projet.nbrPapierBT,
        typeCanauxBT: this.projet.typeCanauxBT,
        canauxBT: this.projet.canauxBT,
        lgCalesBT: this.projet.lgCalesBT,
        canauxEp1PapierBT: this.projet.canauxEp1PapierBT,
        canauxNbrPapierBT: this.projet.canauxNbrPapierBT,
        HspireBT: this.projet.HspireBT,
        HSFSBT: this.projet.HSFSBT,
        HFSBT: this.projet.HFSBT,
        collierBTSec: this.projet.collierBTSec,
        collierBT2Sec: this.projet.collierBT2Sec,
        CMBTSec: this.projet.CMBTSec,
        DintBT: this.projet.DintBT,
        BintBT: this.projet.BintBT,
        EpxBT: this.projet.EpxBT,
        EpyBT: this.projet.EpyBT,
        DextBT: this.projet.DextBT,
        BextBT: this.projet.BextBT,
        poidBT: this.projet.poidBT,
        majPoidBT: this.projet.majPoidBT,
        HbobineBtSec: this.projet.HbobineBtSec,
      };
      axios
        .put("bobinesec/update/" + this.$route.params.id, projets)
        .then(
          (response) => ((this.id = response.data.id), console.log(projets))
        );
      if (this.projet.conducteur == "Rond emaille") {
        this.$router.push(
          "/projet/bobinagePrimaireRond/" + this.$route.params.id
        );
      } else if (this.projet.conducteur == "feuillard") {
        this.$router.push(
          "/projet/bobinagePrimaireFeuillard/" + this.$route.params.id
        );
      } else if (this.projet.conducteur == "meplat guipé") {
        this.$router.push(
          "/projet/bobinagePrimaireMeplat/" + this.$route.params.id
        );
      }
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
  computed: {
    scu2() {
      return (
        0.987 *
        this.projet.saillieBT *
        this.projet.etageBT *
        (this.projet.hbrin1BT * this.projet.nbBrin1BT +
          this.projet.hbrin2BT * this.projet.nbBrin2BT)
      );
    },
    j2() {
      return this.projet.secondaireIPhase / this.scu2;
    },
    spCouche() {
      return this.projet.N2c / this.projet.nbcoucheBT;
    },
    hSpire() {
      console.log(this.projet.hbrin1BT , this.projet.e2ax);
      return (
        (parseFloat(this.projet.hbrin1BT) + parseFloat(this.projet.e2ax)) * parseFloat(this.projet.nbBrin1BT) +
        (parseFloat(this.projet.hbrin2BT) + parseFloat(this.projet.e2ax)) * parseFloat(this.projet.nbBrin2BT)
      );
    },
    hsfs() {
      return (
        this.hSpire * this.spCouche +
        (this.projet.etageBT - 1) *
          (this.projet.hbrin1BT + this.projet.hbrin2BT + this.projet.e2ax * 2)
      );
    },
    hfs() {
      if (this.projet.hbrin1BT == 0) {
        return (
          this.hSpire * this.spCouche +
          (this.projet.etageBT - 1) * (this.projet.hbrin1BT + this.projet.e2ax)
        );
      } else {
        return (
          this.hSpire * (this.spCouche +1) +
          (parseFloat(this.projet.etageBT) - 1) *
            (parseFloat(this.projet.hbrin1BT) + parseFloat(this.projet.hbrin2BT) + parseFloat(this.projet.e2ax )* 2)
        );
      }
    },
    hbobt() {
      return this.hfs + this.projet.collierBTSec * 2;
    },
    collierBt2() {
      return this.hbobt - this.hfs - parseFloat(this.projet.collierBTSec);
    },
    poidBT() {
      let coefPoid = 0;
      if (this.projet.materiauSec == "cuivre") {
        coefPoid = 8.9;
      } else if (this.projet.materiauSec == "aluminium") {
        coefPoid = 2.7;
      }
      return (
        Math.pow(10, -6) *
        (coefPoid *
          parseFloat(this.projet.N2c) *
          parseFloat(this.scu2) *
          (parseFloat(this.DintBint) + (this.Epx)) *
          Math.PI *
          3 *
          ((100 + parseFloat(this.projet.majPoidBT)) / 100))
      );
    },
    DintBint() {
      return this.projet.diamNominale + 2 * this.projet.CMBT;
    },
    Epx() {
      let epx = this.projet.EpxBT;
      if (this.projet.typeCanauxBT == "complet") {
        epx =
          (this.projet.saillieBT + this.projet.e2r) *
            this.projet.etageBT *
            this.projet.nbcoucheBT +
          this.projet.canauxBT * this.projet.lgCalesBT +
          this.projet.nbrPapierBT * this.projet.canauxEp1PapierBT;
      } else if (this.projet.typeCanauxBT == "lune") {
        epx =
          (this.projet.saillieBT + this.projet.e2r) *
          this.projet.etageBT *
          this.projet.nbcoucheBT;
      }

      // console.log("hhhhh",this.projet.nbrPapier);
      return epx;
    },
    Epy() {
      return   (this.projet.saillieBT + this.projet.e2r) *
            this.projet.etageBT *
            this.projet.nbcoucheBT +
          this.projet.canauxBT * this.projet.lgCalesBT +
          this.projet.nbrPapierBT * this.projet.canauxEp1PapierBT;
      
    },
    Dext() {
      // console.log(this.Epx);
      return this.DintBint + 2 * this.Epx;
    },
    Bext() {
      return this.DintBint + 2 * this.Epy;
    },
  },
};
</script>
<style scoped>
.field10 {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
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
.row {
  display: flex;
  flex: 1 1 auto;
  margin: -12px;
  flex-direction: row;
  align-content: space-between;
  justify-content: space-evenly;
  flex-wrap: wrap;
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

.v-sheet.v-card:not(.v-sheet--outlined) {
  box-shadow: 0px 0px 0px 0px;
}
.v-stepper--vertical {
  padding-bottom: 0px;
}
@media (max-width: 400px) {
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
    width: 5px;
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
@media (max-width: 1000px) {
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
