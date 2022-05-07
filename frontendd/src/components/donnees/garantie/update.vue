<template>
  <div>
    <NavDash />
    <!-- <NavDashEmp v-if="this.usertype == 'employe'" /> -->
    <!-- <navbarUpdate :elec_id='projet.electrique_id' :id='projet.id'/> -->
    <div class="body">
      <v-stepper v-model="e1"  vertical>
        <!-- <v-stepper-header> -->
          <v-stepper-step :complete="e1 > 1" step="1">
           Données de Garantie
          
          </v-stepper-step>
           <v-stepper-content step="1">
            <v-card class="mb-6"  >
              <!-- <div class="body"> -->
                <!-- <div class="container"> -->
                  <div class="title">Données de Garantie</div>
        
                  <div class="content">
                               <v-col cols="2" style="    margin-top: -8%;margin-left: 28%;">
                                 <v-menu transition="slide-x-transition" offset-x>
              <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" color="primary"> Automatique </v-btn>
              </template>

              <v-list>
                <v-list-item-group v-model="model" mandatory color="blue">
                  <v-list-item @click="onClick" color="blue">
                    <v-list-item-title @click="automatique()"
                      >Automatique</v-list-item-title
                    >
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-title @click="manuel()"
                      >Manuel</v-list-item-title
                    >
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-menu>
            <!-- <v-switch
      v-model="people"
      color="primary"
      label="Automatique"
      value="Automatique"
    ></v-switch> -->
           <!-- <v-sheet class="pa-5">
    <v-switch
      v-model="switch1"
      inset
      :label="`Switch 1: ${switch1.toString()}`"
    >
    <p v-if="switch1.toString()=='true'">Manuel</p>
    <p v-if="switch1.toString()=='false'">Automatique</p>
    </v-switch>
   
  </v-sheet> -->
        <!-- <v-select
          v-model="select"
          :items="items"
          item-text="state"
          label="Select"
          persistent-hint
          return-object
          single-line
        ></v-select> -->
         <!-- v-if="this.select.state=='automatique'" -->
      </v-col>
                    <form v-on:submit.prevent="updateprojet" style="margin-top:-1%">
                      <div class="user-details">
                        <div class="form__div framei">
                          
                          <input
                            type="text"
                            class="form__input"
                            placeholder=" "
                            id="option"
                            v-model="projet.option"
                          />
                          <label for="" class="form__label">Option</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="text"
                            class="form__input"
                            placeholder=" "
                            id="Pog"
                            v-model="projet.Pog"
                            
                          />
                          <label for="" class="form__label">Pog</label>
                        </div>
                       
                     <div class="input-box">
                           <div class="form__div ">
                            <input
                              type="text"
                              class="form__input"
                              placeholder=" "
                              id="log"
                              
                              v-model="projet.log"
                            />
                            <label for="" class="form__label">log</label>
                          </div>
                        </div>
                       
                         <div class="form__div framei">
                          <input
                            type="text"
                            class="form__input"
                            placeholder=" "
                            id="Pccg"
                            
                            v-model="projet.Pccg"
                          />
                          <label for="" class="form__label">Pccg</label>
                        </div>

                        <div class="form__div framei">
                            <input
                            
                              type="text"
                              class="form__input"
                              placeholder=" "
                              id="Uccg"
                              v-model="projet.Uccg"
                            />
                            <label for="" class="form__label">Uccg</label>
                       
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="Ptot"
                            v-model="projet.Ptot"
                            
                          />
                          <label for="" class="form__label">Ptot</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="Poglimit"
                            
                            v-model="projet.Poglimit"
                          />
                          <label for="" class="form__label">Poglimite</label>
                        </div>
                          <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="Pccglimit"
                            
                            v-model="projet.Pccglimit"
                          />
                          <label for="" class="form__label">Pccglimite</label>
                        </div>
                          <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="loglimit"
                            
                            v-model="projet.loglimit"
                          />
                          <label for="" class="form__label">loglimit</label>
                        </div>
                       <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="Uccglimit"
                            
                            v-model="projet.Uccglimit"
                          />
                          <label for="" class="form__label">Uccglimit</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="Ptotlimit"
                            
                            v-model="projet.Ptotlimit"
                          />
                          <label for="" class="form__label">Ptotlimit</label>
                        </div>
                           <div class="form__div framei" style="  width: 48%;">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="echauffementHuile"
                            
                            v-model="projet.echauffementHuile"
                          />
                          <label for="" class="form__label">Echauffement Huile</label>
                        </div>
                       <div class="form__div frame" style="  width: 48%;">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="echauffementEnroulement"
                            
                            v-model="projet.echauffementEnroulement"
                          />
                          <label for="" class="form__label">Echauffement Enroulement</label>
                        </div>
                      </div>
                    </form>
                  </div>
                <!-- </div> -->
              <!-- </div> -->
            </v-card>
   
            <router-link
              class="nav-link"
              :to="
                '/electrique/update/' + projet.id + '/' + projet.electrique_id
              "
              > <v-btn
        color="primary mb-14"
        @click="e1 = 2"
      >
        précédent
      </v-btn> </router-link>
                   <v-btn color="success mb-14" @click="updateprojet">
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
// import navbarUpdate from '../../navbarUpdate.vue';
import NavDash from "@/components/NavDash.vue";
// import NavDashEmp from "@/components/NavDashboardEmploye.vue";

