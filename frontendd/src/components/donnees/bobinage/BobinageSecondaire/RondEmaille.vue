<template>
  <div>
    <navbarUpdate />
    <NavDash
      :conducteur="projet.conducteur"
      :conducteurSec="projet.conducteurSec"
    />
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <v-stepper-step :complete="e1 > 1" step="1">
          Bobinage du secondaire en fil rond
        </v-stepper-step>
        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-4">
              <div class="title">Bobine base tension</div>
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div style="margin-bottom: 2%">
                    <v-chip
                      >materiau :
                      {{ projet.materiauSec }}
                    </v-chip>
                    <v-chip style="margin-left: 2%"
                      >conducteur :
                      {{ projet.conducteurSec }}
                    </v-chip>
                  </div>
                  <div class="div">
                    <div class="field10">
                      <v-text-field
                        label="N2cmax"
                        v-model="N2cmax"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="scu2d"
                        v-model="scu2d"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="J2D"
                        v-model="projet.J2D"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="D2d"
                        v-model="D2d"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="scu2"
                        v-model="scu2"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="j2"
                        v-model="j2"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="brinParallele"
                        v-model="projet.brinParalleleBT"
                        dense
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                        label="filobtenueNue"
                        dense
                        id="filobtenueNue"
                        readonly
                        v-model="filobtenueNueBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="filobtenueIsoler"
                        dense
                        id="filobtenueIsoler"
                        readonly
                        v-model="filobtenueIsolerBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="rigiditePapierMT"
                        v-model="projet.rigiditePapierBT"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="EpfeuillePapier"
                        v-model="projet.EpfeuillePapierBT"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="nbrPapierMt"
                        v-model="nbrPapierBT"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="EpaiseurPapier"
                        v-model="EpaiseurPapierBT"
                        outlined
                        dense
                      ></v-text-field>
                    </div>
                  </div>
                </div>
              </form>
            </v-card>
            <router-link class="nav-link" :to="'/projet/update/' + projet.id"
              ><v-btn color="primary mb-16" @click="updateprojet">
                précédent
              </v-btn></router-link
            >
            <v-btn color="success mb-16" @click="e1 = 2"> suivant </v-btn>
          </v-stepper-content>

          <v-stepper-step :complete="e1 > 2" step="2">
            Couplage
          </v-stepper-step>

          <v-stepper-content step="2">
            <v-card class="mb-4">
              <div class="title">Hauteur/caneaux</div>
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div class="div">
                    <div class="div2">
                      <v-text-field
                        label="nbcoucheBT"
                        v-model="projet.nbcoucheBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="choix"
                        v-model="projet.choixBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="NchA"
                        v-model="NchABT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="SpchA"
                        v-model="SpchABT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="NchB"
                        v-model="NchBBT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        label="SpchB"
                        dense
                        v-model="SpchBBT"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="div3">
                      <v-text-field
                        label="HCondBt"
                        dense
                        v-model="HCondBt"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="HCollier"
                        dense
                        v-model="HCollierBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Hbobine"
                        dense
                        v-model="HbobineBtSec"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="EpaisseurPapierCanauxBT"
                        dense
                        v-model="EpaisseurPapierCanauxBT"
                        outlined
                      ></v-text-field>
                    </div>
                  </div>
                </div>
              </form>
            </v-card>
            <v-btn color="primary" @click="e1 = 1"> précédent </v-btn>
            <v-btn color="success" @click="e1 = 3"> suivant </v-btn>
          </v-stepper-content>
          <v-stepper-step :complete="e1 > 3" step="3">
            Diamétre
          </v-stepper-step>
          <v-stepper-content step="3">
            <v-card class="mb-2">
              <div class="content">
                <form v-on:submit.prevent="updateprojet">
                  <div class="user-details">
                    <div class="div">
                      <div class="div2">
                        <v-select
                          :items="typeCanaux"
                          label="typeCanaux"
                          v-model="projet.typeCanauxBT"
                          outlined
                        ></v-select>
                        <v-text-field
                          label="CanauxBT"
                          id="canauxBT"
                          readonly
                          v-model="projet.canauxBT"
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="Lrg Cales"
                          id="lgCales"
                          readonly
                          v-model="projet.lgCalesBT"
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="EpaisseurPapierCanaux"
                          v-model="EpaisseurPapierCanauxBT"
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="canauxNbrPapier"
                          v-model="projet.canauxNbrPapierBT"
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="majPoid"
                          v-model="projet.majPoidBT"
                          outlined
                        ></v-text-field>
                      </div>
                      <div class="field10">
                        <v-text-field
                          label="DintBT"
                          v-model="DintBT"
                          dense
                          outlined
                        ></v-text-field>

                        <v-text-field
                          label="BintBT"
                          v-model="BintBT"
                          dense
                          outlined
                        ></v-text-field>

                        <v-text-field
                          label="DistanceBTMT"
                          v-model="projet.DistanceBTMTSec"
                          dense
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="EpCylindre"
                          v-model="projet.EpCylindreBT"
                          dense
                          outlined
                        ></v-text-field>

                        <v-text-field
                          label="EpxBT"
                          v-model="EpxBT"
                          dense
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="EpyBT"
                          v-model="EpyBT"
                          dense
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="DextBT"
                          v-model="DextBT"
                          outlined
                          dense
                        ></v-text-field>

                        <v-text-field
                          label="BextBT"
                          dense
                          v-model="BextBT"
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
                  </div>
                </form>
              </div>
            </v-card>
            <v-btn color="primary" @click="e1 = 2"> précédent </v-btn>
            <v-btn color="success" @click="updateprojet"> Valider </v-btn>
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
      emaille: [],
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
        canauxNbrPapierBT: "",
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
        canauxNbrPapierBT: this.projet.canauxNbrPapierBT,
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
    axios.get("/emaille").then((response) => (this.emaille = response.data));
  },
  computed: {
    scu2d() {
      return (
        parseFloat(this.projet.secondaireIPhase) / parseFloat(this.projet.J2D)
      );
    },
    D2d() {
      return (
        2 *
        Math.sqrt(
          this.projet.scu2d /
            (Math.PI * parseFloat(this.projet.brinParalleleBT))
        )
      );
    },
    nbrPapierBT() {
      return Math.ceil(
        ((this.projet.SpchBBT * this.projet.Vsp * 4) /
          this.projet.rigiditePapierBT -
          (this.projet.filobtenueIsolerBT - this.projet.filobtenueNueBT)) /
          this.projet.EpfeuillePapierBT
      );
    },
    EpaiseurPapierBT() {
      return this.projet.EpfeuillePapierBT * this.projet.nbrPapierBT;
    },
    NchABT() {
      return Math.floor(
        this.projet.nbcoucheBT * this.projet.SpchBBT - this.projet.N2cmax
      );
    },
    SpchABT() {
      return Math.ceil(parseFloat(this.projet.SpchBBT) - 1);
    },
    NchBBT() {
      return this.projet.nbcoucheBT - this.projet.NchABT;
    },
    SpchBBT() {
      return Math.ceil(this.projet.N2cmax / this.projet.nbcoucheBT);
    },
    HbobineBtSec() {
      // console.log(this.projet.HbobineBt);
      return this.projet.HbobineBt;
    },
    HCollierBT() {
      console.log(this.projet.HCondBt);
      return (this.projet.HbobineBtSec - this.projet.HCondBt) / 2;
    },
    HCondBt() {
      return (
        this.projet.SpchBBT *
        this.projet.filobtenueIsolerBT *
        this.projet.brinParalleleBT
      );
    },
    DintBT() {
      // console.log(this.projet.DextMT,this.projet.BextMT);
      // return parseFloat(Math.ceil(parseFloat(this.projet.DextMT)+(2*parseFloat(this.projet.DistanceBTMT))));
      let dint = this.projet.DintBT;
      dint =
        parseFloat(this.projet.DistanceBTMTSec) * 2 +
        parseFloat(this.projet.DextBT);
      // console.log(parseFloat(this.projet.DextBT));
      return dint;
    },
    BintBT() {
      return Math.ceil(this.projet.BextBT + 2 * this.projet.DistanceBTMTSec);
    },
    DextBT() {
      return this.projet.DintBT + 2 * this.projet.EpxBT;
    },
    BextBT() {
      return this.projet.BintBT + 2 * this.projet.EpyBT;
    },
    EpxBT() {
      if (this.projet.typeCanauxBT == "complet") {
        return (
          this.projet.nbcoucheBT * this.projet.filobtenueIsolerBT +
          this.projet.EpaiseurPapierBT *
            (this.projet.nbcoucheBT - 1 - this.projet.canauxBT) +
          this.projet.canauxBT * this.projet.lgCalesBT +
          this.projet.canauxBT * this.projet.EpaisseurPapierCanauxBT
        );
      } else if (this.projet.typeCanauxBT == "lune") {
        return (
          this.projet.nbcoucheBT * this.projet.filobtenueIsolerBT +
          this.projet.EpaiseurPapierBT * (this.projet.nbcoucheBT - 1)
        );
      } else {
        return 0;
      }
    },
    EpyBT() {
      if (this.projet.typeCanauxBT == "complet") {
        return this.projet.EpxBT;
      } else if (this.projet.typeCanauxBT == "lune") {
        return parseFloat(
          parseFloat(this.projet.nbcoucheBT) *
            parseFloat(this.projet.filobtenueIsolerBT) +
            parseFloat(this.projet.EpaiseurPapierBT) *
              (parseFloat(this.projet.nbcoucheBT) - 1) +
            parseFloat(this.projet.canauxBT) * parseFloat(this.projet.lgCalesBT)
        );
      } else {
        return 0;
      }
    },
    poidBT() {
      let coefPoid = 0;
      if (this.projet.materiauSec == "cuivre") {
        coefPoid = 8.9;
      } else if (this.projet.materiauSec == "aluminium") {
        coefPoid = 2.7;
      }
      return (
        (Math.pow(10, -6) *
          (coefPoid *
            parseFloat(this.projet.N2cmax) *
            parseFloat(this.projet.scu2) *
            Math.PI *
            3) *
          ((parseFloat(this.projet.DintBT) +
            parseFloat(this.projet.BintBT) +
            parseFloat(this.projet.DextBT) +
            parseFloat(this.projet.BextBT)) /
            4) *
          (100 + parseFloat(this.projet.majPoidBT))) /
        100
      );
    },
    scu2() {
      return (
        (Math.PI *
          Math.pow(this.projet.filobtenueNueBT, 2) *
          this.projet.brinParalleleBT) /
        4
      );
    },
    EpaisseurPapierCanauxBT() {
      return this.projet.canauxNbrPapierBT * this.projet.EpfeuillePapierBT;
    },
    j2() {
      console.log(this.projet.scu2);
      return this.projet.secondaireIPhase / this.projet.scu2;
    },
    N2cmax() {
      let spires = this.projet.spire
        .replace("[", "", this.projet.spire.length - 1)
        .replace("]", "")
        .split(",");
      return spires[0];
    },
    filobtenueIsolerBT() {
      let emaille = this.emaille;
      for (let i = 0; i < emaille.length; i++) {
        if (this.filobtenueNueBT == emaille[i].Designation) {
          return emaille[i].Isole;
        }
      }
      return 0;
    },
    filobtenueNueBT() {
      let emaille = this.emaille;
      let des = [];
      for (let i = 0; i < emaille.length; i++) {
        des[i] = emaille[i].Designation;
      }
      const needle = this.D2d;
      const closest = des.reduce((a, b) => {
        return Math.abs(b - needle) < Math.abs(a - needle) ? b : a;
      });
      return closest;
    },
  },
};
</script>
<style scoped>
.field10 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  /* grid-template-rows: repeat(3, 1fr); */
  grid-column-gap: 10px;
  width: 80%;
  /* margin-right: 5%; */
}
.div2 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  /* grid-template-rows: repeat(2, 1fr); */
  grid-column-gap: 10px;
  width: 56%;
  /* margin-right: 5%; */
}
.div3 {
  padding: auto;
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  grid-column-gap: 10px;
  width: 56%;
  /* margin-right: 5%; */
}

