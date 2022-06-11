<template>
  <div>
    <div class="body">
      <v-stepper v-model="e1" vertical>
        <Loading v-if="spinner"/>
        <v-stepper-step step=""> Calcul </v-stepper-step>
        <v-stepper-content step="1">
          <v-card class="mb-12">
            <div class="title">Volt/Spires</div>
            <div class="content">
              <form v-on:submit.prevent="updateprojet">
                <div class="user-details">
                  <div class="input-box">
                    <div class="form__div frame">
                      <input
                        type="text"
                        class="form__input "
                        placeholder=" "
                        id="Bmaxdesire"
                        v-model="projet.Bmaxdesire"
                      />
                      <label for="" class="form__label ">Bmax desire</label>
                    </div>

                    <div class="form__div frame">
                      <input
                        type="number"
                        class="form__input auto"
                        placeholder=" "
                        id="Bmax"
                        v-model="bmax"
                      />
                      <label for="" class="form__label autol">Bmax</label>
                    </div>
                    <div class="form__div frame">
                      <input
                        type="number"
                        class="form__input auto"
                        placeholder=" "
                        id="N1c"
                        v-model="n1c"
                      />
                      <label for="" class="form__label autol">N1c</label>
                    </div>
                    <div class="form__div frame">
                      <input
                        type="number"
                        class="form__input auto"
                        placeholder=" "
                        id="N2c"
                        v-model="n2cDesire"
                      />
                      <label for="" class="form__label autol">N2c</label>
                    </div>

                    <div class="form__div frame">
                      <input
                        type="text"
                        class="form__input auto"
                        placeholder=" "
                        id="Vsp"
                        v-model="vsp"
                      />
                      <label for="" class="form__label autol">Vsp</label>
                    </div>
                  </div>
                  <v-row cols="2" md="4" class="ml-4">
                    <v-card outlined tile>
                      <template>
                        <v-card>
                          <v-card-title class="subheading font-weight-bold">
                            prise
                          </v-card-title>

                          <v-divider></v-divider>

                          <v-list dense>
                            <v-list-item
                              v-for="item in prises"
                              :key="item"
                              style="width: 176% !important"
                            >
                              <v-list-item-content>{{
                                item
                              }}</v-list-item-content>
                              <v-list-item-content class="align-end">
                              </v-list-item-content>
                            </v-list-item>
                          </v-list>
                        </v-card>
                      </template>
                    </v-card>

                    <v-card cols="2" md="4" class="ml-4" outlined tile>
                      <template>
                        <v-card-title class="subheading font-weight-bold">
                          spire
                        </v-card-title>

                        <v-divider></v-divider>

                        <v-list dense>
                          <v-list-item
                            v-for="item in spires"
                            :key="item"
                            style="width: 176% !important"
                          >
                            <v-list-item-content vertical>{{
                              item
                            }}</v-list-item-content>
                            <v-list-item-content class="align-end">
                            </v-list-item-content>
                          </v-list-item>
                        </v-list>
                      </template>
                    </v-card>
                  </v-row>
                </div>
              </form>
            </div>
          </v-card>

          <router-link class="nav-link" :to="'/projet/gradin/' + projet.id">
            <v-btn color="primary mb-14" @click="e1 = 2"> précédent </v-btn>
          </router-link>
          <v-btn color="success mb-14" @click="updateprojet"> Valider </v-btn>
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
        Bmaxdesire: "",
        Bmax: "",
        Vsp: "",
        N2c: "",
        N1c: "",
        prise: "",
        spire: "",
      },
      e1: 1,
    };
  },

  methods: {
    updateprojet() {
      const projets = {
        id: undefined,
        Bmaxdesire: this.projet.Bmaxdesire,
        Bmax: this.projet.Bmax,
        Vsp: this.projet.Vsp,
        N2c: this.projet.N2c,
        N1c: this.projet.N1c,
        prise: this.projet.prise,
        spire: this.projet.spire,
      };
      axios
        .put("/volt/update/" + this.$route.params.id, projets)
        .then(
          (response) => (
            (this.id = response.data.id), console.log(response.data)
          )
        );
  if (this.projet.conducteurBT == "Rond emaille") {
        this.$router.push(
          "/projet/bobinageSecondaireRond/" + this.$route.params.id
        );
      } else if (this.projet.conducteurBT == "feuillard") {
        this.$router.push(
          "/projet/bobinageSecondaireFeuillard/" + this.$route.params.id
        );
      } else if (this.projet.conducteurBT == "meplat guipé") {
        this.$router.push(
          "/projet/bobinageSecondaireMeplat/" + this.$route.params.id
        );
      }
    },
     DeuxChiffre(x) {
      return Math.round(x * 100) / 100;
    },
  },
  async mounted() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
  },
  async created() {
    const result = await axios.get("projets/" + this.$route.params.id);
    this.projet = result.data;
    this.spinner=false;

  },
  computed: {
    spires() {
      let spires = [];
      let spires1 = [];
      for (let i = 0; i < this.projet.priseSoustractive; i++) {
        spires[i] =
         (this.n1c -
          Math.abs(
            ((i - this.projet.priseSoustractive) *
              this.n1c *
              this.projet.echelonSousctractive) /
              100
          ));
      }
      
      for (
        let i = this.projet.priseSoustractive;
        i < this.projet.priseSoustractive + this.projet.priseAdditive + 1;
        i++
      ) {
        spires[i] =
          this.n1c +
          Math.abs(
            ((i - this.projet.priseSoustractive) *
              this.n1c *
              this.projet.echelonAdditive) /
              100
          );
      }
         console.log( this.n1c);
      for (
        let i = 0;
        i < this.projet.priseSoustractive + this.projet.priseAdditive + 1;
        i++
      ) {
        spires1[i] =
          Math.floor(spires[this.projet.priseSoustractive + this.projet.priseAdditive - i]);
      }
      return spires1;
    },
    prises() {
   let spires = [];
      let spires1 = [];
      for (let i = 0; i < this.projet.priseSoustractive; i++) {
        spires[i] ='Prise'+(i-this.projet.priseSoustractive);
      }
      for (
        let i = this.projet.priseSoustractive;
        i < this.projet.priseSoustractive + this.projet.priseAdditive + 1;
        i++
      ) {
          spires[i] ='Prise+'+(i-this.projet.priseSoustractive);

      }
      for (
        let i = 0;
        i < this.projet.priseSoustractive + this.projet.priseAdditive + 1;
        i++
      ) {
        spires1[i] =
          spires[this.projet.priseSoustractive + this.projet.priseAdditive - i];
      }
      return spires1;   
    },
    bmax() {
      let bmax;
      if (this.projet.couplageSecondaire == "zn") {
        bmax =this.DeuxChiffre(
          (((parseFloat(this.projet.secondaireUligne) * 2) / 3) *
            Math.pow(10, 6)) /
          (Math.PI *
            parseFloat(this.projet.frequence) *
            Math.sqrt(2) *
            parseFloat(this.projet.Snette) *
            this.n2cDesire));
      } else {
        bmax =
          this.DeuxChiffre((parseFloat(this.projet.secondaireUPhase) * Math.pow(10, 6)) /
          (Math.PI *
            parseFloat(this.projet.frequence) *
            Math.sqrt(2) *
            parseFloat(this.projet.Snette) *
            this.n2cDesire));
      }
      return bmax;
    },
    // N2c() {
    //   let n2c;
    //   if (this.projet.couplageSecondaire == "zn") {
    //     n2c =
    //       (((parseFloat(this.projet.secondaireUligne) * 2) / 3) *
    //         parseFloat(Math.pow(10, 6))) /
    //       (parseFloat(Math.PI) *
    //         parseFloat(this.projet.frequence) *
    //         parseFloat(Math.sqrt(2)) *
    //         parseFloat(this.projet.Snette) *
    //         this.bmax);
    //   } else {
    //     n2c =
    //       (parseFloat(this.projet.secondaireUPhase) *
    //         parseFloat(Math.pow(10, 6))) /
    //       (parseFloat(Math.PI) *
    //         parseFloat(this.projet.frequence) *
    //         parseFloat(Math.sqrt(2)) *
    //         parseFloat(this.projet.Snette) *
    //         this.bmax);
    //   }
    //   return Math.floor(n2c);
    // },
    n2cDesire() {
      console.log(this.projet.secondaireUPhase,this.projet.Snette,this.projet.Bmaxdesire,this.projet.frequence,this.projet.secondaireUligne);
            let n2c;
      if (this.projet.couplageSecondaire == "zn") {
        n2c =
          ((parseFloat(this.projet.secondaireUligne) * 2 / 3) *
            parseFloat(Math.pow(10, 6))) /
          (parseFloat(Math.PI) *
            parseFloat(this.projet.frequence) *
            parseFloat(Math.sqrt(2)) *
            parseFloat(this.projet.Snette) *
            this.projet.Bmaxdesire);
      } else {
        n2c =
          (parseFloat(this.projet.secondaireUPhase) *
            parseFloat(Math.pow(10, 6))) /
          (parseFloat(Math.PI) *
            parseFloat(this.projet.frequence) *
            parseFloat(Math.sqrt(2)) *
            parseFloat(this.projet.Snette) *
            this.projet.Bmaxdesire);
      }
      // if(n2c%2==0){
                return Math.round(n2c);
                // else{
                //     return Math.ceil(n2c);
                // }
    },
    n1c() {
      // let n1c = parseFloat(this.projet.N1c);
      // console.log(this.projet.PrimaireUPhase,"vsp",this.vsp);
      let n1c =this.projet.PrimaireUPhase / this.vsp;
          console.log(n1c);

      return Math.ceil(n1c);
    },
    vsp() {
      let vsp = this.projet.Vsp;
      if (this.projet.couplageSecondaire == "zn") {
        vsp = (parseFloat(this.projet.secondaireUligne) * 2) / 3 / this.n2cDesire;
      } else {
        vsp = parseFloat(this.projet.secondaireUPhase) / this.n2cDesire;
      }
      return this.DeuxChiffre(vsp);
    },
  },
};
</script>
<style scoped>
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
  padding: 20px;
  max-height: calc(100vh - 50px);

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
.auto{
    border: 1px solid green !important;
        border-color: green !important;
        caret-color: green !important;
        color: rgb(7, 134, 7) !important;

}

 .autol{
 color: green !important;
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
.content form .user-details {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 10px 0 12px 0;
}
.input-box {
  display: grid;
  grid-template-columns: 1fr 1fr;
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
  width: 100%;
  border-color: #000;
}
.v-sheet.v-card:not(.v-sheet--outlined) {
  box-shadow: 0px 0px 0px 0px;
}
.v-stepper--vertical {
  padding-bottom: 0px;
}
@media (max-width:1382px) {
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
@media (max-width: 600px) {
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
