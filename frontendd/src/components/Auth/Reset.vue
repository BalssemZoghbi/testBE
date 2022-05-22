<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height image" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="8">
            <v-card class="elevation-12">
              <v-window v-model="step">
                <v-window-item :value="2">
                  <v-row class="fill-height">
                    <v-col cols="12" md="4" class="teal accent-3">
                      <v-card-text class="white--text mt-12">
                        <h1 class="text-center display-1">Content de vous revoir!</h1>
                        <h5 class="text-center">
                           réinitialiser votre mot de passe pour permet de vous connectez de nouveau
                        </h5>
                      </v-card-text>
                  
                    </v-col>

                    <v-col cols="12" md="8">
                      <v-card-text class="mt-12">
                        <h1
                          class="text-center display-2 teal--text text--accent-3"
                        >
                        réinitialiser votre mot de passe
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
                        <v-btn rounded color="teal accent-3" dark  @click="handleSubmit()"
                          >Envoyer</v-btn
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
import axios from 'axios';
export default {
    name:"Reset",
  data() {
    return {
      password: "",
      password_confirm:""
    };
  },
  methods: {
async handleSubmit(){
    
      const self=this;
   const response= await axios.post('/reset',{
      password:this.password,
      password_confirm:this.password_confirm,
      token:this.$route.params.token
    });
    console.log(response);
    self.$router.push('/Connexion');


}
  },
};
</script>
<style scoped>
.image{
  /* background-image:  url("../../assets/backgroundai.jpg"); */
  /* background-image:  url("../../assets/ai-technology-brain-background-digital-transformation-concept.jpg"); */
  background-image:  url("../../assets/rm373batch2-04.jpg");
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
    background-color: rgb(29 48 117)  !important;
    border-color: rgb(29 48 117) !important;
}
.v-application .teal--text.text--accent-3 {
    color: rgb(29 48 117)  !important;
    /* caret-color: #2196f3 !important; */
}
</style>