.div {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-column-gap: 10px;
}
.div4 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-column-gap: 10px;
  margin-left: 20%;
  width: 50%;
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
.frame {
  width: 250px;
  justify-content: space-between;
}
.frameii {
  width: 100%;
  border-color: #000;
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
  .field10 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-column-gap: 10px;
    width: 80%;
  }
  .div2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-column-gap: 10px;
    width: 56%;
  }
  .div3 {
    padding: auto;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-column-gap: 10px;
    width: 66%;
  }
  .div {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-column-gap: 10px;
  }
  .div4 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-column-gap: 10px;
    margin-left: 20%;
    width: 50%;
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
}
@media (max-width: 668px) {
  .field10 {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    grid-column-gap: 10px;
    width: 80%;
  }
  .div2 {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    grid-column-gap: 10px;
    width: 56%;
  }
  .div3 {
    padding: auto;
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    grid-column-gap: 10px;
    width: 66%;
  }
  .div {
    display: grid;
    grid-template-columns: 1fr;
    grid-column-gap: 10px;
  }
  .div4 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-column-gap: 10px;
    margin-left: 20%;
    width: 50%;
  }
}
.v-btn:not(.v-btn--round).v-size--default {
  /* height: 36px; */
  /* min-width: 64px; */
  padding: 16px;
  margin: 3px;
}
</style>
