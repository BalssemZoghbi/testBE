<template>
<div>
<navbar2/>
<br>
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
              <input type="text" class="form__input" placeholder=" " id="echangeurs"
        v-model="echangeurs">
              <label for="" class="form__label">Echangeurs</label>
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
          <div class="input-box">
            <div class="form__div">
              <input type="text" class="form__input" placeholder=" " id="refroidissement"
        v-model="refroidissement">
              <label for="" class="form__label">Refroidissement</label>
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
        <div class="button">
          <input type="submit" value="Crée">
        </div>
      </form>
    </div>
  </div>
</div>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
import navbar2 from './navbar2.vue';
export default {
  components: { navbar2 },
  data() {
    return {
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
      };
      ProjetService.createProjet(projet).then(
        (response) => (this.id = response.data.id)
      );
      this.$router.push({ name: "Home" });
    },
  },
};
</script>

<style scoped>
/* Googlefont Poppins CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
/*===== GOOGLE FONTS =====*/
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");
/*===== VARIABLES CSS =====*/
:root{
  /*===== Colores =====*/
  --first-color: #4797d1;
  --input-color: #80868B;
  --border-color: #DADCE0;

  /*===== Fuente y tipografia =====*/
  --body-font: 'Roboto', sans-serif;
  --normal-font-size: 1rem;
  --small-font-size: .75rem;
}
  
/*===== BASE =====*/
*,::before,::after{
  box-sizing: border-box;
}
body{
  margin: 0;
  padding: 0;
  font-family: var(--body-font);
  font-size: var(--normal-font-size);
}
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
  font-size: var(--normal-font-size);
  border: 1px solid var(--border-color);
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
  font-size: var(--normal-font-size);
  transition: .3s;
}
.form__button{
  display: block;
  margin-left: auto;
  padding: .75rem 2rem;
  outline: none;
  border: none;
  background-color: var(--first-color);
  color: #fff;
  font-size: var(--normal-font-size);
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
  color: var(--first-color);
  font-size: var(--small-font-size);
  font-weight: 500;
  z-index: 10;
}

/*Input focus sticky top label*/
.form__input:not(:placeholder-shown).form__input:not(:focus)+ .form__label{
  top: -.5rem;
  left: .8rem;
  font-size: var(--small-font-size);
  font-weight: 500;
  z-index: 10;
}

/*Input focus*/
.form__input:focus{
  border: 1.5px solid var(--first-color);
}




*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}

body{
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  background: linear-gradient(135deg,#71b7e675, #71b7e675);
}
.container{
  max-width: 98%;
  height: 80%;
  margin-top: 5%;
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
   margin-top: 45px ;
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