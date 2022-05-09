<template>
  <div>
    <navbarUpdate />
    <NavDash />
    <div class="body">
      <v-stepper v-model="e1">
        <v-stepper-header>
          <v-stepper-step :complete="e1 > 1" step="1"> Frame 1 </v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step :complete="e1 > 2" step="2"> Frame 2 </v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step :complete="e1 > 3" step="3">
            Frame 3
          </v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step :complete="e1 > 4" step="4">
           Frame 4
          </v-stepper-step>
          <v-divider></v-divider>
          <v-stepper-step step="5">
            Frame 5
          </v-stepper-step>
        </v-stepper-header>

        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="mb-12" color="rgb(5 48 96 / 78%) " height="450px">
              <div class="body">
                <div class="container">
                  <div class="title">Calcul bobine</div>
                  <div class="content">
                    <form v-on:submit.prevent="updateprojet">
                      <div class="user-details">
                        <div class="input-box">
                           <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="ep1PapierBT"
                            v-model="projet.ep1PapierBT"
                          />
                          <label for="" class="form__label">ep1PapierBT</label>
                        </div>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="EpCylindreBT"
                            v-model="projet.EpCylindreBT"
                          />
                          <label for="" class="form__label">EpCylindreBT</label>
                        </div>

                        <div class="form__div framei">
                            <v-select
                                :items="barre"
                                label="barre"
                                v-model="projet.EpbarreBT"
                                dense
                                outlined
                              ></v-select>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="epaisseurBarreBT"
                            v-model="projet.epaisseurBarreBT"
                          />
                          <label for="" class="form__label">epaisseurBarreBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="largeurBarreBT"
                            v-model="projet.largeurBarreBT"
                          />
                          <label for="" class="form__label">largeurBarreBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="SbarreBT"
                            v-model="projet.SbarreBT"
                            readonly
                          />
                          <label for="" class="form__label">SbarreBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="JbarreBT"
                            v-model="projet.JbarreBT"
                            readonly
                          />
                          <label for="" class="form__label">JbarreBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="nbrPap1BT"
                            v-model="projet.nbrPap1BT"
                          />
                          <label for="" class="form__label">nbrPap1BT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="EpPapierBT"
                            v-model="projet.EpPapierBT"
                          />
                          <label for="" class="form__label">EpPapierBT</label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </v-card>

            <v-btn color="primary" @click="e1 = 2"> Continue </v-btn>
          </v-stepper-content>

          <v-stepper-content step="2">
            <v-card class="mb-12" color="rgb(5 48 96 / 78%)" height="450px">
              <div class="body">
                <div class="container">
                  <div class="title">Calcul bobine</div>
                  <div class="content">
                    <form v-on:submit.prevent="updateprojet">
                      <div class="user-details">
                        <div class="input-box">
                          <div class="form__div">
                            <input
                              type="number"
                              class="form__input"
                              placeholder=" "
                              id="scu2"
                              :items="scu1"
                              dense
                              outlined
                              v-model="projet.scu2"
                            />
                           
                            <label for="" class="form__label">scu2</label>
                          </div>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="j1"
                            v-model="projet.j2"
                          />
                          <label for="" class="form__label">j2</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="nbrPapierBT"
                            v-model="projet.nbrPapierBT"
                          />
                          <label for="" class="form__label">nbrPapierBT</label>
                        </div>
                     
                     
                        <div class="form__div framei">
                       <v-select
                                :items="typeCanaux"
                                label="typeCanauxBT"
                                v-model="projet.typeCanauxBT"
                                dense
                                outlined
                              ></v-select>
                        </div>
                           <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="canauxMT"
                            v-model="projet.canauxBT"
                          />
                          <label for="" class="form__label">canauxBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="lgCalesBT"
                            v-model="projet.lgCalesBT"
                            readonly
                          />
                          <label for="" class="form__label">lgCalesBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="collierBT"
                            v-model="projet.collierBTSec"
                          />
                          <label for="" class="form__label">collierBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="collierBT2"
                            v-model="projet.collierBT2Sec"
                          />
                          <label for="" class="form__label">collierBT2</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="CMBTSec"
                            v-model="projet.CMBTSec"
                          />
                          <label for="" class="form__label">CMBTSec</label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </v-card>

            <v-btn @click="e1 = 1"> précédente </v-btn>
            <v-btn color="primary" @click="e1 = 3"> Continue </v-btn>
          </v-stepper-content>

          <v-stepper-content step="3">
            <v-card class="mb-12" color="rgb(5 48 96 / 78%)" height="450px">
              <div class="body">
                <div class="container">
                  <div class="title">Calcul bobine</div>
                  <div class="content">
                    <form v-on:submit.prevent="updateprojet">
                      <div class="user-details">
                        <div class="input-box">
                          <div class="form__div">
                            
                            <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="DintBT"
                            v-model="projet.DintBT"
                          />
                            <label for="" class="form__label">DintBT</label>
                          </div>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="BintBT"
                            v-model="projet.BintBT"
                          />
                          <label for="" class="form__label">BintBT</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="EpxBT"
                            v-model="projet.EpxBT"
                          />
                          <label for="" class="form__label">EpxBT</label>
                       
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="EpyBT"
                            v-model="projet.EpyBT"
                          />
                          <label for="" class="form__label">EpyBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="DextBT"
                            v-model="projet.DextBT"
                          />
                          <label for="" class="form__label">DextBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="BextBT"
                            v-model="projet.BextBT"
                          />
                          <label for="" class="form__label">BextBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="poidBT"
                            v-model="projet.poidBT"
                            readonly
                          />
                          <label for="" class="form__label">poidBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="majPoidBT"
                            v-model="projet.majPoidBT"
                            readonly
                          />
                          <label for="" class="form__label">majPoidBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="HfeuillardBT"
                            v-model="projet.HfeuillardBT"
                          />
                          <label for="" class="form__label">HfeuillardBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="HbobineBtSec"
                            v-model="projet.HbobineBtSec"
                          />
                          <label for="" class="form__label">HbobineBtSec</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="epFeuil1"
                            v-model="projet.epFeuil1"
                          />
                          <label for="" class="form__label">epFeuil1</label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </v-card>
            <v-btn @click="e1 = 2"> précédente </v-btn>
            <v-btn color="primary" @click="e1 = 4" > Continue </v-btn>
 </v-stepper-content>

 
          <v-stepper-content step="4">
            <v-card class="mb-12" color="rgb(5 48 96 / 78%)" height="450px">
              <div class="body">
                 <div class="container">
                  <div class="title">Calcul bobine</div>
                  <div class="content">
                    <form v-on:submit.prevent="updateprojet">
                      <div class="user-details">
                        <div class="input-box">
                          <div class="form__div">
                            
                              <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="epFeuil2BT"
                            v-model="projet.epFeuil2BT"
                          />
                            <label for="" class="form__label">epFeuil2BT</label>

                          </div>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="epFeuillardBT"
                            v-model="projet.epFeuillardBT"
                          />
                          <label for="" class="form__label">epFeuillardBT</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="ep2PapierBT"
                            v-model="projet.ep2PapierBT"
                          />
                          <label for="" class="form__label">ep2PapierBT</label>
                        </div>

                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="nbrPap2BT"
                            v-model="projet.nbrPap2BT"
                          />
                          <label for="" class="form__label">nbrPap2BT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="ePapBT"
                            v-model="projet.ePapBT"
                          />
                          <label for="" class="form__label">ePapBT</label>
                        </div>
                        <div class="form__div framei">
                          <input
                            type="number"
                            class="form__input"
                            placeholder=" "
                            id="epFeuilPapBT"
                            v-model="projet.epFeuilPapBT"
                          />
                          <label for="" class="form__label">epFeuilPapBT</label>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </v-card>
            <v-btn @click="e1 = 3"> précédente </v-btn>

            <v-btn color="primary" @click="updateprojet" > Valider </v-btn>   
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
      conducteur: ['meplat guipé','Rond emaille','feuillard'], 
      materiau: ['cuivre','aluminium'], 
       etage: ['1','2'], 
      typeCanaux: ['complet','lune'],
      projet: {
         id:undefined,
      materiau:"",
      conducteur:"",
        scu1:"",
        j1:"",
        ep1PapierBT:"",
        nbrPapierBT:"",
        typeCanauxBT:"",
        canauxBT:"",
        lgCalesBT:"",
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
      };
      axios.put('bobinesec/update/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id, console.log(projets))
        
      );
 this.$router.push('/');    },
  
  },
  async mounted() {
    const result = await axios.get('projets/'+this.$route.params.id);
    this.projet = result.data;
  },
   created(){
       axios.get('/getdesignationBarre').then(
        (response) => (this.barre = response.data)
      );
       axios.get('/getValeurHbrin').then(
        (response) => (this.hbrin = response.data)
      );
       axios.get('/getValeurSaillie').then(
        (response) => (this.saillie = response.data)
      );
    }
 
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
.container .title {
  font-size: 25px;
  font-weight: 500;
  position: relative;
  color: #56a5da;
}
.container .title::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -2px;
  height: 3px;
  width: 250px;
  border-radius: 5px;
/* margin-bottom: 5%; */
  /* background: linear-gradient(135deg, #71b7e6, #71b7e6); */
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
</style>
