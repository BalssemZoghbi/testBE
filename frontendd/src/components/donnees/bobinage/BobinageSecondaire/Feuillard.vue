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
          Bobinage du second en feuillards
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
                      {{ projet.materiauBT }}
                    </v-chip>
                    <v-chip style="margin-left: 1%"
                      >conducteur :
                      {{ projet.conducteurBT }}
                    </v-chip>
                    <v-chip style="margin-left: 1%"
                      >N2c :
                      {{ projet.N2c }}
                    </v-chip>
                    <v-chip style="margin-left: 1%"
                      >I1ph :
                      {{ projet.secondaireIPhase }}
                    </v-chip>
                  </div>
                  <div class="div">
                    <div class="field10">
                       <!-- <v-text-field
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
                      ></v-text-field> -->
                      <v-text-field
                        label="Hfeuillard"
                        v-model="projet.HfeuillardBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="HbobineBt"
                        v-model="HbobineBt"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="epFeuil1"
                        v-model="projet.epFeuil1BT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="epFeuil2"
                        v-model="projet.epFeuil2BT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="epFeuillard"
                        v-model="epFeuillardBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="scu2"
                        v-model="scu2"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="collierBT"
                        v-model="projet.collierBTSec"
                        dense
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                      success
                        label="j2"
                        v-model="j2"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      
                        label="ep1PapierBT"
                        dense
                        id="ep1PapierBT"
                        v-model="projet.ep1PapierBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="nbrPap1"
                        dense
                        id="nbrPap1"
                        v-model="projet.nbrPap1BT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="ep2Papier"
                        dense
                        id="ep2Papier"
                        v-model="projet.ep2PapierBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="nbrPap2"
                        dense
                        id="nbrPap2"
                        v-model="projet.nbrPap2BT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="ePap"
                        v-model="ePapBT"
                        readonly
                        outlined
                        dense
                      ></v-text-field>
                    </div>
                  </div>
                </div>
              </form>
            </v-card>
            <router-link class="nav-link" :to="'/projet/VoltSpires/' + projet.id"
              ><v-btn color="primary mb-16" @click="updateprojet">
                précédent
              </v-btn></router-link
            >
            <v-btn color="success mb-16" @click="e1 = 2"> suivant </v-btn>
          </v-stepper-content>

          <v-stepper-step :complete="e1 > 2" step="2">
            Caneaux/Diamétre
          </v-stepper-step>

          <v-stepper-content step="2">
            <v-card class="mb-4">
              <div class="title">Caneaux/Diamétre</div>
              <!-- <div class="content"> -->
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
                        v-model="projet.typeCanauxBT"
                        outlined
                      ></v-select>

                      <v-text-field
                        label="CanauxBT"
                        id="canauxBT"
                        v-model="projet.canauxBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Lrg Cales"
                        id="lgCalesBT"
                        v-model="projet.lgCalesBT"
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="EpfeuillePapier"
                        v-model="projet.EpfeuillePapierBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="NbrPapier"
                        v-model="projet.nbrPapierBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="EpPapier"
                        v-model="EpPapierBT"
                        outlined
                      ></v-text-field>
                    </div>

                    <div class="div2">
                      <v-text-field
                      success
                        label="DintBT"
                        v-model="DintBT"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                      success
                        label="BintBT"
                        v-model="DintBT"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                      success
                        label="EpxBT"
                        v-model="EpxBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="EpyBT"
                        v-model="EpxBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="DextBT"
                        v-model="DextBT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                      success
                        label="BextBT"
                        dense
                        v-model="BextBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="majPoidBT"
                        dense
                        v-model="projet.majPoidBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="poidBT"
                        dense
                        v-model="poidBT"
                        outlined
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
          <v-stepper-step :complete="e1 > 3" step="3"> Barre </v-stepper-step>
          <v-stepper-content step="3">
            <v-card class="mb-4">
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div style="margin-bottom: 2%">
                    <v-chip
                      >materiauBT :
                      {{ projet.materiauBT }}
                    </v-chip>
                    <v-chip style="margin-left: 1%"
                      >conducteurBT :
                      {{ projet.conducteurBT }}
                    </v-chip>
                  </div>

                  <div class="div">
                    <div class="div2">
                      <v-text-field
                      success
                        label="largeurBarre"
                        v-model="largeurBarreBT"
                        dense
                        outlined
                      ></v-text-field>

                      <v-text-field
                      success
                        label="epaisseurBarre"
                        v-model="epaisseurBarreBT"
                        dense
                        outlined
                      ></v-text-field>

                      <v-select
                        :items="barre"
                        label="barre"
                        v-model="projet.EpbarreBT"
                        dense
                        outlined
                      ></v-select>
                      <v-text-field
                      success
                        label="Sbarre"
                        v-model="SbarreBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                      success
                        label="Jbarre"
                        v-model="JbarreBT"
                        outlined
                        dense
                      ></v-text-field>
                    </div>
                  </div>
                </div>
              </form>
            </v-card>
            <v-btn color="primary mb-4" @click="e1 = 2"> précédent </v-btn>
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
      saillie:[],
      barre:[],
      hbrin:[],
      conducteurBT: ['meplat guipé','Rond emaille','feuillard'], 
      materiauSec: ['cuivre','aluminium'], 
       etage: ['1','2'], 
      typeCanaux: ['complet','lune'],
      projet: {
         id:undefined,
      materiauSec:"",
      conducteurSec:"",
        scu2:"",
        j2:"",
        EpfeuillePapierBT:"",
        ep1PapierBT:"",
        nbrPapierBT:"",
        typeCanauxBT:"",
        canauxBT:"",
        lgCalesBT:"",
        // scu2d: "",
        // J2D: "",
        collierBT:"",
        collierBT2:"",
        CMBTSec:"",
        DintBT:"",
        BintBT:"",
        EpxBT:"",
        EpyBT:"",
        DextBT:"",
        BextBT:"",
        poidBT:"",
        majPoidBT:"",
        HfeuillardBT:"",
        HbobineBtSec:"",
        epFeuil1BT:"",
        epFeuil2BT:"",
        epFeuillardBT:"",
        ep2PapierBT:"",
        nbrPap2BT:"",
        ePapBT:"",
        epFeuilPapBT:"",
        nbrPap1BT:"",
        EpPapierBT:"",
        EpCylindreBT:"",
        EpbarreBT:"",
        epaisseurBarreBT:"",
        largeurBarreBT:"",
        SbarreBT:"", 
        JbarreBT:"",
        collierBTSec:"",
      },
      e1:1
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
        // scu2d: this.projet.scu2d,
        // J2D: this.projet.J2D,
        ep1PapierBT: this.projet.ep1PapierBT,
        nbrPapierBT: this.projet.nbrPapierBT,
        typeCanauxBT: this.projet.typeCanauxBT,
        canauxBT: this.projet.canauxBT,
        lgCalesBT: this.projet.lgCalesBT,
        collierBT: this.projet.collierBT,
        collierBT2: this.projet.collierBT2,
        CMBTSec: this.projet.CMBTSec,
        DintBT: this.projet.DintBT,
        BintBT:this.projet.BintBT,
        EpxBT: this.projet.EpxBT,
        EpyBT: this.projet.EpyBT,
        DextBT: this.projet.DextBT,
        BextBT: this.projet.BextBT,
        poidBT: this.projet.poidBT,
        majPoidBT: this.projet.majPoidBT,
        HfeuillardBT: this.projet.HfeuillardBT,
        HbobineBtSec: this.projet.HbobineBtSec,
        epFeuil1BT: this.projet.epFeuil1BT,
        epFeuil2BT: this.projet.epFeuil2BT,
        epFeuillardBT: this.projet.epFeuillardBT,
        ep2PapierBT: this.projet.ep2PapierBT,
        nbrPap2BT: this.projet.nbrPap2BT,
        ePapBT: this.projet.ePapBT,
        epFeuilPapBT: this.projet.epFeuilPapBT,
        EpPapierBT: this.projet.EpPapierBT,
        EpCylindreBT: this.projet.EpCylindreBT,
        EpbarreBT: this.projet.EpbarreBT,
        epaisseurBarreBT: this.projet.epaisseurBarreBT,
        largeurBarreBT: this.projet.largeurBarreBT,
        SbarreBT: this.projet.SbarreBT,
        JbarreBT: this.projet.JbarreBT,
        collierBTSec: this.projet.collierBTSec,
      };
      axios.put('bobinesec/update/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id, console.log(projets))
        
      );
  if(this.projet.conducteurMT=="Rond emaille"){
      this.$router.push("/projet/bobinagePrimaireRond/"+this.$route.params.id);
    }else if(this.projet.conducteurMT=="feuillard"){
      this.$router.push("/projet/bobinagePrimaireFeuillard/"+this.$route.params.id);
    }else if(this.projet.conducteurMT=="meplat guipé"){
      this.$router.push("/projet/bobinagePrimaireMeplat/"+this.$route.params.id);
    }  },
  
  },
  async mounted() {
    const result = await axios.get('projets/'+this.$route.params.id);
    this.projet = result.data;
  },
   async created(){
       axios.get('/getdesignationBarre').then(
        (response) => (this.barre = response.data)
      );
       axios.get('/getValeurHbrin').then(
        (response) => (this.hbrin = response.data)
      );
       axios.get('/getValeurSaillie').then(
        (response) => (this.saillie = response.data)
      );
    const result = await axios.get("projets/" +this.$route.params.id);
    this.$store.dispatch("projet", result.data);
    this.projet = result.data;
    },
    computed:{
    HbobineBt(){
      return parseFloat(this.projet.HfeuillardBT)+2*parseFloat(this.projet.collierBTSec);
    },
    epFeuillardBT(){
      return parseFloat(this.projet.epFeuil1BT)+parseFloat(this.projet.epFeuil2BT);
    },
    epFeuilPapBT(){
      return parseFloat(this.projet.epFeuilPapBT)*parseFloat(this.projet.nbrPapierBT);
    },
    EpPapierBT(){
      return this.projet.EpfeuillePapierBT*parseFloat(this.projet.nbrPapierBT);
    },
    scu2(){
      return this.projet.HfeuillardBT*this.epFeuillardBT;
    },
    j2(){
            return parseFloat(this.projet.secondaireIPhase)/this.scu2;
        },
    ePapBT(){
      return (parseFloat(this.projet.ep1PapierBT)*parseFloat(this.projet.nbrPap1BT))+(parseFloat(this.projet.ep2PapierBT)*parseFloat(this.projet.nbrPap2BT));
    },
    DintBT(){
        let dint=this.projet.DintBT;
        dint=(parseFloat(this.projet.CMBT)*2)+parseFloat(this.projet.diamNominale);
        return dint;
    },
    DextBT(){
        return Math.round(this.DintBT+(2*this.EpxBT));
    },
    BextBT(){
      console.log(Math.round(this.DintBT+(2*this.EpxBT)+this.epaisseurBarreBT));
        return Math.round(this.DintBT+(2*this.EpxBT)+parseFloat(this.epaisseurBarreBT));
    },
    EpxBT(){
         if(this.projet.typeCanauxBT=='complet'){
        return ((parseFloat(this.projet.N2c)*this.epFeuillardBT)+(parseFloat(this.projet.N2c)-1)*this.ePapBT+(parseFloat(this.projet.canauxBT)*parseFloat(this.projet.lgCalesBT)));
        }else if(this.projet.typeCanauxBT=='lune'){
            return (this.projet.N2c*this.projet.epFeuillardBT+(this.projet.N2c-1)*(this.projet.ePapBT));
        }else {
            return 0;
        }
    },

    poidBT(){ 
        let coefPoid=0;
         if(this.projet.materiauBT=='cuivre'){
                coefPoid=8.9;
            }else if(this.projet.materiauBT=='aluminium'){
                coefPoid=2.7;
            }
            return Math.pow(10, -6)*(coefPoid*parseFloat(this.projet.N2c)*parseFloat(this.scu2)*Math.PI*3)*((parseFloat(this.DintBT)+parseFloat(this.DintBT)+parseFloat(this.DextBT)+parseFloat(this.BextBT))/4)*(100+parseFloat(this.projet.majPoidBT))/100;
    },
    JbarreBT(){
      return this.projet.secondaireIPhase/this.SbarreBT;
    },
    SbarreBT(){
      return parseFloat(this.epaisseurBarreBT)*parseFloat(this.largeurBarreBT);
    },
    epaisseurBarreBT(){
      let barre=this.projet.EpbarreBT;
      return barre.split("*")[0];
    },
    largeurBarreBT(){
      let barre=this.projet.EpbarreBT;
      return barre.split("*")[1];
    },
  
    }
 
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
