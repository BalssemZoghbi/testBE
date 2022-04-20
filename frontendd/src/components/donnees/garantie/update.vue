<template>
   <div>
<!-- <navbarUpdate :elec_id='projet.electrique_id' /> -->
         <NavDash />

<div class="body">
  <v-stepper v-model="e1">
    <v-stepper-header>
      <v-stepper-step
        :complete="e1 > 1"
        step="1"
      >
        Name of step 1
      </v-stepper-step>

      <v-divider></v-divider>

      <v-stepper-step
        :complete="e1 > 2"
        step="2"
      >
        Name of step 2
      </v-stepper-step>

    </v-stepper-header>

    <v-stepper-items>
      <v-stepper-content step="1">
        <v-card
          class="mb-12"
          color="grey lighten-1"
          height="450px"
        >
        <div class="body">
<div class="container">
    <div class="title">Données  de Garantie</div>
    <div class="content">
      <form v-on:submit.prevent="updateprojet">
        <div class="user-details">
           <div class="input-box">
               <div class="form__div">
                    <input type="text" class="form__input" placeholder=" " readonly id="option" v-model="projet.option">
                    <label for="" class="form__label">Option</label>
                </div>
          </div>
          <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " readonly id="Pog" v-model="projet.Pog">
              <label for="" class="form__label">Pog</label>
          </div>
          </div>
           <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " readonly id="log" v-model="projet.log">
              <label for="" class="form__label">I0g</label>
          </div>
          </div>
           <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="Pccg" readonly v-model="projet.Pccg">
              <label for="" class="form__label">Pccg</label>
          </div>
          </div>
            <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="Uccg" readonly v-model="projet.Uccg">
              <label for="" class="form__label"> Uccg</label>
          </div>
          </div>
       
          
            <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" "  readonly id="Ptot" v-model="projet.Ptot">
              <label for="" class="form__label">Ptot</label>
          </div>
          </div>
            <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" "  id="Poglimit" readonly
        v-model="projet.Poglimit">
              <label for="" class="form__label">Poglimite</label>
          </div>
          </div>
           
            
        </div>
      </form>
    </div>
</div>
        </div>

  </v-card>

        <v-btn
          color="primary"
          @click="e1 = 2"
        >
          Continue
        </v-btn>

        <!-- <v-btn @click="e1 = 1"> précédente </v-btn> -->
      </v-stepper-content>

      <v-stepper-content step="2">
        <v-card
          class="mb-12"
          color="grey lighten-1"
          height="450px"
        >
            <div class="body">
<div class="container">
    <div class="title">Données de Garantie</div>
    <div class="content">
      <form v-on:submit.prevent="updateprojet">
        <div class="user-details">
          <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" "  id="Pccglimit" readonly
        v-model="projet.Pccglimit">
              <label for="" class="form__label">Pccglimite </label>
          </div>
          </div>
          
           <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" "  id="loglimit" 
        v-model="projet.loglimit" readonly>
              <label for="" class="form__label">I0glimite</label>
          </div>
          </div>
             <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="Uccglimit" readonly
        v-model="projet.Uccglimit">
              <label for="" class="form__label">Uccglimite </label>
          </div>
          </div>
            <div class="input-box">
            <div class="form__div"> 
              <input type="text" class="form__input" placeholder=" " id="Ptotlimit" readonly
        v-model="projet.Ptotlimit">
              <label for="" class="form__label">Ptotlimit </label>
          </div>
          </div>
           <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="echauffementHuile" readonly
        v-model="projet.echauffementHuile">
              <label for="" class="form__label" readonly>Echauffement Huile</label>
          </div>
          </div>
          <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" "  id="echauffementEnroulement" readonly
        v-model="projet.echauffementEnroulement">
              <label for="" class="form__label">Echauffement Enroulement </label>
          </div>
          </div>
             
        </div>
         
      </form>
    </div>
</div>
        </div>
        </v-card>
        <v-btn @click="e1 = 1"> précédente </v-btn>

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
// import navbarUpdate from '../../navbarUpdate.vue';
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
  },
  async mounted() {
    const result = await axios.get('projets/'+this.$route.params.id);
    this.projet = result.data;
  },
  created(){
    console.log('create')
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
     axios.put('garantie/edit/'+this.$route.params.id, projets).then(
        (response) => (this.id = response.data.id, console.log(response.data))
        
      );
  }
};
</script>
<style scoped>

