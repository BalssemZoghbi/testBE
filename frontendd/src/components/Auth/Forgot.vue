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
                          Mot de passe oublié
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
                        <br>
                        <v-form>
                                 <v-alert dense
        id="valert"
      type="success"
      text
      prominent
      icon="mdi-cloud-alert" 
      v-if="message" >   
        {{message}}
     </v-alert>
                            <error v-if="error" :error="error"/>

                          <v-text-field 
                            label="Email"
                            name="Email"
                            prepend-icon="email"
                            type="text"
                            v-model="email"
                          />

                    
                        </v-form>
              <h3 class="text-center mt-4" >consultez votre email </h3>
                      </v-card-text>
                      <div class="text-center mt-3">
                        <v-btn rounded color="teal accent-3" dark  @click="handleSubmit()"
                          >Envoyer</v-btn
                        >
                     <!-- <input type="submit" :class="{'disabled': !validateFields}"  value="Connexion"> -->

                      </div>
                    </v-col>
                    <v-col cols="12" md="4" class="teal accent-3">
                      <v-card-text class="white--text mt-12">
                        <h1 class="text-center display-1">Content de vous revoir!</h1>
                        <h5 class="text-center">
vous recevrez un email pour réinitialiser votre mot de passe
                        </h5>
                      </v-card-text>
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
import Error from "@/components/Error";

// import Error from '../components/Error.vue';
export default {
    name:"Forgot",
components:{
Error
},
  data() {
    return {
      step: 1,
      email: "",
      message:'',
      error:''
    };
  },
  methods: {
async handleSubmit(){
  try{
await axios.post('/forgot',{
  email:this.email
});
this.message='Le mail a été envoyé';
this.error='';
  }catch(e){
    this.error='email incorrect!!';
    this.message='';
  }
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
    background-color: rgb(29 48 117) !important;
    border-color: rgb(29 48 117) !important;
}
.v-application .teal--text.text--accent-3 {
    color: rgb(29 48 117)  !important;
    /* caret-color: #2196f3 !important; */
}
</style>
