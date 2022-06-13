<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height image" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="8">
            <v-card class="elevation-12">
              <v-window v-model="step">
                <v-window-item :value="1">
                  <v-row>
                    <v-col cols="12" md="8">
                      <v-card-text class="mt-12">
                        <h1
                          class="text-center display-2 teal--text text--accent-3"
                        >
                          Connecter-vous
                        </h1>

                        <v-form >
                          <error v-if="error" :error="error" />
                          <v-text-field
                            label="Email"
                            name="Email"
                            prepend-icon="email"
                            type="text"
                            v-model="email"
                            :rules="EmailRules"
                          />

                          <v-text-field
                            id="password"
                            label="Mot de passe"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="password"
                            :rules="nameRules"
                          />
                        </v-form>
                        <router-link class="nav-link" to="/forgot">
                          <h3 class="text-center mt-4">
                            Mot de passe oublié ?
                          </h3></router-link
                        >
                      </v-card-text>
                      <div class="text-center mt-3">
                        <v-btn
                          rounded
                          color="teal accent-3"
                          :class="{ disabled: !validateFields }"
                          dark
                          @click="login()"
                          >Connexion</v-btn
                        >
                      </div>
                    </v-col>
                    <v-col
                      cols="12"
                      md="4"
                      class="teal accent-3"
                      style="margin-top: -1%"
                    >
                      <v-card-text class="white--text mt-12">
                        <h1 class="text-center display-1">Bonjour !</h1>
                        <h5 class="text-center">
                          Entrez vos données personnelles et commencez votre
                          journée
                        </h5>
                      </v-card-text>
                      <div class="text-center">
                        <v-btn rounded outlined dark @click="step++"
                          >INSCRIPTION</v-btn
                        >
                      </div>
                    </v-col>
                  </v-row>
                </v-window-item>
                <v-window-item :value="2">
                  <v-row class="fill-height">
                    <v-col cols="12" md="4" class="teal accent-3">
                      <v-card-text class="white--text mt-12">
                        <h1 class="text-center display-1">Salut !</h1>
                        <h5 class="text-center">
                          Pour rester connecté avec nous, veuillez vous
                          connecter avec vos informations personnelles
                        </h5>
                      </v-card-text>
                      <div class="text-center">
                        <v-btn rounded outlined dark @click="step--"
                          >s'identifier</v-btn
                        >
                      </div>
                    </v-col>

                    <v-col cols="12" md="8">
                      <v-card-text class="mt-4">
                        <h1
                          class="text-center display-2 teal--text text--accent-3"
                        >
                          Crée un compte
                        </h1>

                        <h4 class="text-center mt-4">
                          Assurez-vous de votre email pour l'inscription
                        </h4>
                        <v-form >
                          <error v-if="error" :error="error" />
                          <v-text-field
                            label="Nom"
                            name="Name"
                            prepend-icon="person"
                            type="text"
                            v-model="formFields.name"
                            :rules="nameRules"
                            required
                          />
                          <v-row no-gutters>
                            <v-col cols="6" md="4">
                              <v-select
                                :items="Poste"
                                label="Poste"
                                name="poste"
                                prepend-icon="fa fa-user-tie"
                                type="text"
                                v-model="formFields.poste"
                                :rules="nameRules"
                              ></v-select>
                            </v-col>
                            <v-col cols="12" sm="6" md="8">
                              <v-form ref="form">
                                <v-text-field
                                  label="Numero de telephone"
                                  name="numero"
                                  prepend-icon="phone"
                                  type="text"
                                  v-model="formFields.numero"
                                  :counter="max"
                                  :rules="rules"
                                />
                              </v-form> </v-col
                          ></v-row>
                          <v-text-field
                            label="Email"
                            name="Email"
                            prepend-icon="email"
                            type="text"
                            v-model="formFields.email"
                            :rules="EmailRules"
                          />
                          <v-row no-gutters>
                            <v-col cols="6">
                              <v-text-field
                                id="password"
                                label="Mot de passe"
                                name="password"
                                prepend-icon="lock"
                                type="password"
                                v-model="formFields.password"
                                :rules="rules"
                            /></v-col>
                            <v-col cols="6">
                              <v-text-field
                                id="password_confirm"
                                label="Confirmer Mot de passe"
                                name="password_confirm"
                                prepend-icon="lock"
                                type="password"
                                v-model="formFields.password_confirm"
                                :rules="passwordRules" /></v-col
                          ></v-row>
                          <!-- v-model="formData.image" -->
                          <v-file-input
                            truncate-length="15"
                            
                            @change="onFileChange"
                            label="Image*"
                          ></v-file-input>
                          <!-- <img v-bind:src="'../../../../backend/public/public/Image'+imagePreview" width="100" height="100" v-show="showPreview"/>  -->
                        </v-form>
                      </v-card-text>
                      <div class="text-center mt-n5">
                        <!-- @click="createAccount()" -->
                        <!-- @submit.prevent="submitForm" -->
                        <v-btn
                          rounded
                          color="teal accent-3"
                          dark
                          type="submit"
                          @click="submitForm()"
                          >Inscription</v-btn
                        >
                      </div>
                    </v-col>
                  </v-row>
                </v-window-item>
              </v-window>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import axios from "axios";