/* Googlefont Poppins CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");

h1{
  margin: 0;
}

/*===== FORM =====*/
.l-form{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.form{
  width: 360px;
  padding: 4rem 2rem;
  border-radius: 1rem;
  box-shadow: 0 10px 25px rgba(92,99,105,.2);
}
.form__title{
  font-weight: 400;
  margin-bottom: 3rem;
}
.form__div{
  position: relative;
  height: 48px;
  margin-bottom: 1.5rem;
}
.form__input{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  font-size: 1rem;
  border: 1px solid #DADCE0;
  border-radius: .5rem;
  outline: none;
  padding: 1rem;
  background: none;
  z-index: 1;
}
.form__label{
  position: absolute;
  left: 1rem;
  top: 0.7rem;
  padding: 0 .25rem;
  background-color: #fff;
  color: #000000ad;
  font-size: 1rem;
  transition: .3s;
}
.form__button{
  display: block;
  margin-left: auto;
  padding: .75rem 2rem;
  outline: none;
  border: none;
  background-color: #4797d1;
  color: #fff;
  font-size: 1rem;
  border-radius: .5rem;
  cursor: pointer;
  transition: .3s;
}
.form__button:hover{
  box-shadow: 0 10px 36px rgba(0,0,0,.15);
}

/*Input focus move up label*/
.form__input:focus + .form__label{
  top: -.5rem;
  left: .8rem;
  color: #4797d1;
  font-size: .75rem;
  font-weight: 500;
  z-index: 10;
}

/*Input focus sticky top label*/
.form__input:not(:placeholder-shown).form__input:not(:focus)+ .form__label{
  top: -.5rem;
  left: .8rem;
  font-size: .75rem;
  font-weight: 500;
  z-index: 10;
}

/*Input focus*/
.form__input:focus{
  border: 1.5px solid #4797d1;
}




/* *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
} */

.body{
  height: 100%;
  /* display: flex; */
  /* justify-content: center;
  align-items: center; */
  padding: 20px;
        max-height: calc(100vh - 50px);

  /* margin: 0.5%; */
  background: linear-gradient(135deg,#71b7e675, #71b7e675);
}
.container{
    max-width: 92%;
    max-height: 99%;
    /* height: 80%; */
    margin-top: 0%;
    width: 100%;
    background-color: #fff;
    padding: 25px 30px;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgb(0 0 0 / 15%);
}
.container .title{
  font-size: 25px;
  font-weight: 500;
  position: relative;
}
.container .title::before{
  content: "";
  position: absolute;
  left: 0;
  bottom: -5px;
  height: 3px;
  width:250px;
  border-radius: 5px;
  background: linear-gradient(135deg, #71b7e6, #71b7e6);
}
.content form .user-details{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .user-details .input-box{
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
}
form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}
.user-details .input-box input{
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
.user-details .input-box input:focus,
.user-details .input-box input:valid{
  border-color: #000;
}
 form .gender-details .gender-title{
  font-size: 20px;
  font-weight: 500;
 }
 form .category{
   display: flex;
   width: 80%;
   margin: 14px 0 ;
   justify-content: space-between;
 }
 form .category label{
   display: flex;
   align-items: center;
   cursor: pointer;
 }
 form .category label .dot{
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
 #dot-3:checked ~ .category label .three{
   background: #71b7e6;
   border-color: #d9d9d9;
 }
 form input[type="radio"]{
   display: none;
 }
 form .button{
   height: 45px;
   margin-top: 10px ;
   margin-left: 80%;
 }
 form .button input{
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
   background: linear-gradient(135deg, #4797d1, #4797d1)
 }
 form .button input:hover{
  /* transform: scale(0.99); */
  background: linear-gradient(-135deg, #71b7e6, #71b7e6);
  }
 @media(max-width: 584px){
 .container{
  max-width: 100%;
}
form .user-details .input-box{
    margin-bottom: 15px;
    width: 100%;
  }
  form .category{
    width: 100%;
  }
  .content form .user-details{
    max-height: 300px;
    overflow-y: scroll;
  }
  .user-details::-webkit-scrollbar{
    width: 5px;
  }
  }
  @media(max-width: 459px){
  .container .content .category{
    flex-direction: column;
  }
}

</style>