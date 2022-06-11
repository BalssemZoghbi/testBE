<template>
  <div>
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <Loading v-if="spinner" />
        <v-stepper-step step="">
          Données de Garantie
        </v-stepper-step>
        <v-stepper-content step="1">
          <v-card class="mb-6">
            <div class="title">Données de Garantie</div>
              <v-col cols="2" style="margin-top: -7%; margin-left: 28%">
                <v-menu transition="slide-x-transition" offset-x>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn v-bind="attrs" v-on="on" color="primary">
                      Automatique
                    </v-btn>
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
              </v-col>
                 <form  v-on:submit.prevent="updateprojet">
         <div class="user-details">
              <v-text-field
              success
                         class="frame"
                        label="Option"
                        v-model="projet.option"
                        outlined
                      ></v-text-field>
                    <div class="div">
                    <div class="field10">
                      <v-text-field
                      outlined
                        label="Pog"
                        v-model="projet.Pog"
                      ></v-text-field>
                      <v-text-field
                      success
                        label="Poglimit"
                        v-model="Poglimit"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                        label="Iog"
                       id="log"
                        v-model="projet.log"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Ioglimit"
                       id="loglimit"
                            readonly
                            success
                            v-model="loglimit"
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                      
                        label="Pccg"
                        v-model="projet.Pccg"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Pccglimit"
                        success
                        v-model="Pccglimit"
                        outlined
                      ></v-text-field>
                    </div>
                        <div class="field10">
                      <v-text-field
                        label="Ptot"
                        v-model="Ptot"
                        
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Ptotlimit"
                        v-model="Ptotlimit"
                        success
                        outlined
                      ></v-text-field>
                    </div>
                    <div class="field10">
                      <v-text-field
                        label="Uccg"
                        
                        v-model="projet.Uccg"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="UccMax"
                        v-model="Uccglimit"
                        success
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="UccMin"
                        v-model="UccgMin"
                        success
                        outlined
                      ></v-text-field>
                    </div>
                
                    <div class="field10">
                      <v-text-field
                        label="Echauffement Enroul"
                        v-model="echauffementEnroulement"
                        outlined
                      ></v-text-field>
                      <v-text-field
                        label="Echauffement Huile"
                        v-model="echauffementHuile"
                        
                        outlined
                      ></v-text-field>
                    </div>
                  </div>
                  </div>
      </form>
          </v-card>

          <router-link
            class="nav-link"
            :to="'/projet/electrique/update/' + this.$route.params.id"
          >
            <v-btn color="primary "  style="margin-top: -7%;" @click="e1 = 2"> précédent </v-btn>
          </router-link>
          <router-link
            :to="'/projet/bobine/' + this.$route.params.id"
            style="text-decoration: none"
          >
            <v-btn
              color="success " 
              @click="automatique"
              v-if="this.garantie == true"
              style="text-decoration: none;margin-top: -7%;"
            >
              Valider
            </v-btn></router-link
          >
          <router-link
            :to="'/projet/bobine/' + this.$route.params.id"
            style="text-decoration: none"
            ><v-btn
              color="success" style="margin-top: -7%;"
              @click="manuel"
              v-if="this.garantie == false"
            >
              Valider
            </v-btn></router-link
          >
        </v-stepper-content>
      </v-stepper>
    </div>
  </div>
</template>
<script>
import Loading from "@/components/Loading.vue";