import axios from "axios";
export default {
    components: { 
      // navbarUpdate 
                NavDash,

      },
  data() {
    return {
      // switch1: "Automatique",
      // people: ['Automatique','Manuel'],
        // switch2: false,
       select: { state: 'Automatique'},
        items: [
          { state: 'Automatique'},
          { state: 'Manuel' },
        ],
      projet: {
        id:undefined,
      option: "",
      Pog: "",
      log: "",
      Pccg: "",
      Uccg: "",
      Ptot: "",
      Poglimit: "",
      loglimit: "",
      Pccglimit: "",
      Uccglimit: "",
      Ptotlimit: "",
      echauffementHuile: "",
      echauffementEnroulement: "",
      
      },
      e1:1
    };
  },
  methods: {
   async manuel(){
      console.log("manuel")
      const projets = {
        id: undefined,
        option: this.projet.option,
        Pog: this.projet.Pog,
        log: this.projet.log,
        Pccg: this.projet.Pccg,
        Uccg:this.projet.Uccg,
        Ptot: this.projet.Ptot,
        Poglimit: this.projet.Poglimit,
        loglimit: this.projet.loglimit,
        Pccglimit: this.projet.Pccglimit,
        Uccglimit: this.projet.Uccglimit,
        Ptotlimit: this.projet.Ptotlimit,
        echauffementHuile: this.projet.echauffementHuile,
        echauffementEnroulement: this.projet.echauffementEnroulement,
      };
   await  axios.put('garantie/manuelle/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id, console.log(response.data),
        // window.location.reload()
        this.getGarantie()
        )
        
      );
    },
    updateprojet() {
     
      // const projets = {
      //   id: undefined,
      //   option: this.projet.option,
      //   Pog: this.projet.Pog,
      //   log: this.projet.log,
      //   Pccg: this.projet.Pccg,
      //   Uccg:this.projet.Uccg,
      //   Ptot: this.projet.Ptot,
      //   Poglimit: this.projet.Poglimit,
      //   loglimit: this.projet.loglimit,
      //   Pccglimit: this.projet.Pccglimit,
      //   Uccglimit: this.projet.Uccglimit,
      //   Ptotlimit: this.projet.Ptotlimit,
      //   echauffementHuile: this.projet.echauffementHuile,
      //   echauffementEnroulement: this.projet.echauffementEnroulement,
      // };
      // axios.put('garantie/edit/'+this.$route.params.id, projets).then(
      //   (response) => (this.id = response.data.id, console.log(response.data))
        
      // );
       this.$router.push('/bobine/'+this.$route.params.id);
    },
   async automatique(){
       const projets = {
        id: undefined,
        option: this.projet.option,
        Pog: this.projet.Pog,
        log: this.projet.log,
        Pccg: this.projet.Pccg,
        Uccg:this.projet.Uccg,
        Ptot: this.projet.Ptot,
        Poglimit: this.projet.Poglimit,
        loglimit: this.projet.loglimit,
        Pccglimit: this.projet.Pccglimit,
        Uccglimit: this.projet.Uccglimit,
        Ptotlimit: this.projet.Ptotlimit,
        echauffementHuile: this.projet.echauffementHuile,
        echauffementEnroulement: this.projet.echauffementEnroulement,
      };
    await axios.put('garantie/edit/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id, console.log(response.data),this.getGarantie())
        
      );
    },
   async getGarantie(){
      //  const projets = {
      //   id: undefined,
      //   option: this.projet.option,
      //   Pog: this.projet.Pog,
      //   log: this.projet.log,
      //   Pccg: this.projet.Pccg,
      //   Uccg:this.projet.Uccg,
      //   Ptot: this.projet.Ptot,
      //   Poglimit: this.projet.Poglimit,
      //   loglimit: this.projet.loglimit,
      //   Pccglimit: this.projet.Pccglimit,
      //   Uccglimit: this.projet.Uccglimit,
      //   Ptotlimit: this.projet.Ptotlimit,
      //   echauffementHuile: this.projet.echauffementHuile,
      //   echauffementEnroulement: this.projet.echauffementEnroulement,
      // };
    await axios.get('getGarantie/'+this.$route.params.id).then(
        (response) => ( this.projet=response.data,console.log(this.projet))
        
      );
    }
  },
  async mounted() {
    const result = await axios.get('projets/'+this.$route.params.id);
    this.projet = result.data;
  },
  created(){
   this.getGarantie();
    
  }
};
</script>
<style scoped>

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
.content form .user-details {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
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
    height: 36px;
    min-width: 64px;
    padding: 16px;
    margin: 3px;
}
</style>
