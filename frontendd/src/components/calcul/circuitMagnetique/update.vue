<template>
  <div>
       <Loading v-if="spinner" />
    <div class="body">
      <v-stepper v-model="e1" vertical>
           
        <v-stepper-step :complete="e1 > 1" step="1"> Calcul </v-stepper-step>
        <v-stepper-content step="1">
          <v-card class="mb-14" >
            <div class="title">Circuit Magnetique</div>
            
 <img src="..\..\..\..\..\frontendd\src\assets\cm1.png" class="mt-1"/>
  <form >
                      <div class="user-details">
<!--   <div class="form__div field1">
                          <input
                            type="text"
                            class="form__input"
                            placeholder=" "
                            
                            id="Ucca"
                            v-model="projet.Ucca"
                          />
                          <label for="" class="form__label">Ucca</label>
                        </div> -->
                        
 <!-- <div class="mb-14" > -->
                        <div class="field1">      
                          <input
                            type="text"
                            v-model="projet.E2"/>
                        </div>

        <!-- <v-text-field
        class="field1"
            label="E2"
       v-model="projet.E2"
            outlined
          ></v-text-field> -->
            <!-- <v-text-field
        class="field2"
            label="Ebc"
            v-model="projet.Ebc"
            outlined
          ></v-text-field> -->
            <div class="field2">      
                          <input
                            type="text"
                            v-model="projet.Ebc"/>
                        </div>
              <!-- <v-text-field
        class="field3"
            label="E1"
            v-model="projet.E1"
            outlined
          ></v-text-field> -->
                        <div class="field3">      
                          <input
                            type="text"
                            v-model="projet.E1"/>
                        </div>
              <!-- <v-text-field
        class="field4"
            label="Ex"
            v-model="projet.Ex"
            outlined
          ></v-text-field> -->
             <div class="field4">      
                          <input
                            type="text"
                            v-model="ex"/>
                        </div>
                <!-- <v-text-field
        class="field5"
            label="E2"
            v-model="projet.E2"
            outlined
          ></v-text-field> -->
              <div class="field5">      
                          <input
                            type="text"
                            v-model="projet.E2"/>
                        </div>
                <!-- <v-text-field
        class="field6"
            label="E3"
            v-model="projet.E3"
            outlined
          ></v-text-field> -->
            <div class="field6">      
                          <input
                            type="text"
                            v-model="projet.E3"/>
                        </div>
                <!-- <v-text-field
        class="field7"
            label="E4"
            v-model="projet.E4"
            outlined
          ></v-text-field> -->
             <div class="field7">      
                          <input
                            type="text"
                            v-model="projet.E4"/>
                        </div>
                <!-- <v-text-field
        class="field8"
            label="Eh"
            v-model="projet.Eh"
            outlined
          ></v-text-field> -->
           <div class="field8">      
                          <input
                            type="text"
                            v-model="projet.Eh"/>
                        </div>
                <!-- <v-text-field
        class="field9"
            label="Longeurcuve"
            v-model="projet.Longeurcuve"
            outlined
          ></v-text-field> -->
           <div class="field9">      
                          <input
                            type="text"
                            v-model="longeurcuve"/>
                        </div>
          <div  class="field10">
           <v-text-field
       
            label="Masse Fer"
            v-model="masseFertot"
            success
            outlined
          ></v-text-field>
             <v-text-field
       
            label="pFerspecif"
            success
            v-model="pferspecifique"
            outlined
          ></v-text-field>
             
               <v-text-field
       success
            label="pFer"
            v-model="pFer"
            outlined
          ></v-text-field>
               <v-text-field
       
            label="Majfer"
            v-model="projet.Majfer"
            outlined
          ></v-text-field>
               <v-text-field
       success
            label="pFerg"
            v-model="pFergarantie"
            outlined
          ></v-text-field>
               <v-text-field
       success
            label="Lcuve"
            v-model="largeurcuve"
            outlined
          ></v-text-field>
               <v-text-field
       
            label="coeffPoid"
            v-model="projet.coeffPoid"
            outlined
          ></v-text-field>
               <v-text-field
               success
            label="Hc"
            v-model="hc"
            outlined
          ></v-text-field>
               <v-text-field
       success
            label="Hcuve"
            v-model="hauteurcuve"
            outlined
          ></v-text-field>
               <v-text-field
       success
            label="I0"
            v-model="I0"
            outlined
          ></v-text-field>
          </div>
          <div class="field11">
                     <v-chip
               active-class="primary--text"     
            >BMax :
             {{projet.Bmax}}
            </v-chip>
                  <v-chip
               active-class="primary--text"      
            >Tole :
             {{projet.tole}}
            </v-chip>
          </div>
                      </div>
                      </form>
          </v-card>

          <router-link class="nav-link" :to="'/projet/pccucc/' + projet.id">
            <v-btn color="primary mt-4 " > précédent </v-btn>
          </router-link>
          <v-btn color="success mt-4" @click="e1 = 2"> suivant </v-btn>
        </v-stepper-content>
                 <v-stepper-step
      :complete="e1 > 2"
      step="2"
    >
      Table perte
    </v-stepper-step>

    <v-stepper-content step="2">
                  <div class="title">Circuit Magnetique</div>
                   <Loading v-if="spinner" style="margin-right: -52%;"/>
                  <div class="content">
          
 <v-row>
            <v-card
          
      
          outlined
          tile
        >
          <template >
              <v-card-title class="subheading font-weight-bold" >
               Largeur
              </v-card-title>

              <v-divider></v-divider>

              <v-list dense>
                <v-list-item v-for="item in largeur"  :key="item" style="width: 176%!important;">
                  <v-list-item-content vertical>{{item}}</v-list-item-content>
                  <v-list-item-content class="align-end"  v-model="projet.spire">
                  
                  </v-list-item-content>
                </v-list-item>

                
              </v-list>
       
      </template>
        </v-card>

        
         <v-card
          
      
          outlined
          tile
        >
          <template >
              <v-card-title class="subheading font-weight-bold" >
               Epaisseur
              </v-card-title>

              <v-divider></v-divider>

              <v-list dense>
                <v-list-item v-for="item in epaisseur"  :key="item" style="width: 176%!important;">
                  <v-list-item-content vertical>{{item}}</v-list-item-content>
                  <v-list-item-content class="align-end"  v-model="projet.spire">
                  
                  </v-list-item-content>
                </v-list-item>

                
              </v-list>
       
      </template>
        </v-card>
   
         <v-card
          outlined
          tile
        >
          <template>
       
            <v-card>
              <v-card-title class="subheading font-weight-bold">
              LCM
              </v-card-title>

              <v-divider></v-divider>

              <v-list dense>
                <v-list-item v-for="item in lcm"  :key="item" style="width: 176%!important;">
                  <v-list-item-content>{{item}}</v-list-item-content>
                  <v-list-item-content class="align-end"  >
                  
                  </v-list-item-content>
                </v-list-item>

              </v-list>
            </v-card>
      
      </template>
         </v-card>

           <v-card
          outlined
          tile
        >
          <template>
       
            <v-card>
              <v-card-title class="subheading font-weight-bold">
              surfaceCM
              </v-card-title>

              <v-divider></v-divider>

              <v-list dense>
                <v-list-item v-for="item in surface"  :key="item" style="width: 176%!important;">
                  <v-list-item-content>{{item}}</v-list-item-content>
                  <v-list-item-content class="align-end"  >
                  
                  </v-list-item-content>
                </v-list-item>

              </v-list>
            </v-card>
      
      </template>
         </v-card>
        <v-card
          
      
          outlined
          tile
        >
          <template >
   
              <v-card-title class="subheading font-weight-bold" >
               masseFerCM
              </v-card-title>

              <v-divider></v-divider>

              <v-list dense>
                <v-list-item v-for="item in masse"  :key="item" style="width: 176%!important;">
                  <v-list-item-content vertical>{{item}}</v-list-item-content>
                  <v-list-item-content class="align-end"  v-model="projet.spire">
                  
                  </v-list-item-content>
                </v-list-item>

                
              </v-list>
       
      </template>
        </v-card>

      </v-row>
                     
                  </div>
           <v-btn
        color="primary mb-14" style="margin-top:5%"
        @click="e1 = 1"
      >
        précédent
      </v-btn>
       <v-btn color="success mb-14" style="margin-top:5%" @click="updateprojet">
          Valider
        </v-btn>
     
   
    </v-stepper-content>
      </v-stepper>
      
    </div>
    
  </div>