import axios from "axios";
export default {
  components: {
    Loading,
  },
  data() {
    return {
      spinner: true,
      garantie: true,
      select: { state: "Automatique" },
      items: [{ state: "Automatique" }, { state: "Manuel" }],
      projet1: [],
      projet: {
        id: undefined,
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
        UccgMin: "",
        Ptotlimit: "",
        echauffementHuile: "",
        echauffementEnroulement: "",
      },
      e1: 1,
    };
  },
  methods: {
    async manuel() {
      this.garantie = false;
      const projets = {
        id: undefined,
        option: this.projet.option,
        Pog: this.projet.Pog,
        log: this.projet.log,
        Pccg: this.projet.Pccg,
        Uccg: this.projet.Uccg,
        Ptot: this.projet.Ptot,
        Poglimit: this.projet.Poglimit,
        loglimit: this.projet.loglimit,
        Pccglimit: this.projet.Pccglimit,
        Uccglimit: this.projet.Uccglimit,
        UccgMin: this.projet.UccgMin,
        Ptotlimit: this.projet.Ptotlimit,
        echauffementHuile: this.projet.echauffementHuile,
        echauffementEnroulement: this.projet.echauffementEnroulement,
      };
      await axios
        .put("/garantie/manuelle/" + this.$route.params.id, projets)
        .then(
          (response) => (
            (this.id = response.data.id),
            console.log(response.data),
            this.getGarantie()
          )
        );
    },
    updateprojet() {
      this.$router.push("/projet/bobine/" + this.$route.params.id);
    },
    async automatique() {
      this.garantie = true;
      await axios
        .put("/garantie/edit/" + this.$route.params.id)
        .then((response) => ((this.id = response.data.id), this.getGarantie()));
    },
    async getGarantie() {
      await axios
        .get("getGarantie/" + this.$route.params.id)
        .then((response) => (this.projet = response.data));
    },
  },
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet1 = result.data;
  },
  async created() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet1 = result.data;
    await this.getGarantie();
    this.spinner = false;
  },
  computed: {
    Poglimit() {
      return parseFloat(this.projet.Pog) + parseFloat(this.projet.Pog) * 0.15;
    },
    loglimit() {
      return (
        parseFloat(this.projet.log) + (parseFloat(this.projet.log) * 30) / 100
      );
    },
    Pccglimit() {
      return (
        parseFloat(this.projet.Pccg) + (parseFloat(this.projet.Pccg) * 15) / 100
      );
    },
    Uccglimit() {
      return (
        parseFloat(this.projet.Uccg) + (parseFloat(this.projet.Uccg) * 10) / 100
      );
    },
    UccgMin() {
      return (
        parseFloat(this.projet.Uccg) - (parseFloat(this.projet.Uccg) * 10) / 100
      );
    },
    Ptotlimit() {
      return (
        parseFloat(this.projet.Pccg) +
        parseFloat(this.projet.Pog) +
        ((parseFloat(this.projet.Pccg) + parseFloat(this.projet.Pog)) * 10) /
          100
      );
    },
    echauffementHuile() {
      return 100 - parseInt(this.projet1.temperatureMax);
    },
    echauffementEnroulement() {
      return 105 - parseInt(this.projet1.temperatureMax);
    },
    Ptot() {
      return parseInt(this.projet.Pccg) + parseInt(this.projet.Pog);
    },
  },
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
  height:79%;
  margin-top: 0.5%;
}
.logo {
  width: 100%;
  height: 100%;
  /* margin: 16%; */
  /* margin-left: 39%; */
}
.field10 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  /* grid-template-rows: 1fr 1fr; */
  grid-gap: 10px;
  /* margin-right: 5%; */
  width:400px;
}
.div{
  display: grid; 
  grid-template-columns: 1fr 1fr;
  grid-gap: 10px;
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
@media (max-width:834px) {
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
  /* grid-template-rows: 1fr 1fr; */
  grid-gap: 10px;
  margin-right: 5%;
}
.div{
  display: grid; 
  grid-template-columns: 1fr ;
  grid-gap: 10px;
}
.user-details {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 10px 0 12px 0;
}
}
@media (max-width: 459px) {
  .container .content .category {
    flex-direction: column;
  }
  .field10 {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  /* grid-template-rows: 1fr 1fr; */
  grid-gap: 10px;
  margin-right: 5%;
}
.user-details {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 10px 0 12px 0;
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
