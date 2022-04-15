<template>
   <div>
  <navbarUpdate :elec_id='projet.electrique_id' :id='projet.id'/>
<div class="body">
  <v-stepper v-model="e1">
    <v-stepper-header>
      <v-stepper-step
        :complete="e1 > 1"
        step="1"
      >
        Bobinage
      </v-stepper-step>

    </v-stepper-header>

    <v-stepper-items>
      <v-stepper-content step="1">
        <v-card
          class="mb-12"
          color="#71b7e675"
          height="450px"
        >
        <div class="body">
          
<div class="container">
  
    <div class="content">
      <form  v-on:submit.prevent="updateprojet">
        <div class="user-details">
           <div class="input-box">  <div class="title">bobine primaire</div>
               <div class="form__div">
                    <!-- <input type="text" class="form__input" placeholder=" " id="materiau" v-model="projet.materiau">
                    <label for="" class="form__label">materiau</label> -->
                     <v-select
                :items="materiau"
                label="materiau"
                v-model="projet.materiau"
                dense
                outlined
              ></v-select>
                </div>
          </div>
           
           <div class="input-box"><div class="title">bobine secondaire</div>
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
    </div>
</div>
        </div>
  </v-card>   
        <v-btn color="primary" @click="updateprojet">
          Changer
        </v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</div>
</div>
</template>

<script>
// import { reactive } from "vue";
import navbarUpdate from '../../navbarUpdate';

import axios from "axios";
export default {
    components: { navbarUpdate },
  data() {
    return {
      conducteur: ['meplat guipé','Rond emaille','feuillard'], 
      materiau: ['cuivre','aluminium'], 
      projet: {
         id:undefined,
      materiau:"",
      conducteur:"",
        materiauSec:"",
      conducteurSec:"",
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
        conducteurSec: this.projet.conducteurSec
      };
      axios.put('bobine/update/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id)
        
      );
       axios.put('bobinesec/update/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id)
        
      );
 this.$router.push('/gradin/'+this.$route.params.id);    },
  
  },
  async mounted() {
    const result = await axios.get('projets/'+this.$route.params.id);
    this.projet = result.data;
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
