<template>
   <div>
  <!-- <navbarUpdate :conducteur="projet.conducteur" :conducteurSec="this.projet.conducteurSec"/> -->
        <NavDash :conducteur="projet.conducteur" :conducteurSec="projet.conducteurSec"/>

<div class="body">
      <v-stepper v-model="e1"  vertical>
   
      <v-stepper-step
        :complete="e1 > 1"
        step="1"
      >
       Données Bobinage
      </v-stepper-step>
 <v-stepper-content step="1">

    <!-- <v-stepper-items>
      <v-stepper-content step="1"> -->
  <v-card class="mb-14"  >
        <!-- <div class="body">
          
<div class="container"> -->
  
    <div class="content">
      <form  v-on:submit.prevent="updateprojet">
        <div class="user-details">
           <div class="input-box">
               <div class="title">bobine primaire</div>
               <div class="form__div">
                <v-select
                :items="materiau"
                label="materiau"
                v-model="projet.materiau"
                dense
                outlined
              ></v-select>
                </div>
          </div>
           
           <div class="input-box">
             <div class="title">bobine secondaire</div>
               <div class="form__div">
                    <!-- <input type="text" class="form__input" placeholder=" " id="materiauSec" v-model="projet.materiauSec">
                    <label for="" class="form__label">materiauSec</label> -->
                     <v-select
                :items="materiau"
                label="materiau"
                v-model="projet.materiauSec"
                dense
                outlined
              ></v-select>
                </div>
          </div>
          
         
             <div class="input-box">
            <div class="form__div">
              <!-- <input type="text" class="form__input" placeholder=" " id="conducteur" v-model="projet.conducteur">
              <label for="" class="form__label">conducteur</label> -->
              <v-select
                :items="conducteur"
                label="conducteur"
                v-model="projet.conducteur"
                dense
                outlined
              ></v-select>
          </div>
          </div>
            <div class="input-box">
            <div class="form__div">
              <!-- <input type="text" class="form__input" placeholder=" " id="conducteurSec" v-model="projet.conducteurSec">
              <label for="" class="form__label">conducteurSec</label> -->
               <v-select
               :items="conducteur"
                label="conducteur"
                v-model="projet.conducteurSec"
                dense
                outlined
              ></v-select>
          </div>
          </div>
        </div>
      </form>
    <!-- </div>
</div> -->
        </div>
  </v-card>   
       <router-link
              class="nav-link"
              :to="
                '/projet/garantie/' + projet.id 
              "
              > <v-btn
        color="primary mb-8"
        @click="e1 = 2"
      >
        précédent
      </v-btn> </router-link>
                   <v-btn color="success mb-8" @click="updateprojet">
          Valider
        </v-btn>
      </v-stepper-content>
    <!-- </v-stepper-items> -->
  </v-stepper>
</div>
</div>
</template>

<script>
// import { reactive } from "vue";
// import navbarUpdate from '../../navbarUpdate';
import NavDash from "@/components/NavDash.vue";

