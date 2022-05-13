<template>
  <div>
    <navbarUpdate />
    <NavDash :conducteur="projet.conducteur" :conducteurSec="projet.conducteurSec"/>
   <div class="body">
      <v-stepper v-model="e1" vertical>
        <v-stepper-step :complete="e1 > 1" step="1">
          Bobinage du secondaire en fil rond
        </v-stepper-step>
        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-4">
              <div class="title">Bobine base tension</div>
      <form  v-on:submit.prevent="updateprojet">
         <div class="user-details">
           <div style="margin-bottom:2%">
                         <v-chip
                      >materiau :
                      {{ projet.materiauSec }}
                    </v-chip>
                    <v-chip style="margin-left:2%" 
                      >conducteur :
                      {{ projet.conducteurSec }}
                    </v-chip>
                    </div>
                     <div class="div">
                    <div class="field10">
                      <v-text-field
                        label="N2cmax"
                        v-model="projet.N2cmax"
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
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="D2d"
                        v-model="D2d"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="brinParallele"
                        v-model="projet.brinParalleleBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="filobtenueNue"
                        dense
                        id="filobtenueNue"
                        readonly
                        v-model="projet.filobtenueNueBT"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="filobtenueIsoler"
                        dense
                       id="filobtenueIsoler"
                            readonly
                            v-model="projet.filobtenueIsolerBT"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
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
                        label="nbrPapierBT"
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
              <!-- <div class="content"> -->
                 <form  v-on:submit.prevent="updateprojet">
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
                        v-model="projet.NchABT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
   
                        label= "SpchA"
                        v-model="projet.SpchABT"
                        dense
                        outlined
                      ></v-text-field>
                            <v-text-field
                        label="NchB"
                        v-model="projet.NchBBT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        label="SpchB"
                        dense
                        v-model="projet.SpchBBT"
                        outlined
                      ></v-text-field>
                      
                                          </div>
                    <div class="div3">
                        <v-text-field
                        label="HCondBt"
                        dense
                        v-model="projet.HCondBt"
                        outlined
                      ></v-text-field>
                        <v-text-field
                        label="HCollier"
                        dense
                        v-model="projet.HCollierBT"
                        outlined
                      ></v-text-field>
                        <v-text-field
                        label="Hbobine"
                        dense
                        v-model="projet.HbobineBtSec"
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
          <v-stepper-step :complete="e1 > 3" step="3">
            Diamétre
          </v-stepper-step>
          <v-stepper-content step="3">
            <v-card class="mb-2">
              <div class="content">
                            <form  v-on:submit.prevent="updateprojet">
         <div class="user-details">
                    <div class="div4" >
        <v-text-field
                        label="DintBT"
                        v-model="projet.DintBT"
                        dense
                        outlined
                      ></v-text-field>
                   
                      <v-text-field
                        label="BintBT"
                        v-model="projet.BintBT"
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
                        v-model="projet.EpxBT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
   
                        label= "EpyBT"
                        v-model="projet.EpyBT"
                        dense
                        outlined
                      ></v-text-field>
                            <v-text-field
                        label="DextBT"
                        v-model="projet.DextBT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        label="BextBT"
                        dense
                        v-model="projet.BextBT"
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
                        v-model="projet.poidBT"
                        outlined
                      ></v-text-field>
                  
                      </div>
                   </div>
                  <!-- </div> -->
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
      this.$router.push("/pccucc/"+this.$route.params.id);
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
   computed:{
    scu2d(){
      return parseFloat(this.projet.secondaireIPhase)/parseFloat(this.projet.J2D);
    },
    D2d(){
      return 2*(Math.sqrt(this.projet.scu2d/(Math.PI)));
    },
    nbrPapierBT(){
        return Math.ceil((((this.projet.SpchBBT*this.projet.Vsp*4)/this.projet.rigiditePapierBT)-(this.projet.filobtenueIsolerBT-this.projet.filobtenueNueBT))/this.projet.EpfeuillePapierBT);
    },
    EpaiseurPapierBT(){
        return this.projet.EpfeuillePapierBT*this.projet.nbrPapierBT;
    },
    NchA(){
        return Math.floor((this.projet.nbcoucheMT*this.projet.SpchB)-this.projet.N1cmax);
    },
    SpchA(){
        return Math.ceil(this.projet.SpchB-1);
    },
    NchB(){
        return (this.projet.nbcoucheMT-this.projet.NchA);
    },
    SpchB(){
        return Math.ceil(this.projet.N1cmax/this.projet.nbcoucheMT);
    },
    HbobineBt(){
        return this.projet.HbobineBtSec;
    },
    HCollier(){
        return (this.projet.HbobineBtSec-this.projet.HCondMt)/2;
    },
    HCondMt(){
        return (this.projet.SpchB*this.projet.filobtenueIsoler*this.projet.brinParallele);
    },
    DintMT(){
        // console.log(this.projet.DextMT,this.projet.BextMT);
        // return parseFloat(Math.ceil(parseFloat(this.projet.DextMT)+(2*parseFloat(this.projet.DistanceBTMT))));
        let dint=this.projet.DintMT;
        dint=(parseFloat(this.projet.DistanceBTMT)*2)+parseFloat(this.projet.DextMT);
        console.log(parseFloat(this.projet.DextMT));
        return dint;
    },
    BintMT(){
        return Math.ceil(this.projet.BextMT+(2*this.projet.DistanceBTMT));
    },
    DextMT(){
        return Math.round(this.projet.DintMT+(2*this.projet.EpxMT));
    },
    BextMT(){
        return Math.round(this.projet.BintMT+(2*this.projet.EpyMT));
    },
    EpxMT(){
         if(this.projet.typeCanaux=='complet'){
        return (this.projet.nbcoucheMT*this.projet.filobtenueIsoler+this.projet.EpaiseurPapier*(this.projet.nbcoucheMT-1-this.projet.canauxMT)+this.projet.canauxMT*this.projet.lgCales+this.projet.canauxMT*this.projet.EpaisseurPapierCanaux);
        }else if(this.projet.typeCanaux=='lune'){
            return (this.projet.nbcoucheMT*this.projet.filobtenueIsoler+this.projet.EpaiseurPapier*(this.projet.nbcoucheMT-1));
        }else {
            return 0;
        }
    },
    EpyMT(){ 
         if(this.projet.typeCanaux=='complet'){
        return (this.projet.EpxMT);
        }else if(this.projet.typeCanaux=='lune'){
        return parseFloat((parseFloat(this.projet.nbcoucheMT)*parseFloat(this.projet.filobtenueIsoler)+parseFloat(this.projet.EpaiseurPapier)*(parseFloat(this.projet.nbcoucheMT)-1)+parseFloat(this.projet.canauxMT)*parseFloat(this.projet.lgCales)));
        }else {
            return 0;
        }
    },
    poidMT(){ 
        let coefPoid=0;
         if(this.projet.materiau=='cuivre'){
                coefPoid=8.9;
            }else if(this.projet.materiau=='aluminium'){
                coefPoid=2.7;
            }
            return Math.pow(10, -6)*(coefPoid*parseFloat(this.projet.N1c)*parseFloat(this.projet.scu1)*Math.PI*3)*((parseFloat(this.projet.DintMT)+parseFloat(this.projet.BintMT)+parseFloat(this.projet.DextMT)+parseFloat(this.projet.BextMT))/4)*(100+parseFloat(this.projet.majPoid))/100;
    },
     scu1(){ 
        return (Math.PI*Math.pow(this.projet.filobtenueIsoler, 2))*this.projet.brinParallele/4;
         },
    EpaisseurPapierCanaux(){ 
        return this.projet.canauxNbrPapier*this.projet.EpfeuillePapier;
         },
   }
};
</script>
<style scoped>
.field10 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  /* grid-template-rows: repeat(3, 1fr); */
  grid-gap:10px;
  width: 80%;
  /* margin-right: 5%; */
}
.div2 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  /* grid-template-rows: repeat(2, 1fr); */
  grid-gap:10px;
  width: 56%;
  /* margin-right: 5%; */
}
.div3 {
  padding: auto;
  display: grid;
  grid-template-columns: repeat(1, 1fr);

  width: 46%;
  /* margin-right: 5%; */
}

.div{
  display: grid; 
  grid-template-columns: 1fr 1fr;
  grid-gap: 10px;
}
.div4{
  display: grid; 
  grid-template-columns: 1fr 1fr;
  grid-gap: 10px;
  margin-left:20%;
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
.titles {
  font-size: 20px;
  font-weight: 500;
  margin-top:-14% ;
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
    padding-bottom:0px;
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
    /* height: 36px; */
    /* min-width: 64px; */
    padding: 16px;
    margin: 3px;
}
</style>