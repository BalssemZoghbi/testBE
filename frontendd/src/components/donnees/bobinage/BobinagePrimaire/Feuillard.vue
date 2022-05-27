<template>
  <div>
    <NavDash
      :conducteurMT="projet.conducteurMT"
      :conducteurBT="projet.conducteurBT"
    />
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <v-stepper-step :complete="e1 > 1" step="1">
          Bobinage du primaire en feuillards
        </v-stepper-step>
        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-4">
              <div class="title">Bobine haute tension</div>
              <form>
                <div class="user-details">
                  <div style="margin-bottom: 2%">
                    <v-chip
                      >materiau :
                      {{ projet.materiauMT }}
                    </v-chip>
                    <v-chip style="margin-left: 1%"
                      >conducteur :
                      {{ projet.conducteurMT }}
                    </v-chip>
                    <v-chip style="margin-left: 1%"
                      >N2c :
                      {{ projet.N2c }}
                    </v-chip>
                    <v-chip style="margin-left: 1%"
                      >I1ph :
                      {{ projet.PrimaireIPhase }}
                    </v-chip>
                  </div>
                  <div class="div">
                    <div class="field10">
                      <v-text-field
                        label="Hfeuillard"
                        v-model="projet.Hfeuillard"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="HbobineBt"
                        v-model="HbobineBt"
                        dense
                        outlined
                        success
                      ></v-text-field>
                      <v-text-field
                        label="collierBT"
                        v-model="projet.collierBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="epFeuil1"
                        v-model="projet.epFeuil1"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="epFeuil2"
                        v-model="projet.epFeuil2"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="epFeuillard"
                        v-model="epFeuillard"
                        success
                        dense
                        outlined
                      ></v-text-field>
                     
                      <v-text-field
                        label="scu1"
                        v-model="scu1"
                        dense
                        success
                        outlined
                      ></v-text-field>
                          <v-text-field
                        label="j1"
                        v-model="j1"
                        dense
                        success
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="ep1PapierMT"
                        dense
                        id="ep1PapierMT"
                        v-model="projet.ep1PapierMT"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                  
                      <v-text-field
                        label="nbrPap1"
                        dense
                        id="nbrPap1"
                        
                        v-model="projet.nbrPap1"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="ep2Papier"
                        dense
                        id="ep2Papier"
                        v-model="projet.ep2Papier"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="nbrPap2"
                        dense
                        id="nbrPap2"
                        v-model="projet.nbrPap2"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="ePap"
                        success
                        v-model="ePap"
                        readonly
                        outlined
                        dense
                      ></v-text-field>
                              <v-text-field
                      success
                        label="largeurBarre"
                        v-model="largeurBarre"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                      success
                        label="epaisseurBarre"
                        v-model="epaisseurBarre"
                        dense
                        outlined
                      ></v-text-field>

                      <v-select
                        :items="barre"
                        label="barre"
                        success
                        v-model="projet.Epbarre"
                        dense
                        outlined
                      ></v-select>
                      <v-text-field
                        label="Sbarre"
                        v-model="Sbarre"
                        success
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="Jbarre"
                        v-model="Jbarre"
                        success
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
            Canaux/Diamétre
          </v-stepper-step>

          <v-stepper-content step="2">
            <v-card class="mb-4">
              <div class="title">Canaux/Diamétre</div>
              <!-- <div class="content"> -->
              <form >
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
                        outlined
                      ></v-select>

                      <v-text-field
                        label="CanauxMT"
                        id="canauxMT"
                        
                        v-model="projet.canauxMT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Lrg Cales"
                        id="lgCales"
                        
                        v-model="projet.lgCales"
                        outlined
                      ></v-text-field>

                      <!-- <v-text-field
                        label="EpfeuillePapier"
                        v-model="projet.EpfeuillePapier"
                        outlined
                      ></v-text-field> -->
                       <v-text-field
                        label="epFeuilPap"
                        v-model="projet.epFeuilPap"
                        
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="NbrPapier"
                        v-model="projet.nbrPapierMT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="EpPapier"
                        success
                        v-model="EpPapier"
                        outlined
                      ></v-text-field>
                    </div>

                    <div class="div2">
                      <v-text-field
                      success
                        label="DintMT"
                        v-model="DintMT"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="BintMT"
                        success
                        v-model="DintMT"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="EpxMT"
                        success
                        v-model="EpxMT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="EpyMT"
                        v-model="EpxMT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="DextMT"
                        success
                        v-model="DextMT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        label="BextMT"
                        success
                        dense
                        v-model="BextMT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="majPoid"
                        dense
                        v-model="projet.majPoid"
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="poidMT"
                        dense
                        v-model="poidMT"
                        outlined
                      ></v-text-field>
                    </div>
                  </div>
                </div>
              </form>
              <!-- </div> -->
            </v-card>
            <v-btn color="primary mb-4" @click="e1 = 1"> précédent </v-btn>
            <!-- <v-btn color="success" @click="e1 = 3"> suivant </v-btn>
          </v-stepper-content>
          <v-stepper-step :complete="e1 > 3" step="3"> Barre </v-stepper-step>
          <v-stepper-content step="3">
            <v-card class="mb-4">
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div style="margin-bottom: 2%">
                    <v-chip
                      >materiau :
                      {{ projet.materiauMT }}
                    </v-chip>
                    <v-chip style="margin-left: 1%"
                      >conducteur :
                      {{ projet.conducteurMT }}
                    </v-chip>
                  </div>

                  <div class="div">
                    <div class="div2">
                      <v-text-field
                      success
                        label="largeurBarre"
                        v-model="largeurBarre"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                      success
                        label="epaisseurBarre"
                        v-model="epaisseurBarre"
                        dense
                        outlined
                      ></v-text-field>

                      <v-select
                        :items="barre"
                        label="barre"
                        success
                        v-model="projet.Epbarre"
                        dense
                        outlined
                      ></v-select>
                      <v-text-field
                        label="Sbarre"
                        v-model="Sbarre"
                        success
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="Jbarre"
                        v-model="Jbarre"
                        success
                        outlined
                        dense
                      ></v-text-field>
                    </div>
                  </div>
                </div>
              </form>
            </v-card>
            <v-btn color="primary mb-4" @click="e1 = 2"> précédent </v-btn> -->
            <v-btn color="success mb-4" @click="updateprojet"> Valider </v-btn>
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
      etage: ["1", "2"],
      typeCanaux: ["complet", "lune"],
      projet: {
        id: undefined,
        materiau: "",
        conducteur: "",
        scu1: "",
        j1: "",
        ep1PapierMT: "",
        nbrPapierMT: "",
        typeCanaux: "",
        canauxMT: "",
        lgCales: "",
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
        Hfeuillard: "",
        HbobineBt: "",
        epFeuil1: "",
        epFeuil2: "",
        epFeuillard: "",
        ep2Papier: "",
        nbrPap2: "",
        ePap: "",
        epFeuilPap: "",
        nbrPap1: "",
        EpPapier: "",
        EpCylindre: "",
        Epbarre: "",
        epaisseurBarre: "",
        largeurBarre: "",
        Sbarre: "",
        Jbarre: "",
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
        ep1PapierMT: this.projet.ep1PapierMT,
        nbrPapierMT: this.projet.nbrPapierMT,
        typeCanaux: this.projet.typeCanaux,
        canauxMT: this.projet.canauxMT,
        lgCales: this.projet.lgCales,
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
        Hfeuillard: this.projet.Hfeuillard,
        HbobineBt: this.projet.HbobineBt,
        epFeuil1: this.projet.epFeuil1,
        epFeuil2: this.projet.epFeuil2,
        epFeuillard: this.projet.epFeuillard,
        ep2Papier: this.projet.ep2Papier,
        nbrPap2: this.projet.nbrPap2,
        nbrPap1: this.projet.nbrPap1,
        ePap: this.projet.ePap,
        epFeuilPap: this.projet.epFeuilPap,
        EpPapier: this.projet.EpPapier,
        EpCylindre: this.projet.EpCylindre,
        Epbarre: this.projet.Epbarre,
        designationBarre: this.projet.designationBarre,
        epaisseurBarre: this.projet.epaisseurBarre,
        largeurBarre: this.projet.largeurBarre,
        Sbarre: this.projet.Sbarre,
        Jbarre: this.projet.Jbarre,
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
      const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
    console.log(this.projet);
  },
  computed: {
    HbobineBt(){
      return parseFloat(this.projet.Hfeuillard)+2*parseFloat(this.projet.collierBT);
    },
    epFeuillard(){
      return parseFloat(this.projet.epFeuil1)+parseFloat(this.projet.epFeuil2);
    },
    //  resoudre probleme 
    // epFeuilPap(){
    //   return parseFloat(this.projet.epFeuilPap)*parseFloat(this.projet.nbrPapierMT);
    // },
    EpPapier(){
      console.log(this.projet.epFeuilPap,this.projet.nbrPapierMT);
      return  parseFloat(this.projet.epFeuilPap)*parseFloat(this.projet.nbrPapierMT);
    },

    scu1(){
      return parseFloat(this.projet.Hfeuillard)*(this.epFeuillard);
    },
    j1(){
      
            return this.projet.PrimaireIPhase/this.scu1;
        },
    ePap(){
      return (parseFloat(this.projet.ep1PapierMT)*parseFloat(this.projet.nbrPap1))+(parseFloat(this.projet.ep2Papier)*parseFloat(this.projet.nbrPap2));
    },
    DintMT(){
        let dint=this.projet.DintMT;
        dint=(parseFloat(this.projet.CMBT)*2)+parseFloat(this.projet.diamNominale);
        return dint;
    },
    DextMT(){
        return Math.round(this.DintMT+(2*this.EpxMT));
    },
    BextMT(){
    
        return Math.round(this.DextMT+parseFloat(this.epaisseurBarre));
    },
    EpxMT(){
         if(this.projet.typeCanaux=='complet'){
        return ((parseFloat(this.projet.N2c)*this.epFeuillard)+(parseFloat(this.projet.N2c)-1)*this.ePap+(parseFloat(this.projet.canauxMT)*parseFloat(this.projet.lgCales)));
        }else if(this.projet.typeCanaux=='lune'){
            return (parseFloat(this.projet.N2c)*this.epFeuillard+(parseFloat(this.projet.N2c)-1)*(this.ePap));
        }else {
            return 0;
        }
    },

    poidMT(){ 
        let coefPoid=0;
         if(this.projet.materiauMT=='cuivre'){
                coefPoid=8.9;
            }else if(this.projet.materiauMT=='aluminium'){
                coefPoid=2.7;
            }
            return Math.pow(10, -6)*(coefPoid*parseFloat(this.projet.N2c)*parseFloat(this.projet.scu1)*Math.PI*3)*((parseFloat(this.DintMT)+parseFloat(this.DintMT)+parseFloat(this.DextMT)+parseFloat(this.BextMT))/4)*(100+parseFloat(this.projet.majPoid))/100;
    },
    Jbarre(){
      return this.projet.secondaireIPhase/this.Sbarre;
    },
    Sbarre(){
      return this.epaisseurBarre*this.largeurBarre;
    },
       epaisseurBarre(){
      
      if(this.projet.Epbarre == null){
        return 0;
      }else{
        let barre=this.projet.Epbarre;
          return barre.split("*")[0];
      }
    
    },
    largeurBarre(){
    console.log(this.projet.Epbarre);
       if(this.projet.Epbarre == null){
        return 0;
      }else{
        let barre=this.projet.Epbarre;
         return barre.split("*")[1];
      }
     
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