import Error from "@/components/Error";
import { mapState } from "vuex";
export default {
  components: {
    Error,
  },
  data: () => ({
    step: 1,
    user: [],
    Poste: ["Directeur", "Technicien", "Ingenieur"],
    valid: false,
    email: "",
    EmailRules: [
      (v) => !!v || "E-mail est obligatoire",
      // v => /.+@sacemindustries.+/.test(v) || 'E-mail doit inclure @sacemindustries',
    ],
    nameRules: [
      (v) => !!v || "Champs Obligatoire",
      (v) => v.length <= 100 || "Champs doit etre valide ",
    ],
    phoneRules: [
      (v) => !!v || "Champs Obligatoire",
      (v) => v.length == 8 || "Le Numero doit etre huit chiffres",
    ],
    passwordRules: [
      (v) => !!v || "Champs Obligatoire",
      (v) => v == this.password || "Le mot de passe doit etre compatible",
    ],
    password: "",
    password_confirm: "",
    name: "",
    poste: "",
    numero: "",
    image: "",
    max: 8,
    min: 8,
    error: "",
    imagePreview: null,
showPreview: false,
    formFields: {
              password: "",
    password_confirm: "",
    name: "",
    poste: "",
    numero: "",
    image: "",
            },
  }),

  computed: {
    rules() {
      const rules = [];

      if (this.max) {
        const rule = (v) =>
          (v || "").length <= this.max ||
          `Un maximum de ${this.max} caractères est autorisé`;

        rules.push(rule);
      }
      if (this.min) {
        const rule = (v) =>
          (v || "").length >= this.min || `Au minimum  ${this.min} caractères `;

        rules.push(rule);
      }

      if (!this.allowSpaces) {
        const rule = (v) =>
          (v || "").indexOf(" ") < 0 || "Eviter les espaces s'il vous plait";

        rules.push(rule);
      }

      return rules;
    },
    validateFields: function () {
      if (this.email != "" && this.password != "") {
        return true;
      } else {
        return false;
      }
    },
    ...mapState(["status"]),
  },
  methods: {
    onFileChange(e){
      this.formFields.image = event.target.files[0];
      console.log(e.target.files);
    let reader  = new FileReader();
    reader.addEventListener("load", function () {
        this.showPreview = true;
        this.imagePreview = reader.result;
    }.bind(this), false);
    if( this.formFields.image ){
        if ( /\.(jpe?g|png|gif)$/i.test( this.formFields.image.name ) ) {
            reader.readAsDataURL( this.formFields.image );
        }
    }
},
    async login() {
      try {
        const response = await axios.post("/login", {
          email: this.email,
          password: this.password,
        });

        localStorage.setItem("token", response.data.token);
        localStorage.setItem("user", JSON.stringify(response.data.user));
        this.user = JSON.parse(localStorage.getItem("user"));
        //  console.log(this.user);
        this.$store.dispatch("user", response.data.user);
        if (this.user.type == "admin") {
          this.$router.push("/dashboard");
        } else {
          this.$router.push("/dashboardEmploye");
        }
      } catch (e) {
        this.error =
          " vous n`avez pas l`accès pour connecter, Veuillez contactez L`administrateur";
      }
    },
    submitForm(){
    let formData = new FormData();
//  step: ,
    formData.append("image", this.formFields.image);
    formData.append("name", this.formFields.name);
    formData.append("step", this.step);
    formData.append("email", this.formFields.email);
    formData.append("poste", this.formFields.poste);
    formData.append("numero", this.formFields.numero);
    formData.append("password", this.formFields.password);
    formData.append("password_confirm", this.formFields.password_confirm);
 try {
    axios.post('/register', formData)
            .then((res) => {
                console.log(res);
            })
            .catch((error) => {
                console.log(error);
    });
      this.step--;
      } catch (e) {
        this.error = "une erreur c'est produite";
      }
    },

    async createAccount() {
      // console.log(e);
      try {
        await axios.post("/register", {
          step: this.step,
          name: this.formData.name,
          email: this.formData.email,
          poste: this.formData.poste,
          numero: this.formData.numero,
          password: this.formData.password,
          image: this.formData.image,
          password_confirm: this.formData.password_confirm,
        });
        //   this.$router.push('/Connexion');
        this.step--;
      } catch (e) {
        this.error = "une erreur c'est produite";
      }
    },
  },
  // mounted() {

  // },
  // beforeEnter: (to, from, next) => {
  //           if (localStorage.getItem('user')) {
  //               next();
  //           } else {
  //               next('/Connexion');
  //           }

  //           next();
  //       },
  //     beforeCreate(){
  // let user = localStorage.getItem("user");
  //     if (user) {
  //       // this.$router.push("/");
  //       window.history.back();
  //     }
  // }
};
</script>
<style scoped>
.image {
  /* background-image:  url("../../assets/backgroundai.jpg"); */
  /* background-image:  url("../../assets/ai-technology-brain-background-digital-transformation-concept.jpg"); */
  background-image: url("../../assets/rm373batch2-04.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.row {
  display: flex;
  flex-wrap: wrap;
  flex: 1 1 auto;
  margin: 0.1px;
}

.v-application .teal.accent-3 {
  background-color: rgb(29 48 117) !important;
  border-color: rgb(29 48 117) !important;
}
.v-application .teal--text.text--accent-3 {
  color: rgb(29 48 117) !important;
  /* caret-color: #2196f3 !important; */
}
</style>