</template>

<script>
import axios from "axios";
import Loading  from '@/components/Loading.vue';

export default {
  components: {
    Loading,
  },
  data() {
    return {
      spinner: false,
      tole:[],
      projet: {
        id: undefined,
        masseFertot: "",
        pFerspecifique: "",
        Majferprop: "",
        Majfer: "",
        pFer: "",
        pFergarantie: "",
        Ex: "",
        Hc: "",
        E1: "",
        E2: "",
        E3: "",
        E4: "",
        Eh: "",
        Ebc: "",
        Longeurcuve: "",
        Largeurcuve: "",
        LCM: "",
        masseFerCM: "",
        surfaceCM: "",
        Hauteurcuve: "",
        coeffPoid: "",
        Bmax: "",
        tole: "",
        I0: "",
        
      },
      e1: 1,
    };
  },

  methods: {
    updateprojet() {
      const projets = {
        id: undefined,
          masseFertot: this.projet.masseFertot,
        pFerspecifique: this.projet.pFerspecifique,
        Majferprop: this.projet.Majferprop,
        pccMaj: this.projet.pccMaj,
        Pccg: this.projet.Pccg,
        Majfer: this.projet.Majfer,
        pFer: this.projet.pFer,
        pFergarantie: this.projet.pFergarantie,
        Ex: this.projet.Ex,
        Hc: this.projet.Hc,
        E1: this.projet.E1,
        E2: this.projet.E2,
        E3: this.projet.E3,
        E4: this.projet.E4,
        Eh: this.projet.Eh,
        Ebc: this.projet.Ebc,
        Longeurcuve: this.projet.Longeurcuve,
        Largeurcuve: this.projet.Largeurcuve,
        LCM: this.projet.LCM,
        masseFerCM: this.projet.masseFerCM,
        surfaceCM: this.projet.surfaceCM,
        Hauteurcuve: this.projet.Hauteurcuve,
        coeffPoid: this.projet.coeffPoid,
        Bmax: this.projet.Bmax,
        tole: this.projet.tole,
        I0: this.projet.I0,
  
      };
      axios
        .put("/cm/update/" + this.$route.params.id, projets)
        .then(
          (response) => (
            (this.id = response.data.id), console.log(response.data)
          )
        );
      this.$router.push("/");
    },
   async getTole(){
    await  axios.get('/gettole').then(response => (
      this.tole = response.data
      // console.log(response.data.data)
      ));
      
    //     const result = await axios.get("/gettole" );
    // this.tole = result.data;
    // console.log("tole");
    
    }
  },
  async created(){
      const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
   this.spinner =false;
    this.getTole();
     
  },
  
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
        this.spinner=false;

  },
  computed: {
    I0(){
      return ((2 * this.pFer * 100) / (this.projet.secondaireIPhase * this.projet.secondaireUPhase))
    },
      largeur() {
      let diam = parseInt(Math.floor(this.projet.diamNominale / 10));
      let largeur = [];
      if (diam % 2 == 0) {
        diam -= 1;
      }
      diam = diam * 10;
      for (let i = 0; i < parseInt(this.projet.nbrGradin); i++) {
        largeur[i] = diam;
        diam -= this.projet.pas;
        if (largeur[i] == this.projet.largeurMin) {
          break;
        }
      }
      return largeur;
    },
    epaisseur() {
      let epaisseur = [];
      let precedent = 0;
      for (let i = 0; i < this.largeur.length; i++) {
        epaisseur[i] = (
          Math.sqrt(
            Math.pow(this.projet.diamNominale, 2) - Math.pow(this.largeur[i], 2)
          )
        );
        epaisseur[i] -= precedent;
        precedent += epaisseur[i];
      }
      let j = 0;
      let coeff = [0.5, 0.3, 0.25, 0.2];
      let prec = 0;
      for (let i = 0; i < this.largeur.length - this.projet.demiGradin; i++) {
        prec += epaisseur[i];
      }
      for (
        let i = this.largeur.length - this.projet.demiGradin;
        i < this.largeur.length;
        i++
      ) {
        epaisseur[i] = (
          (Math.sqrt(
            Math.pow(this.projet.diamNominale, 2) - Math.pow(this.largeur[i], 2)
          ) -
            prec) *
            coeff[j]
        );
        j++;
        prec += epaisseur[i];
      }
      return epaisseur;
    },
pFergarantie(){
  return this.projet.Pog;
},
    masseFertot(){
 let masse=this.masse;
  let somme=0;
  for(let i=0;i<masse.length;i++){
    somme+=parseFloat(masse[i]);
  }
  return somme;
},
  ex(){
let ex;

ex=parseFloat(this.projet.DextMT)+parseFloat(this.projet.E1);
return ex;
  },
   lcm(){
      let largeur=this.projet.largeur.replace("[","",this.projet.largeur.length-1).replace("]","").split(",");
  
let lCM = [];
for(let i=0;i<largeur.length;i++){
 lCM[i]=(2*(2*this.ex+parseFloat(largeur[i]))+(3*(this.hc+parseFloat(largeur[0])-parseFloat(largeur[i]))))/10;
}
return lCM;  
},

surface(){
   
 let largeur=this.projet.largeur.replace("[","",this.projet.largeur.length-1).replace("]","").split(",");
 let epaisseur=this.projet.epaisseur.replace("[","",this.projet.epaisseur.length-1).replace("]","").split(",");

let surfaceCM = [];
for(let i=0;i<largeur.length;i++){
 surfaceCM[i]=parseFloat(largeur[i])*parseFloat(epaisseur[i]);
}
return surfaceCM;

},
masse(){
  let masse = [];
for(let i=0;i<this.lcm.length;i++){
 masse[i]=this.lcm[i]*this.surface[i]*7.65*parseFloat(this.projet.coeffPoid)*(Math.pow(10,-5));
}
return masse;
  // return this.projet.masseFerCM.replace("[","",this.projet.masseFerCM.length-1).replace("]","").split(",");
},
// largeur()
// {let l= this.projet.largeur.replace("[",'', this.projet.largeur.length).replace("]",'', this.projet.largeur.length).split(",").join("");
// console.log(l);
//   return l;
// //  this.projet.largeur.replace("[","",this.projet.largeur.length-1).replace("]","").split(",");
// },
  hc(){
    let hc=this.projet.Hc;
    hc=parseFloat(this.projet.HbobineBtSec)+2*(parseFloat(this.projet.Ebc));
    return hc;
  },
  largeurcuve(){
    let largeurcuve=this.projet.Largeurcuve;
    largeurcuve=parseFloat(this.projet.BextMT)+2*(parseFloat(this.projet.E3));
    return largeurcuve;

  },
  longeurcuve(){
    let longeurcuve;
    longeurcuve=2*this.ex+parseFloat(this.projet.DextMT)+2*(parseFloat(this.projet.E2));
    return longeurcuve;
  },
hauteurcuve(){
 let largeur=this.projet.largeur.replace("[","",this.projet.largeur.length-1).replace("]","").split(",");
 let lmax=largeur[0];
  let hauteurcuve=this.projet.Hauteurcuve;
  hauteurcuve=parseFloat(this.projet.HbobineBtSec)+(2*(parseFloat(this.projet.Ebc)))+(2*parseFloat(lmax))+parseFloat(this.projet.Eh)+parseFloat(this.projet.E4);
  return hauteurcuve;
  },
  pferspecifique(){
    let coef0=0;
    let coef1=0;
    let coef2=0;
    let coef3=0;
    let coef4=0;
    let coef5=0;
    let coef6=0;
     let tole=this.tole;
      console.log(tole);
      for(let i=0;i<tole.length;i++){
        if(tole[i].tole==this.projet.tole){
          coef0=tole[i].coef0;
          coef1=tole[i].coef1;
          coef2=tole[i].coef2;
          coef3=tole[i].coef3;
          coef4=tole[i].coef4;
          coef5=tole[i].coef5;
          coef6=tole[i].coef6;
          return coef6*Math.pow(this.projet.Bmax, 6)-coef5*Math.pow(this.projet.Bmax, 5)+coef4*Math.pow(this.projet.Bmax, 4)-coef3*Math.pow(this.projet.Bmax, 3)+coef2*Math.pow(this.projet.Bmax, 2)-coef1*this.projet.Bmax+coef0;

        }
      }
      return 0 ;
  },
  pFer(){
return this.pferspecifique*this.masseFertot*(100+parseFloat(this.projet.Majfer))/100;
  }
  }

};
</script>
<style scoped>
/* .v-text-field.v-text-field--enclosed:not(.v-text-field--rounded) > .v-input__control > .v-input__slot, .v-text-field.v-text-field--enclosed .v-text-field__details {
    padding: 0 12px;
    margin-top: -420%;
} */
input[data-v-c569fce0] {
  width: 60%;  
    border: solid 1px black;
    background-color: #ffffe7;
}
.field1[data-v-c569fce0]{
  /* max-width: 35px; */
  width: 5%;
  margin-left:16.6%;
  margin-top: -19%;
  /* position: relative; */
}
.field2 {
   max-width: 5%;
  margin-left:27%;
  /* margin-top: -10%; */
  margin-top: -4%;
  position: relative;
}
.field3 {
   max-width: 5%;
  margin-left:27.4%;
  /* margin-bottom:5%; */
  margin-top: 1%;
  position: relative;
}
.field4 {
   max-width: 230px;
   height: 20%;
  margin-left:30%;
  margin-top: 120px;
  position: relative;
}
.field5 {
  max-width: 5%;
  margin-left:49%;
  margin-top:-15%;
  position: relative;
}
.field6 {
 max-width: 48px;
  margin-left:816px;
  margin-top:-5%;
  position: relative;
}
.field7 {
 max-width: 48px;
  margin-left:805px;
    margin-top:14%;
  position: relative;
}
.field8 {
 max-width: 50px;
  margin-left:785px;
    margin-top:-28%;
  position: relative;
}
.field9 {
 max-width:160px;
  margin-left:30%;
   margin-top:-5%;
  position: relative;
}
.field10 {
  /* display: flex;

  flex-wrap: wrap; */
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  grid-template-rows: 1fr 1fr 1fr 1fr 1fr;
  grid-gap: 15px;
 max-width:470px;
  margin-left:15%;
   margin-top:34%;
   /* background-color: white; */
  /* position: &; */
}
.field11{
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  grid-template-rows: 1fr ;
  grid-gap: 15px;
 max-width:110px;
  margin-left:60%;
   margin-top:-42%;
   /* background-color: white;
  position: relative; */
}
img{
    width: 60%;
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
/* .form__input:not(:placeholder-shown).form__input:not(:focus) + .form__label {
  top: -0.5rem;
  left: 0.8rem;
  font-size: 0.75rem;
  font-weight: 500;
  z-index: 1;
} */

/*Input focus*/
/* .form__input:focus {
  border: 1.5px solid #4797d1;
} */

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
/* form .input-box span.details {
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
} */
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
  padding-bottom: 0px;
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
  .v-btn:not(.v-btn--round).v-size--default {
  height: 36px;
  min-width: 64px;
  padding: 16px;
  margin: 3px;
}
}
@media (max-width: 459px) {
  .container .content .category {
    flex-direction: column;
  }
  .v-btn:not(.v-btn--round).v-size--default {
  height: 36px;
  min-width: 64px;
  padding: 16px;
  margin: 3px;
}
}
.v-btn:not(.v-btn--round).v-size--default {
  height: 36px;
  min-width: 64px;
  padding: 16px;
  margin: 3px;
}
</style>
