<template>
  <div>
    <navbarUpdate />
    <NavDash
      :conducteurMT="projet.conducteurMT"
      :conducteurBT="projet.conducteurBT"
    />
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <v-stepper-step :complete="e1 > 1" step="1">
          Bobinage du primaire en fil rond
        </v-stepper-step>
        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-4">
              <div class="title">Bobine haute tension</div>
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div style="margin-bottom: 2%">
                    <v-chip
                      >materiau :
                      {{ projet.materiauMT }}
                    </v-chip>
                    <v-chip style="margin-left: 2%"
                      >conducteur :
                      {{ projet.conducteurMT }}
                    </v-chip>
                  </div>
                  <div class="div">
                    <div class="field10">
                      <v-text-field
                      success
                        label="N1cmax"
                        v-model="N1cmax"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="scu1d"
                        v-model="scu1d"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="J1D"
                        v-model="projet.J1D"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                      success
                        label="D1d"
                        v-model="D1d"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="scu1"
                        v-model="scu1"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="j1"
                        v-model="j1"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="brinParallele"
                        v-model="projet.brinParallele"
                        dense
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                      success
                        label="filobtenueNue"
                        dense
                        id="filobtenueNue"
                        readonly
                        v-model="filobtenueNue"
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="filobtenueIsoler"
                        dense
                        id="filobtenueIsoler"
                        readonly
                        v-model="filobtenueIsoler"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="rigiditePapierMT"
                        v-model="projet.rigiditePapierMT"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="EpfeuillePapier"
                        v-model="projet.EpfeuillePapier"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                      success
                        label="nbrPapierMt"
                        v-model="nbrPapierMt"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                      success
                        label="EpaiseurPapier"
                        v-model="EpaiseurPapier"
                        outlined
                        dense
                      ></v-text-field>
                    </div>
                  </div>
                </div>
              </form>
            </v-card>
           <v-btn color="primary mb-16" @click="routeur">
                précédent
              </v-btn>
            <v-btn color="success mb-16" @click="e1 = 2"> suivant </v-btn>
          </v-stepper-content>
          <v-stepper-step :complete="e1 > 2" step="2">
            Hauteur/caneaux
          </v-stepper-step>

          <v-stepper-content step="2">
            <v-card class="mb-4">
              <div class="title">Hauteur/caneaux</div>
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div class="div">
                    <div class="div2">
                      <v-text-field
                        label="nbcoucheMT"
                        v-model="projet.nbcoucheMT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="choix"
                        v-model="projet.choix"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="NchA"
                        success
                        v-model="NchA"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="SpchA"
                        v-model="SpchA"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="NchB"
                        success
                        v-model="NchB"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                      success
                        label="SpchB"
                        dense
                        v-model="SpchB"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="div3">
                      <v-text-field
                      success
                        label="HCondMt"
                        v-model="HCondMt"
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="HCollier"
                        v-model="HCollier"
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="Hbobine"
                        v-model="HbobineBt"
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
                          v-model="projet.typeCanaux"
                          outlined
                        ></v-select>
                        <v-text-field
                          label="CanauxMT"
                          id="canauxMT"
                          readonly
                          v-model="projet.canauxMT"
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="Lrg Cales"
                          id="lgCales"
                          readonly
                          v-model="projet.lgCales"
                          outlined
                        ></v-text-field>
                        <v-text-field
                        success
                          label="EpaisseurPapierCanaux"
                          v-model="EpaisseurPapierCanaux"
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="canauxNbrPapier"
                          v-model="projet.canauxNbrPapier"
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="majPoid"
                          v-model="projet.majPoid"
                          outlined
                        ></v-text-field>
                      </div>
                      <div class="field10">
                        <v-text-field
                        success
                          label="DintMT"
                          v-model="DintMT"
                          dense
                          outlined
                        ></v-text-field>

                        <v-text-field
                          label="BintMT"
                          v-model="BintMT"
                          dense
                          success
                          outlined
                        ></v-text-field>

                        <v-text-field
                          label="DistanceBTMT"
                          v-model="projet.DistanceBTMT"
                          dense
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="EpCylindre"
                          v-model="projet.EpCylindre"
                          dense
                          outlined
                        ></v-text-field>

                        <v-text-field
                        success
                          label="EpxMT"
                          v-model="EpxMT"
                          dense
                          outlined
                        ></v-text-field>
                        <v-text-field
                          label="EpyMT"
                          v-model="EpyMT"
                          dense
                          outlined
                        ></v-text-field>
                        <v-text-field
                        success
                          label="DextMT"
                          v-model="DextMT"
                          outlined
                          dense
                        ></v-text-field>

                        <v-text-field
                        success
                          label="BextMT"
                          dense
                          v-model="BextMT"
                          outlined
                        ></v-text-field>

                        <v-text-field
                          label="poidMT"
                          dense
                          success
                          v-model="poidMT"
                          outlined
                        ></v-text-field>
                      </div>
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
        materiau: "",
        conducteur: "",
        scu1: "",
        j1: "",
        nbcoucheMT: "",
        rigiditePapierMT: "",
        nbrPapierMt: "",
        typeCanaux: "",
        canauxMT: "",
        lgCales: "",
        canauxNbrPapier: "",
        DintMT: "",
        BintMT: "",
        EpxMT: "",
        EpyMT: "",
        DextMT: "",
        BextMT: "",
        poidMT: "",
        majPoid: "",
        EpCylindre: "",
        scu1d: "",
        J1D: "",
        D1d: "",
        filobtenueNue: "",
        filobtenueIsoler: "",
        choix: "",
        brinParallele: "",
        SpchB: "",
        NchB: "",
        SpchA: "",
        NchA: "",
        HCondMt: "",
        DistanceBTMT: "",
        HCollier: "",
        EpfeuillePapier: "",
        EpaiseurPapier: "",
        EpaisseurPapierCanaux: "",
        HbobineBt: "",
        N1cmax: "",
      },
      e1: 1,
    };
  },
  methods: {
    updateprojet() {
      const projets = {
        id: undefined,
        materiau: this.projet.materiau,
        conducteur: this.projet.conducteur,
        scu1: this.projet.scu1,
        j1: this.projet.j1,
        nbcoucheMT: this.projet.nbcoucheMT,
        rigiditePapierMT: this.projet.rigiditePapierMT,
        nbrPapierMt: this.projet.nbrPapierMt,
        typeCanaux: this.projet.typeCanaux,
        canauxMT: this.projet.canauxMT,
        lgCales: this.projet.lgCales,
        canauxNbrPapier: this.projet.canauxNbrPapier,
        DintMT: this.projet.DintMT,
        BintMT: this.projet.BintMT,
        EpxMT: this.projet.EpxMT,
        EpyMT: this.projet.EpyMT,
        DextMT: this.projet.DextMT,
        BextMT: this.projet.BextMT,
        poidMT: this.projet.poidMT,
        majPoid: this.projet.majPoid,
        N1cmax: this.projet.N1cmax,
        EpCylindre: this.projet.EpCylindre,
        scu1d: this.projet.scu1d,
        J1D: this.projet.J1D,
        filobtenueNue: this.projet.filobtenueNue,
        filobtenueIsoler: this.projet.filobtenueIsoler,
        choix: this.projet.choix,
        brinParallele: this.projet.brinParallele,
        SpchB: this.projet.SpchB,
        NchB: this.projet.NchB,
        SpchA: this.projet.SpchA,
        NchA: this.projet.NchA,
        HCondMt: this.projet.HCondMt,
        DistanceBTMT: this.projet.DistanceBTMT,
        HCollier: this.projet.HCollier,
        EpfeuillePapier: this.projet.EpfeuillePapier,
        EpaiseurPapier: this.projet.EpaiseurPapier,
        EpaisseurPapierCanaux: this.projet.EpaisseurPapierCanaux,
        HbobineBt: this.projet.HbobineBt,
      };
      axios
        .put("bobine/update/" + this.$route.params.id, projets)
        .then(
          (response) => ((this.id = response.data.id), console.log(projets))
        );
      this.$router.push("/projet/pccucc/" + this.$route.params.id);
    },
      routeur(){
     if (this.projet.conducteurBT == "Rond emaille") {
        this.$router.push(
          "/projet/bobinageSecondaireRond/" + this.$route.params.id
        );
      } else if (this.projet.conducteurBT == "feuillard") {
        this.$router.push(
          "/projet/bobinageSecondaireFeuillard/" + this.$route.params.id
        );
      } else if (this.projet.conducteurBT == "meplat guipé") {
        this.$router.push(
          "/projet/bobinageSecondaireMeplat/" + this.$route.params.id
        );
    }
    }
  },
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
  },
  async created() {
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

    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
    console.log(this.projet);
  },
  computed: {
    scu1d() {
      return (
        parseFloat(this.projet.PrimaireIPhase) / parseFloat(this.projet.J1D)
      );
    },
    D1d() {
      return (
        2 *
        Math.sqrt(
          this.scu1d / (Math.PI * parseFloat(this.projet.brinParallele))
        )
      );
    },
    nbrPapierMt() {
      return Math.ceil(
        ((this.projet.SpchB * this.projet.Vsp * 4) /
          this.projet.rigiditePapierMT -
          (this.projet.filobtenueIsoler - this.projet.filobtenueNue)) /
          this.projet.EpfeuillePapier
      );
    },
    EpaiseurPapier() {
      return parseFloat(this.projet.EpfeuillePapier) * this.nbrPapierMt;
    },
    NchA() {
      return Math.floor(
        this.projet.nbcoucheMT * this.SpchB - this.N1cmax
      );
    },
    SpchA() {
      return Math.ceil(this.SpchB - 1);
    },
    NchB() {
      return this.projet.nbcoucheMT - this.NchA;
    },
    SpchB() {
      return Math.ceil(this.N1cmax / this.projet.nbcoucheMT);
    },
    HbobineBt() {
      return this.projet.HbobineBtSec;
    },
    HCollier() {
      return Math.round((this.projet.HbobineBtSec - this.HCondMt) / 2);
    },
    HCondMt() {
      return (
        this.SpchB *
        this.filobtenueIsoler *
        this.projet.brinParallele
      );
    },
    
    DintMT() {
      return  parseFloat(this.projet.DistanceBTMT) * 2 + this.DextMT;
    },
    BintMT() {
      return Math.ceil(this.projet.BextMT + 2 * this.projet.DistanceBTMT);
    },
    DextMT() {
      console.log("dext");
      return Math.round(this.projet.DintMT + 2 * parseFloat(this.projet.EpxMT));
    },
    BextMT() {
      return Math.round(this.projet.BintMT + 2 * this.projet.EpyMT);
    },
    EpxMT() {
      if (this.projet.typeCanaux == "complet") {
        return (
         Math.round( this.projet.nbcoucheMT * this.filobtenueIsoler +
          this.EpaiseurPapier *
            (this.projet.nbcoucheMT - 1 - this.projet.canauxMT) +
          this.projet.canauxMT * this.projet.lgCales +
          this.projet.canauxMT * this.EpaisseurPapierCanaux)
        );
      } else if (this.projet.typeCanaux == "lune") {
        return Math.ceil(
          this.projet.nbcoucheMT * this.filobtenueIsoler +
          this.EpaiseurPapier * (this.projet.nbcoucheMT - 1)
        );
      } else {
        return 0;
      }
    },
    EpyMT() {
      if (this.projet.typeCanaux == "complet") {
        return this.EpxMT;
      } else if (this.projet.typeCanaux == "lune") {
        return Math.round(
          parseFloat(this.projet.nbcoucheMT) *
            this.filobtenueIsoler +
            this.EpaiseurPapier *
              (parseFloat(this.projet.nbcoucheMT) - 1) +
            parseFloat(this.projet.canauxMT) * parseFloat(this.projet.lgCales)
        );
      } else {
        return 0;
      }
    },
    poidMT() {
      let coefPoid = 0;
      if (this.projet.materiauMT == "cuivre") {
        coefPoid = 8.9;
      } else if (this.projet.materiauMT == "aluminium") {
        coefPoid = 2.7;
      }
      return (
        (Math.pow(10, -6) *
          (coefPoid *
            parseFloat(this.projet.N1c) *
            parseFloat(this.projet.scu1) *
            Math.PI *
            3) *
          ((this.DintMT +
            this.BintMT +
            this.DextMT +
            this.BextMT) /
            4) *
          (100 + parseFloat(this.projet.majPoid))) /
        100
      );
    },
    scu1() {
      return (
        (Math.PI *
          Math.pow(this.filobtenueIsoler, 2) *
          parseInt(this.projet.brinParallele)) /
        4
      );
    },
    EpaisseurPapierCanaux() {
      return this.projet.canauxNbrPapier * this.projet.EpfeuillePapier;
    },
    j1() {
      return this.projet.PrimaireIPhase / this.projet.scu1;
    },
    N1cmax() {
      let spires = this.projet.spire
        .replace("[", "", this.projet.spire.length - 1)
        .replace("]", "")
        .split(",");
      return spires[0];
    },
    filobtenueIsoler() {
      let emaille = this.emaille;
      for (let i = 0; i < emaille.length; i++) {
        if (this.filobtenueNue == emaille[i].Designation) {
          return emaille[i].Isole;
        }
      }
      return 0;
    },
    filobtenueNue() {
      let emaille = this.emaille;
      let des = [];
      for (let i = 0; i < emaille.length; i++) {
        des[i] = emaille[i].Designation;
      }
      const needle = this.D1d;
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