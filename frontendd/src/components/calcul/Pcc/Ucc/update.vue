<template>
  <div>
        <div class="body">
      <v-stepper v-model="e1"  vertical>
        <Loading v-if="spinner" style="margin-right: -52%;"/>
      <v-stepper-step step="">
           Calcul
          </v-stepper-step>
           <v-stepper-content step="1">
   <v-card class="mb-14"  >
                  <div class="title">Pcc/Ucc</div>
                  
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
                            success
                            v-model="somme"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                        label="Uccr"
                        success
                        v-model="uccr"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Ucca"
                        success
                        v-model="ucca"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Ucc"
                        v-model="ucc"
                        success
                        outlined
                      ></v-text-field>
                    </div>
                  </div>
                  </div>
      </form>
  </v-card>  
          <v-btn
        color="primary  mb-10"
        @click="routeur"
      >
        précédent
      </v-btn> 
                   <v-btn color="success mb-10" @click="updateprojet">
          Valider
        </v-btn>
          </v-stepper-content>
      </v-stepper>
    </div>
  </div>
</template>

<script>
import Loading  from '@/components/Loading.vue';
import axios from "axios";
export default {
    components: {
  Loading,
      },
  data() {
    return {
      spinner:true,
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
    routeur(){
        if(this.projet.conducteurMT=="Rond emaille"){
      this.$router.push("/projet/bobinagePrimaireRond/"+this.$route.params.id);
    }else if(this.projet.conducteurMT=="feuillard"){
      this.$router.push("/projet/bobinagePrimaireFeuillard/"+this.$route.params.id);
    }else if(this.projet.conducteurMT=="meplat guipé"){
      this.$router.push("/projet/bobinagePrimaireMeplat/"+this.$route.params.id);
    }  },
    
  },
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
  },
  async created() {
    const result = await axios.get("/projets/" + this.$route.params.id);
    this.projet = result.data;
    // console.log(result.data.Pccg);
    this.spinner=false;
  },
   computed:{
   pcc1(){
     let pcc1;
     if(this.projet.materiauMT=='cuivre'){
     pcc1=2.286*Math.pow(parseFloat(this.projet.j1),2)*parseFloat(this.projet.poidMT)*(100+parseFloat(this.projet.MajourationU))/100;
     }else if(this.projet.materiauMT=='aluminium'){
      pcc1=12.18*Math.pow(parseFloat(this.projet.j1),2)*parseFloat(this.projet.poidMT)*(100+parseInt(this.projet.MajourationU))/100;
     }
     return Math.round(pcc1 * 100) / 100;
     },
       pcc2(){
     let m2=this.projet.materiauBT;
     let pcc2=this.projet.pcc2;
     if(m2=='cuivre'){
     pcc2=2.286*Math.pow(parseFloat(this.projet.j2),2)*parseFloat(this.projet.poidBT)*(100+parseInt(this.projet.MajourationU))/100;
     }else if(m2=='aluminium'){
      pcc2=12.18*Math.pow(parseFloat(this.projet.j2),2)*parseFloat(this.projet.poidBT)*(100+parseInt(this.projet.MajourationU))/100;
     }
     return Math.round(pcc2 * 100) / 100;
     },
     somme(){
       return Math.round((parseFloat(this.pcc1) + parseFloat(this.pcc2))*100)/100;
},
hmoy()
{
   let hmoy;
 if((this.projet.conducteurMT=='feuillard')&&(this.projet.conducteurBT=='feuillard')){
   console.log(hmoy);
 hmoy=(parseFloat(this.projet.Hfeuillard)+parseFloat(this.projet.HfeuillardBT))/2;
}else if((this.projet.conducteurBT=='feuillard')&&(this.projet.conducteurBT=='Rond emaille')){
 hmoy=(parseFloat(this.projet.HCondMt)+parseFloat(this.projet.HfeuillardBT))/2;
}else if((this.projet.conducteurMT=='meplat guipé')&&(this.projet.conducteurBT=='meplat guipé')){

 hmoy=(parseFloat(this.projet.HSFS)+parseFloat(this.projet.HSFSBT))/2;
}
else if((this.projet.conducteurMT=='Rond emaille')&&(this.projet.conducteurBT=='Rond emaille')){

 hmoy=(parseFloat(this.projet.HCondMt)+parseFloat(this.projet.HCondBt))/2;
}

else if((this.projet.conducteurMT=='meplat guipé')&&(this.projet.conducteurBT=='feuillard')){
 hmoy=(parseFloat(this.projet.HSFS)+parseFloat(this.projet.HfeuillardBT))/2;
}
else{
  hmoy=(parseFloat(this.projet.HCondMt)+parseFloat(this.projet.HSFSBT))/2;
}
    return hmoy;
},
  uccr(){
let coBt=(parseFloat(this.projet.DintBT)+parseFloat(this.projet.BintBT)+parseFloat(this.projet.DextBT)+parseFloat(this.projet.BextBT))*Math.PI/4;
let coMt=(parseFloat(this.projet.DintMT)+parseFloat(this.projet.BintMT)+parseFloat(this.projet.DextMT)+parseFloat(this.projet.BextMT))*Math.PI/4;
let comoy=(coBt+coMt)/2;
console.log(comoy);
let delta=(parseFloat(this.projet.EpxBT)+parseFloat(this.projet.EpxMT))/3+this.projet.DistanceBTMT;
let uccr;
console.log(comoy,"delta",delta,"n1c",this.projet.N1c,"i1ph",parseFloat(this.projet.PrimaireIPhase),"u1ph",parseFloat(this.projet.PrimaireUPhase),"hmoy",this.hmoy);
uccr=(3.81*(comoy*delta*Math.pow(parseFloat(this.projet.N1c),2)*parseFloat(this.projet.PrimaireIPhase))/(parseFloat(this.projet.PrimaireUPhase)*this.hmoy))*Math.pow(10,-5);

return Math.round(uccr * 100) / 100;
},
ucca(){
  let ucca=parseFloat(this.projet.Ucca);
  ucca=(parseFloat(this.somme)*100/parseFloat(this.projet.puissance)*1000+parseFloat(this.somme))*Math.pow(10,-6);

  return Math.round(ucca * 100) / 100;
},
ucc(){
  let ucc;
  ucc=parseFloat(Math.sqrt(Math.pow(this.uccr,2)+Math.pow(this.ucca,2)));

  return  Math.round(ucc * 100) / 100;
},
}
};
</script>
<style scoped>
.preloader {
  position: fixed;
  z-index: 9999999;
  align-items: center;
  background: #fff;
  justify-content: center;
  width: 100%;
  height: 79%;
  margin-top: 0.5%;
}
.logo {
  width: 100%;
  height: 100%;
  margin: 16%;
  margin-left: 39%;
}
.field10 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-template-rows: 1fr 1fr;
  grid-gap: 20px;
  /* margin-right: 5%; */
  width:300px;
}
.div{
  display: grid; 
  grid-template-columns: 1fr 1fr;
  grid-gap: 10px;
   /* padding-left: 2%; */
  /*padding-right: 25%; */
}
.v-sheet.v-stepper:not(.v-sheet--outlined) {
    box-shadow: 0px 3px 1px -2px rgb(0 0 0 / 20%), 0px 2px 2px 0px rgb(0 0 0 / 14%), 0px 1px 5px 0px rgb(0 0 0 / 12%);
    /* margin: 5%; */
    /* padding: 5%; */
     padding-left: 5%;
     padding-right: 5%;
    /* margin-right: 20%;
    margin-left:10%;*/
    margin-top: -2%; 
    /* margin-bottom: 60%; */
}
.v-stepper--vertical .v-stepper__step {
    padding: 24px 0px 10px;
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

.user-details .input-box input {
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  transition: all 0.3s ease;
}

.frame {
   width:15%;
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
    width: 15px;
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