import axios from "axios";
export default {
    components: { 
      // navbarUpdate 
                NavDash,

      },
  data() {
    return {
      cond1: "meplat guipé",
      cond2: "feuillard",
      conducteur: ['meplat guipé','Rond emaille','feuillard'], 
      materiau: ['cuivre','aluminium'], 
      projet: {
         id:undefined,
      materiau:"",
      conducteur:"",
        materiauSec:"",
      conducteurSec:"",
      // primaire meplat
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
        // primaire feuillard
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
        // rond
        nbrPapierMt: "",
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
        N1cmax: "",
        // sec feuillard
         scu2:"",
        j2:"",
        EpfeuillePapierBT:"",
        nbrPapierBT:"",
        typeCanauxBT:"",
        canauxBT:"",
        lgCalesBT:"",
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
        // meplat sec
          etageBT: "",
        saillieBT: "",
        hbrin1BT: "",
        hbrin2BT: "",
        nbBrin1BT: "",
        nbBrin2BT: "",
        nbcoucheBT: "",
        spCoucheBT: "",
        e2ax: "",
        e2r: "",
        rigiditePapierBT: "",
        ep1PapierBT: "",
        canauxEp1PapierBT: "",
        canauxNbrPapierBT: "",
        HspireBT: "",
        HSFSBT: "",
        HFSBT: "",
        collierBT2Sec: "",
        // rond sec
        N2cmax: "",
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
        EpaiseurPapierBT: "",
        EpaisseurPapierCanauxBT: "",
      },
      e1:1
    };
  },
  methods: {
    updateprojet() {
      const projets = {
        id: undefined,
        materiau: this.projet.materiau,
        conducteur: this.projet.conducteur,
        materiauSec: this.projet.materiauSec,
        conducteurSec: this.projet.conducteurSec,
        // primaire meplat
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
        nbrPapierMt: this.projet.nbrPapierMt,
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
        // feuillard
               Hfeuillard: this.projet.Hfeuillard,
        epFeuil1: this.projet.epFeuil1,
        epFeuil2: this.projet.epFeuil2,
        epFeuillard: this.projet.epFeuillard,
        ep2Papier: this.projet.ep2Papier,
        nbrPap2: this.projet.nbrPap2,
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
        // rondp
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
        N1cmax: this.projet.N1cmax,
        // feuiilar sec
          ep1PapierBT: this.projet.ep1PapierBT,
        nbrPapierBT: this.projet.nbrPapierBT,
        typeCanauxBT: this.projet.typeCanauxBT,
        canauxBT: this.projet.canauxBT,
        lgCalesBT: this.projet.lgCalesBT,
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
        scu2: this.projet.scu2,
        j2: this.projet.j2,
        // meplat sec
         etageBT: this.projet.etageBT,
        saillieBT: this.projet.saillieBT,
        hbrin1BT: this.projet.hbrin1BT,
        hbrin2BT: this.projet.hbrin2BT,
        nbBrin1BT: this.projet.nbBrin1BT,
        nbBrin2BT: this.projet.nbBrin2BT,
        nbcoucheBT: this.projet.nbcoucheBT,
        spCoucheBT: this.projet.spCoucheBT,
        e2ax: this.projet.e2ax,
        e2r: this.projet.e2r,
        rigiditePapierBT: this.projet.rigiditePapierBT,
        canauxNbrPapierBT: this.projet.canauxNbrPapierBT,
        HspireBT: this.projet.HspireBT,
        HSFSBT: this.projet.HSFSBT,
        HFSBT: this.projet.HFSBT,
        canauxEp1PapierBT: this.projet.canauxEp1PapierBT,
        collierBTSec: this.projet.collierBTSec,
        collierBT2Sec: this.projet.collierBT2Sec,
        N2cmax: this.projet.N2cmax,
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
        
        
      
        
      };
      axios.put('bobine/update/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id)
        
      );
       axios.put('bobinesec/update/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id)
        
      );
 this.$router.push('/projet/gradin/'+this.$route.params.id);    },
  
  },
  beforeCreate(){
     const result =  axios.get('projets/'+this.$route.params.id);
    this.cond1=result.data.conducteur;
    this.cond2=result.data.conducteurSec;
 },
  async mounted() {
    const result = await axios.get('projets/'+this.$route.params.id);
    this.projet = result.data;
    this.cond1=result.data.conducteur;
    this.cond2=result.data.conducteurSec;
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
.content form .user-details {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  /* margin: 20px 0 12px 0; */
    
}
form .user-details .input-box {
  /* margin-bottom: 15px; */
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
.v-sheet.v-card:not(.v-sheet--outlined) {
    box-shadow: 0px 0px 0px 0px;
}
.v-btn:not(.v-btn--round).v-size--default {
    /* height: 36px; */
    /* min-width: 64px; */
    padding: 16px;
    margin: 3px;
}
</style>
