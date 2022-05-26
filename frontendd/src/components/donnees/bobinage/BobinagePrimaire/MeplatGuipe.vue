<template>
  <div>
    <NavDash
      :conducteurMT="projet.conducteurMT"
      :conducteurBT="projet.conducteurBT"
    />
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <v-stepper-step :complete="e1 > 1" step="1">
          Bobinage du primaire en fil méplat
        </v-stepper-step>
        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-4">
              <div class="title">Bobine haute tension</div>
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div style="margin-bottom: 2%">
                    <v-chip
                      >N1c :
                      {{ projet.N1c }}
                    </v-chip>
                    <v-chip style="margin-left: 2%"
                      >I2ph :
                      {{ projet.PrimaireIPhase }}
                    </v-chip>
                  </div>
                  <div class="div">
                    
                      <div class="field1">
                        <div class="field10">
                      <v-text-field
                      success
                        label="N1cmax"
                        v-model="N1cmax"
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
                        label="scu1d"
                        v-model="scu1d"
                        dense
                        outlined
                      ></v-text-field>
                   </div>
                      <div class="div2">
                      <v-select
                        :items="saillie"
                        label="saillieMT"
                        v-model="projet.saillieMT"
                        dense
                        outlined
                      ></v-select>
                      <v-select
                        :items="etage"
                        label="Etages"
                        v-model="projet.etageMT"
                        dense
                        outlined
                      ></v-select>
                      <v-select
                        :items="hbrin"
                        label="Hbrin 1MT"
                        v-model="projet.hbrin1MT"
                        dense
                        outlined
                      ></v-select>
                      <v-text-field
                        label="NbBrin 1"
                        v-model="projet.nbBrin1MT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-select
                        :items="hbrin"
                        label="Hbrin 2MT"
                        v-model="projet.hbrin2MT"
                        dense
                        outlined
                      ></v-select>
                      <v-text-field
                        label="NbBrin 2"
                        v-model="projet.nbBrin2MT"
                        dense
                        outlined
                      ></v-text-field>
                   
                    </div> 
                    </div>
                    <div class="div2">
                         <v-text-field
                        label="Scu1"
                        success
                        dense
                        id="scu1"
                        readonly
                        v-model="scu1"
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="j1"
                        dense
                        id="j1"
                        readonly
                        v-model="j1"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Eguip ax"
                        v-model="projet.e1ax"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="Eguip rad"
                        v-model="projet.e1r"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="Rigidité Papier"
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
                        label="ep1PapierMT"
                        dense
                        v-model="projet.ep1PapierMT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="nbrPapierMT"
                        dense
                        v-model="projet.nbrPapierMT"
                        outlined
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
                        label="Hspire"
                        v-model="hSpire"
                        success
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="HSFS"
                        v-model="hsfs"
                        success
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="HFS"
                        success
                        v-model="hfs"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="HbobineMt"
                        v-model="hbobt"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="CollierMT"
                        v-model="projet.collierBT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        label="CollierMT2"
                        dense
                        success
                        v-model="collierBt2"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="div2">
                          <v-text-field
                        label="nbcoucheMT"
                        v-model="projet.nbcoucheMT"
                        outlined
                        dense
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
                      ></v-text-field>       </div>
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
 <div class="div">
                      <div class="div2">
                        <v-select
                        :items="typeCanaux"
                        label="typeCanaux"
                        v-model="projet.typeCanaux"
                        dense
                        outlined
                      ></v-select>
                      <v-text-field
                        label="CanauxMT"
                        dense
                        id="canauxMT"
                        
                        v-model="projet.canauxMT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Lrg Cales"
                        dense
                        id="lgCales"
                        readonly
                        v-model="projet.lgCales"
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="Ep1Papier"
                        v-model="projet.canauxEp1Papier"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="NbrPapier"
                        v-model="projet.canauxNbrPapier"
                        outlined
                        dense
                      ></v-text-field>
                        <v-text-field
                          label="majPoid"
                          v-model="projet.majPoid"
                          outlined
                          dense
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
                      </div>
                      <div class="div2">
                      
                        <v-text-field
                        success
                          label="DintMT"
                          v-model="DintBint"
                          dense
                          outlined
                        ></v-text-field>

                        <v-text-field
                          label="BintMT"
                          v-model="DintBint"
                          dense
                          success
                          outlined
                        ></v-text-field>

                        <v-text-field
                        success
                          label="EpxMT"
                          v-model="Epx"
                          dense
                          outlined
                        ></v-text-field>
                        <v-text-field
                        success
                          label="EpyMT"
                          v-model="Epy"
                          dense
                          outlined
                        ></v-text-field>
                        <v-text-field
                        success
                          label="DextMT"
                          v-model="Dext"
                          outlined
                          dense
                        ></v-text-field>

                        <v-text-field
                        success
                          label="BextMT"
                          dense
                          v-model="Bext"
                          outlined
                        ></v-text-field>

                        <v-text-field
                          label="poidMT"
                          dense
                          success
                          v-model="poid"
                          outlined
                        ></v-text-field>
                      </div>
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
      barre: [],
      hbrin: [],
      saillie: [],
      conducteur: ["meplat guipé", "Rond emaille", "feuillard"],
      materiau: ["cuivre", "aluminium"],
      etage: ["1", "2"],
      typeCanaux: ["complet", "lune"],
      projet: {
        id: undefined,
        materiau: "",
        conducteur: "",
        etageMT: "",
        saillieMT: "",
        hbrin1MT: "",
        hbrin2MT: "",
        nbBrin1MT: "",
        nbBrin2MT: "",
        scu1: "",
        j1: "",
        nbcoucheMT: "",
        spCoucheMT: "",
        e1ax: "",
        e1r: "",
        rigiditePapierMT: "",
        ep1PapierMT: "",
        nbrPapierMT: "",
        typeCanaux: "",
        canauxMT: "",
        lgCales: "",
        canauxEp1Papier: "",
        canauxNbrPapier: "",
        Hspire: "",
        HSFS: "",
        HFS: "",
        HbobineBt: "",
        collierBT: "",
        collierBT2: "",
        CMBT: "",
        DintMT: "",
        BintMT: "",
        EpxMT: "",
        EpyMT: "",
        DextMT: "",
        BextMT: "",
        poidMT: "",
        majPoid: "",
        nbrPapier: "",
        EpfeuillePapier: "",
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
        etageMT: this.projet.etageMT,
        saillieMT: this.projet.saillieMT,
        hbrin1MT: this.projet.hbrin1MT,
        hbrin2MT: this.projet.hbrin2MT,
        nbBrin1MT: this.projet.nbBrin1MT,
        nbBrin2MT: this.projet.nbBrin2MT,
        scu1: this.projet.scu1,
        j1: this.projet.j1,
        nbcoucheMT: this.projet.nbcoucheMT,
        spCoucheMT: this.projet.spCoucheMT,
        e1ax: this.projet.e1ax,
        e1r: this.projet.e1r,
        rigiditePapierMT: this.projet.rigiditePapierMT,
        ep1PapierMT: this.projet.ep1PapierMT,

        nbrPapierMT: this.projet.nbrPapierMT,
        nbrPapier: this.projet.nbrPapier,
        typeCanaux: this.projet.typeCanaux,
        canauxMT: this.projet.canauxMT,
        lgCales: this.projet.lgCales,
        canauxEp1Papier: this.projet.canauxEp1Papier,
        canauxNbrPapier: this.projet.canauxNbrPapier,
        Hspire: this.projet.Hspire,
        HSFS: this.projet.HSFS,
        HFS: this.projet.HFS,
        HbobineBt: this.projet.HbobineBt,
        collierBT: this.projet.collierBT,
        collierBT2: this.projet.collierBT2,
        CMBT: this.projet.CMBT,
        DintMT: this.projet.DintMT,
        BintMT: this.projet.BintMT,
        EpxMT: this.projet.EpxMT,
        EpyMT: this.projet.EpyMT,
        DextMT: this.projet.DextMT,
        BextMT: this.projet.BextMT,
        poidMT: this.projet.poidMT,
        majPoid: this.projet.majPoid,
        EpfeuillePapier: this.projet.EpfeuillePapier,
      };
      axios
        .put("bobine/update/" + this.$route.params.id, projets)
        .then(
          (response) => ((this.id = response.data.id), console.log(this.projet))
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
      scu1d() {
      return Math.round(
        (parseFloat(this.projet.PrimaireIPhase) / parseFloat(this.projet.J1D)) *
          100
      )/100;
    },
    scu1() {
      return (
        0.987 *
        this.projet.saillieMT *
        this.projet.etageMT *
        (this.projet.hbrin1MT * this.projet.nbBrin1MT +
          this.projet.hbrin2MT * this.projet.nbBrin2MT)
      );
    },
      N1cmax() {
      let spires = this.projet.spire
        .replace("[", "", this.projet.spire.length - 1)
        .replace("]", "")
        .split(",");
      return Math.round(spires[0]*100)/100;
    },
    j1() {
      return Math.round(this.projet.PrimaireIPhase / this.scu1*100)/100;
    },
    spCouche() {
      return Math.ceil( this.N1cmax / this.projet.nbcoucheMT);
    },
    hSpire() {
      return (
        (this.projet.hbrin1MT + this.projet.e1ax) * this.projet.nbBrin1MT +
        (this.projet.hbrin2MT + this.projet.e1ax) * this.projet.nbBrin2MT
      );
    },
    hsfs() {
      return (
        this.hSpire * this.spCouche +
        (this.projet.etageMT - 1) *
          (this.projet.hbrin1MT + this.projet.hbrin2MT + this.projet.e1ax * 2)
      );
    },
    hfs() {
      if (this.projet.hbrin1MT == 0) {
        return (
          this.hSpire * this.spCouche +
          (this.projet.etageMT - 1) * (this.projet.hbrin1MT + this.projet.e1ax)
        );
      } else {
        return (
          this.hSpire * this.spCouche +
          (this.projet.etageMT - 1) *
            (this.projet.hbrin1MT + this.projet.hbrin2MT + this.projet.e1ax * 2)
        );
      }
    },
    hbobt() {
      return this.hfs + this.projet.collierBT * 2;
    },
    collierBt2() {
      return this.hbobt - this.hfs - this.projet.collierBT;
    },
    poid() {
      let coefPoid = 0;
      if (this.projet.materiauMT == "cuivre") {
        coefPoid = 8.9;
      } else if (this.projet.materiauMT == "aluminium") {
        coefPoid = 2.7;
      }
      return (
        Math.pow(10, -6) *
        (coefPoid *
          parseFloat(this.projet.N1c) *
          parseFloat(this.projet.scu1) *
          (parseFloat(this.projet.DintMT) + parseFloat(this.projet.EpxMT)) *
          Math.PI *
          3 *
          ((100 + parseFloat(this.projet.majPoid)) / 100))
      );
    },
    DintBint() {
      return this.projet.diamNominale + 2 * this.projet.CMBT;
    },
    Epx() {
      let epx = this.projet.EpxMT;
      if (this.projet.typeCanaux == "complet") {
        epx =
          (this.projet.saillieMT + this.projet.e1r) *
            this.projet.etageMT *
            this.projet.nbcoucheMT +
          this.projet.canauxMT * this.projet.lgCales +
          this.projet.nbrPapierMT * this.projet.canauxEp1Papier;
      } else if (this.projet.typeCanaux == "lune") {
        epx =
          (this.projet.saillieMT + this.projet.e1r) *
          this.projet.etageMT *
          this.projet.nbcoucheMT;
      }

      // console.log("hhhhh",this.projet.nbrPapier);
      return epx;
    },
    Epy() {
      return (
         (this.projet.saillieMT + this.projet.e1r) *
            this.projet.etageMT *
            this.projet.nbcoucheMT +
          this.projet.canauxMT * this.projet.lgCales +
          this.projet.nbrPapierMT * this.projet.canauxEp1Papier
      );
    },
    Dext() {
      // console.log(this.projet.DintMT,this.projet.EpxMT);
      return this.projet.DintMT + 2 * this.Epx;
    },
    Bext() {
      return this.DintBint + 2 * this.Epy;
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
    // esel aaleha
        nbrPapierMt() {
      return Math.ceil(
        ((this.SpchB * this.projet.Vsp * 4) /
          this.projet.rigiditePapierMT ) /
          this.projet.EpfeuillePapier
      );
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

.field1{
  display: grid;
  grid-template-rows: repeat(1, 1fr);
/*   
  grid-gap: 10px; */
  width: 80%;
}
.div2 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 10px;
  width: 350px;
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
