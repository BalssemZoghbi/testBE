<template>
<div>
<navbarcreate :projet_id='this.id'/>
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

      <v-divider></v-divider>

      <v-stepper-step step="3">
        Name of step 3
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
    <div class="title">Données Generale</div>
    <div class="content">
      <form v-on:submit.prevent="storeprojet">
        <div class="user-details">
           <div class="input-box">
               <div class="form__div">
                    <input type="text" class="form__input" placeholder=" " id="appareil" v-model="appareil">
                    <label for="" class="form__label">Appareil</label>
                </div>
          </div>
           <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="reference" v-model="reference">
              <label for="" class="form__label">Reference</label>
          </div>
          </div>
           <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="client" v-model="client">
              <label for="" class="form__label">Client</label>
          </div>
          </div>
            <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="refClient" v-model="refClient">
              <label for="" class="form__label">Reference Client</label>
          </div>
          </div>
       
          
            <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" "  id="user_id"
        v-model="user_id">
              <label for="" class="form__label">Elaboré par</label>
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

        <v-btn text>
          Cancel
        </v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">
        <v-card
          class="mb-12"
          color="grey lighten-1"
          height="450px"
        >
            <div class="body">
<div class="container">
    <div class="title">Données Generale</div>
    <div class="content">
      <form v-on:submit.prevent="storeprojet">
        <div class="user-details">
             <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="type"
        v-model="type">
              <label for="" class="form__label">type</label>
          </div>
          </div>
            <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="remplissage"
        v-model="remplissage">
              <label for="" class="form__label">remplissage</label>
          </div>
          </div>
          <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" "  id="installation"
        v-model="installation">
              <label for="" class="form__label">Installation</label>
          </div>
          </div>
          <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="montage"
        v-model="montage">
              <label for="" class="form__label">Montage</label>
          </div>
          </div>
       
           <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="dielectrique"
        v-model="dielectrique">
              <label for="" class="form__label">Dielectrique</label>
          </div>
          
          </div>
               <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="fonctionnement"
        v-model="fonctionnement">
              <label for="" class="form__label">Fonctionnement</label>
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
          @click="e1 = 3"
        >
          Continue
        </v-btn>

        <v-btn text>
          Cancel
        </v-btn>
      </v-stepper-content>

      <v-stepper-content step="3">
        <v-card
          class="mb-12"
          color="grey lighten-1"
          height="450px"
        >
           <div class="body">
<div class="container">
    <div class="title">Données Generale</div>
    <div class="content">
      <form v-on:submit.prevent="storeprojet">
        <div class="user-details">
              <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="echangeurs"
        v-model="echangeurs">
              <label for="" class="form__label">Echangeurs</label>
          </div>
          </div>
                <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="temperatureMax" v-model="temperatureMax">
              <label for="" class="form__label">TemperatureMax</label>
          </div>
          </div>
          <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="attitudeMax" v-model="attitudeMax">
              <label for="" class="form__label">attitudeMax</label>
          </div>
          </div>
            <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="refroidissement"
        v-model="refroidissement">
              <label for="" class="form__label">Refroidissement</label>
          </div>
          </div>
        </div>
      </form>
    </div>
</div>
        </div>

        </v-card>
        <router-link class="nav-link" :to="'/electrique/create/' + this.id"><v-btn color="primary" @click="storeprojet">
          Crée
        </v-btn></router-link>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</div>
</div>
</template>
<script>
import navbarcreate from '../../navbarcreate';
import axios from "axios";
export default {
  components: { navbarcreate },
   data() {
    return {
        e1: 1,
      appareil: "",
      reference: "",
      client: "",
      refClient: "",
      temperatureMax: "",
      attitudeMax: "",
      type: "",
      remplissage: "",
      installation: "",
      montage: "",
      echangeurs: "",
      dielectrique: "",
      fonctionnement: "",
      refroidissement: "",
      user_id: "",
      electrique_id: "1",
    };
  },
  methods: {
    storeprojet() {
      const projet = {
        id: undefined,
        appareil: this.appareil,
        reference: this.reference,
        client: this.client,
        refClient: this.refClient,
        temperatureMax: this.temperatureMax,
        attitudeMax: this.attitudeMax,
        type: this.type,
        remplissage: this.remplissage,
        installation: this.installation,
        montage: this.montage,
        echangeurs: this.echangeurs,
        dielectrique: this.dielectrique,
        fonctionnement: this.fonctionnement,
        refroidissement: this.refroidissement,
        user_id: this.user_id,
        electrique_id:"1",
      };
      // console.log(projet)
      axios.post('projets/create',projet).then(
        (response) => (
          this.id = response.data.id),
          console.log( this.id ),

      );
      // this.$router.push("/");
    },
  },
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
  max-width: 98%;
  /* height: 80%; */
  margin-top: 2%;
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