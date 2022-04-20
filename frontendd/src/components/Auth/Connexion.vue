<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" fluid>
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
                        <div class="text-center mt-4">
                          <v-btn class="mx-2" fab color="black" outlined>
                            <v-icon>fab fa-facebook-f</v-icon>
                          </v-btn>

                          <v-btn class="mx-2" fab color="black" outlined>
                            <v-icon>fab fa-google-plus-g</v-icon>
                          </v-btn>
                          <v-btn class="mx-2" fab color="black" outlined>
                            <v-icon>fab fa-linkedin-in</v-icon>
                          </v-btn>
                        </div>
                        <v-form>
                            <error v-if="error" :error="error"/>
                          <v-text-field
                            label="Email"
                            name="Email"
                            prepend-icon="email"
                            type="text"
                            v-model="email"
                          />

                          <v-text-field
                            id="password"
                            label="Mot de passe"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="password"
                          />
                        </v-form>
                      <router-link class="nav-link"  to="/forgot">  <h3 class="text-center mt-4" >Mot de passe oublié ?</h3></router-link>
                      </v-card-text>
                      <div class="text-center mt-3">
                        <v-btn rounded color="teal accent-3" :class="{'disabled': !validateFields}" dark  @click="login()"
                          >Connexion</v-btn
                        >
                     <!-- <input type="submit" :class="{'disabled': !validateFields}"  value="Connexion"> -->

                      </div>
                    </v-col>
                    <v-col cols="12" md="4" class="teal accent-3">
                      <v-card-text class="white--text mt-12">
                        <h1 class="text-center display-1">Bonjour !</h1>
                        <h5 class="text-center">
Entrez vos données personnelles et commencez votre journée                        </h5>
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
                         Pour rester connecté avec nous, 
                         veuillez vous connecter avec vos informations personnelles

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
                          Crée un nouveau compte
                        </h1>
                        <!-- <div class="text-center mt-4">
                          <v-btn class="mx-2" fab color="black" outlined>
                            <v-icon>fab fa-facebook-f</v-icon>
                          </v-btn>

                          <v-btn class="mx-2" fab color="black" outlined>
                            <v-icon>fab fa-google-plus-g</v-icon>
                          </v-btn>
                          <v-btn class="mx-2" fab color="black" outlined>
                            <v-icon>fab fa-linkedin-in</v-icon>
                          </v-btn>
                        </div> -->
                        <h4 class="text-center mt-4">
                        Assurez-vous de votre email pour l'inscription
                        </h4>
                        <v-form>
                            <error v-if="error" :error="error"/>
                          <v-text-field
                            label="Nom"
                            name="Name"
                            prepend-icon="person"
                            type="text"
                            v-model="name"
                          />   
                              <v-text-field
                            label="Poste"
                            name="poste"
                            prepend-icon="fa fa-user-tie"
                            type="text"
                            v-model="poste" 
                          />  
                             <v-text-field
                            label="Numero de telephone"
                            name="numero"
                            prepend-icon="phone"
                            type="text"
                            v-model="numero" 
                          /> 
                          <v-text-field
                            label="Email"
                            name="Email"
                            prepend-icon="email"
                            type="text"
                             v-model="email"
                          />
                      
                               
                          <v-text-field
                            id="password"
                            label="Mot de passe"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="password"
                          />
                             <v-text-field
                            id="password_confirm"
                            label="Confirmer Mot de passe"
                            name="password_confirm"
                            prepend-icon="lock"
                            type="password"
                            v-model="password_confirm"
                          />
                        </v-form>
                      </v-card-text>
                      <div class="text-center mt-n5">
                        <v-btn rounded color="teal accent-3" dark @click="createAccount()"
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
import {mapState} from 'vuex';
export default {
    components:{
Error
},
  data: () => ({
    step: 1,
    user:[],
    email:'',
    password:'' ,
     password_confirm:"",
     name: "",
     poste:"",
     numero:"",
    error:''
  }),

  computed:{
    validateFields:function(){
      if(this.email!="" && this.password!=""){
        return true;
      }else{
        return false;
      }
    },
    ...mapState(['status'])
  },
  methods:{
 async login(){
   try{
      const response= await axios.post('/login',{
      email:this.email,
      password:this.password,

    });

  localStorage.setItem('token',response.data.token);
  localStorage.setItem('user',JSON.stringify(response.data.user));
 this.user= localStorage.getItem('user');
 console.log(this.user);
  this.$store.dispatch('user',response.data.user);
 this.$router.push('/dashboard');
  }catch(e){
    this.error=' vous n`avez pas l`accès pour connecter';
    
  }
  },
   async createAccount(){
   try{
 await axios.post('/register',{
     step:this.step,
      name:this.name,
      email:this.email,
      poste:this.poste,
      numero:this.numero,
      password:this.password,
      password_confirm:this.password_confirm,

    });
//   this.$router.push('/Connexion');
  this.step--;
  }catch(e){
this.error='une erreur s\'est produite';
  }
  
  }
}
};
</script>
<style scoped>
.row {
    display: flex;
    flex-wrap: wrap;
    flex: 1 1 auto;
    margin: 0.1px;
}

.v-application .teal.accent-3 {
    background-color: rgb(29 48 117) !important;
    border-color: rgb(29 48 117)!important;
}
.v-application .teal--text.text--accent-3 {
    color: rgb(29 48 117) !important;
    /* caret-color: #2196f3 !important; */
}
</style>
