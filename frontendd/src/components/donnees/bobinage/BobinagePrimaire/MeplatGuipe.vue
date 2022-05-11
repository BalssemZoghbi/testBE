<template>
  <div>
    <navbarUpdate />
    <NavDash :conducteur="projet.conducteur" :conducteurSec="projet.conducteurSec"/>
   <div class="body">
      <v-stepper v-model="e1" vertical>
        <v-stepper-step :complete="e1 > 1" step="1">
          Bobinage du primaire en fil méplat
        </v-stepper-step>
        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-16">
              <div class="title">Bobine haute tension</div>
        
                <!-- <div class="content"> -->
      <form  v-on:submit.prevent="updateprojet">
         <div class="user-details">
           <div style="margin-bottom:2%">
                         <v-chip
                      >N1c :
                      {{ projet.N2c }}
                    </v-chip>
                    <v-chip style="margin-left:2%" 
                      >I2ph :
                      {{ projet.secondaireIPhase }}
                    </v-chip>
                    </div>
                      

                    <div class="div">
                 
                    <div class="field10">
       <v-select
                :items="etage"
                label="Etages"
                v-model="projet.etageMT"
                dense
                outlined
              ></v-select>
                   
                      <v-text-field
                        label="Saillie"
                        v-model="projet.saillieMT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Hbrin 1MT"
                        v-model="projet.hbrin1MT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="NbBrin 1MT"
                        v-model="projet.nbBrin1MT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Hbrin 2MT"
                        v-model="projet.hbrin2MT"
                        dense
                        outlined
                      ></v-text-field>
                 
                      <v-text-field
                        label="Scu1"
                        dense
                       id="scu1"
                            readonly
                            v-model="projet.scu1"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="j1"
                        dense
                       id="j1"
                            readonly
                            v-model="projet.j1"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                        label="nbcoucheMT"
                        v-model="projet.nbcoucheMT"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="spCoucheMT"
                        v-model="projet.spCoucheMT"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="e1ax"
                        v-model="projet.e1ax"
                        outlined
                        dense
                      ></v-text-field>
                      <v-text-field
                        label="e1r"
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
            <v-card class="mb-14">
              <div class="title">Hauteur/caneaux</div>
              <!-- <div class="content"> -->
                 <form  v-on:submit.prevent="updateprojet">
         <div class="user-details">
           <!-- <div style="margin-bottom:2%">
                         <v-chip
                      >N2c :
                      {{ projet.N2c }}
                    </v-chip>
                    <v-chip style="margin-left:2%" 
                      >I2ph :
                      {{ projet.secondaireIPhase }}
                    </v-chip>
                    </div>
                       -->

                    <div class="div">
                 
                    <div class="div2">
        <v-text-field
                        label="Hspire"
                        v-model="projet.Hspire"
                        dense
                        outlined
                      ></v-text-field>
                   
                      <v-text-field
                        label="HSFS"
                        v-model="projet.HSFS"
                        dense
                        outlined
                      ></v-text-field>
                    
                      <v-text-field
                        label="HFS"
                        v-model="projet.HFS"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
   
                        label= "HbobineBt"
                        v-model="projet.HbobineBt"
                        dense
                        outlined
                      ></v-text-field>
                            <v-text-field
                        label="CollierBT"
                        v-model="projet.collierBT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        label="CollierBT2"
                        dense
                        v-model="projet.collierBT2"
                        outlined
                      ></v-text-field>
                      
                                          </div>
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
                            readonly
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
            <v-card class="mb-16">
              <!-- <div class="content"> -->
                            <form  v-on:submit.prevent="updateprojet">
         <div class="user-details">
           <div style="margin-bottom:2%">
                         <v-chip
                      >Dn :
                      {{ projet.diamNominale }}
                    </v-chip>
                    <v-chip style="margin-left:2%" 
                      >CMBT :
                      {{ projet.CMBT }}
                    </v-chip>
                    </div>
                      

                    <!-- <div class="div"> -->
                 
                    <div class="div2" >
        <v-text-field
                        label="DintMT"
                        v-model="projet.DintMT"
                        dense
                        outlined
                      ></v-text-field>
                   
                      <v-text-field
                        label="BintMT"
                        v-model="projet.BintMT"
                        dense
                        outlined
                      ></v-text-field>
                    
                      <v-text-field
                        label="EpxMT"
                        v-model="projet.EpxMT"
                        dense
                        outlined
                      ></v-text-field>
                      <v-text-field
   
                        label= "EpyMT"
                        v-model="projet.EpyMT"
                        dense
                        outlined
                      ></v-text-field>
                            <v-text-field
                        label="DextMT"
                        v-model="projet.DextMT"
                        outlined
                        dense
                      ></v-text-field>

                      <v-text-field
                        label="BextMT"
                        dense
                        v-model="projet.BextMT"
                        outlined
                      ></v-text-field>
                          <v-text-field
                        label="majPoid"
                        dense
                        v-model="projet.majPoid"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="poidMT"
                        dense
                        v-model="projet.poidMT"
                        outlined
                      ></v-text-field>
                  
                      
                                          </div>
                   
                  </div>
                  <!-- </div> -->
                </form>
              <!-- </div> -->
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
        HbobineBt:"",
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
        nbrPapierMt: this.projet.nbrPapierMt,
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
      };
      axios
        .put("bobine/update/" + this.$route.params.id, projets)
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
.field10 {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
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

.div{
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
