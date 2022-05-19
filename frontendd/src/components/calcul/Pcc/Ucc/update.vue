<template>
  <div>
  <NavDash :conducteur="projet.conducteur" :conducteurSec="projet.conducteurSec"/>

    <div class="body">
      <v-stepper v-model="e1"  vertical>
          <v-stepper-step :complete="e1 > 1" step="1">
           Calcul
          </v-stepper-step>
           <v-stepper-content step="1">
   <v-card class="mb-14"  >
                  <div class="title">Pcc/Ucc</div>
        
                <!-- <div class="content"> -->
      <form  v-on:submit.prevent="updateprojet">
         <div class="user-details">
              <v-text-field
                         class="frame"
                        label="Majouration Utilisée"
                        v-model="projet.MajourationU"
                        outlined
                      ></v-text-field>
           <div style="margin-bottom:2%">
                         <v-chip 
                      >Pccg :
                      {{ projet.Pccg }}
                    </v-chip>
                    <v-chip style="text-align: left;margin-left: 42%;"
                      >Uccg :
                      {{ this.projet.Uccg }}
                    </v-chip>
                    </div>
                      

                    <div class="div">
                 
                    <div class="field10">
                      
                      <v-text-field
                        label="Pcc1"
                        v-model="pcc1"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Pcc2"
                        v-model="pcc2"
                        outlined
                      ></v-text-field>
                 
                      <v-text-field
                        label="Pcc Maj"
                       id="pccMaj"
                            readonly
                            v-model="somme"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                        label="Uccr"
                        v-model="uccr"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Ucca"
                        v-model="ucca"
                        outlined
                      ></v-text-field>

                      <v-text-field
                        label="Ucc"
                        v-model="ucc"
                        outlined
                      ></v-text-field>
                  
                    </div>
                  </div>
                  </div>

      </form>

  </v-card>  
   
            <router-link
              class="nav-link"
              :to="
                '/projet/cm/update/' + projet.id 
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
          <!-- <v-stepper-content >
        </v-stepper-content> -->
      </v-stepper>
        

    </div>
  </div>
</template>

<script>
// import { reactive } from "vue";
// import navbarUpdate from "../../navbarUpdate.vue";

import NavDash from "@/components/NavDash.vue";

import axios from "axios";
export default {
    components: { 
      // navbarUpdate 
                NavDash,

      },
  data() {
    return {
      projet: {
        id: undefined,
        MajourationU: "",
        pcc1: "",
        pcc2: "",
        pccMaj: "",
        Pccg: "",
        Uccr: "",
        Ucca: "",
        Ucc: "",
        Uccg: "",
      },
      e1: 1,
    };
  },

  methods: {
    updateprojet() {
      const projets = {
        id: undefined,
        MajourationU: this.projet.MajourationU,
        pcc1: this.projet.pcc1,
        pcc2: this.projet.pcc2,
        pccMaj: this.projet.pccMaj,
        Pccg: this.projet.Pccg,
        Uccr: this.projet.Uccr,
        Ucca: this.projet.Ucca,
        Ucc: this.projet.Ucc,
        Uccg: this.projet.Uccg,
      };
      axios
        .put("/pucc/update/" + this.$route.params.id, projets)
        .then(
          (response) => (this.id = response.data.id,console.log(response.data)),
          
        );
      this.$router.push( '/projet/cm/' + this.$route.params.id);
    },
  },
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
  },
  async created() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
  },
   computed:{
   pcc1(){
    
     let pcc1;
     if(this.projet.materiau=='cuivre'){
     pcc1=2.286*Math.pow(parseFloat(this.projet.j1),2)*parseFloat(this.projet.poidMT)*(100+parseInt(this.projet.MajourationU))/100;
     }else if(this.projet.materiau=='aluminium'){
      pcc1=12.18*Math.pow(parseFloat(this.projet.j1),2)*parseFloat(this.projet.poidMT)*(100+parseInt(this.projet.MajourationU))/100;
     }
     return pcc1;
     },
       pcc2(){
     let m2=this.projet.materiauSec;
     let pcc2=this.projet.pcc2;
     if(m2=='cuivre'){
     pcc2=2.286*Math.pow(parseFloat(this.projet.j2),2)*parseFloat(this.projet.poidBT)*(100+parseInt(this.projet.MajourationU))/100;
     }else if(m2=='aluminium'){
      pcc2=12.18*Math.pow(parseFloat(this.projet.j2),2)*parseFloat(this.projet.poidBT)*(100+parseInt(this.projet.MajourationU))/100;
     }
     return pcc2;
     },
     somme(){
       return parseFloat(this.pcc1) + parseFloat(this.pcc2);
},
hmoy()
{
   let hmoy;
if(this.projet.conducteurSec=='feuillard'){
 hmoy=parseFloat(this.projet.HCondMt)+parseFloat(this.projet.HfeuillardBT)/2;
// hmoy=parseFloat(this.projet.HCondMt)+parseFloat(this.projet.HfeuillardBT)/2;
}else{
  hmoy=parseFloat(this.projet.HCondMt)+parseFloat(this.projet.HSFSBT)/2;
}
    return hmoy;
},
  uccr(){
let coBt=(parseFloat(this.projet.DintBT)+parseFloat(this.projet.BintBT)+parseFloat(this.projet.DextBT)+parseFloat(this.projet.BextBT))*parseFloat(Math.PI)/4;
let coMt=(parseFloat(this.projet.DintMT)+parseFloat(this.projet.BintMT)+parseFloat(this.projet.DextMT)+parseFloat(this.projet.BextMT))*parseFloat(Math.PI)/4;
let comoy=(coBt+coMt)/2;
let delta=(parseFloat(this.projet.EpxBT)+parseFloat(this.projet.EpxMT))/2;

let uccr=this.projet.Uccr;

uccr=(3.81*(comoy*delta*parseFloat(Math.pow(parseFloat(this.projet.N1c),2))*parseFloat(this.projet.PrimaireIPhase))/(parseFloat(this.projet.PrimaireUPhase)*this.hmoy))*parseFloat(Math.pow(10,-5));

return uccr;
},
ucca(){
  let ucca=parseFloat(this.projet.Ucca);
  ucca=(parseFloat(this.projet.pccMaj)*100/parseInt(this.projet.puissance)*1000+parseFloat(this.projet.pccMaj))*parseFloat(Math.pow(10,-6));
  return ucca;
},
ucc(){
  let ucc;
  ucc=parseFloat(Math.sqrt(Math.pow(this.uccr,2)+Math.pow(this.ucca,2)));

  return ucc;
},
}
};
</script>
<style scoped>
.field10 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-template-rows: 1fr 1fr;
  grid-gap: 10px;
  margin-right: 5%;
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
@media (max-width:1000px) {
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
  grid-template-rows: 1fr 1fr;
  grid-gap: 10px;
  margin-right: 5%;
}
.div{
  display: grid; 
  grid-template-columns: 1fr ;
  grid-gap: 10px;
}
}
@media (max-width: 459px) {
  .container .content .category {
    flex-direction: column;
  }
  .field10 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-template-rows: 1fr 1fr;
  grid-gap: 10px;
  margin-right: 5%;
}
.div{
  display: grid; 
  grid-template-columns: 1fr ;
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
