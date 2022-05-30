<template>
      <v-card style="margin-top: -22%!important;width:60%;margin-left:40%;height:97%">
        <v-card-text>
          <v-container >
             <v-col >
                      <v-card-text class="mt-4" style="margin-top: -5%!important;">
                        <h4 class="text-center display-2 blue--text text--accent-3" style="font-size:35px!important">
                           Mettez a jour votre profile
                        </h4>
                        <h4 class="text-center mt-4" >
                        Bienvenue {{ data.name}}
                        </h4>
                        <v-form>
                          <v-text-field
                            label="Nom*"
                            name="Name"
                            prepend-icon="person"
                            type="text"
                            v-model="data.name"
                            :rules="Rules"
                             required
                          />   
                             <v-row no-gutters>
                           <v-col
                              cols="6"
                              md="6"
                            >
                              <v-text-field
                            label="Poste*"
                            name="poste"
                            prepend-icon="fa fa-user-tie"
                            type="text"
                            v-model="data.poste" 
                            :rules="Rules"
                          /> </v-col> 
                           <v-col
                             cols="6"
                              md="6"
                          >
                          <v-form ref="form">
                             <v-text-field
                            label="Numero de telephone*"
                            name="numero"
                            prepend-icon="phone"
                            type="text"
                            v-model="data.numero" 
                            :rules="Rules"
                          />
                          </v-form> </v-col>
                          </v-row>
                           <v-text-field
                            label="Email*"
                            name="Email"
                            prepend-icon="email"
                            type="text"
                             v-model="data.email"
                             :rules="Rules"
                          /> 
                             <v-text-field
                            id="password"
                            label="Mot de passe*"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="data.password"
                            :rules="Rules"
                          />
                        </v-form>
                      </v-card-text>
                      <div class="text-center mt-n5">
                        
                      </div>
                    </v-col>
            
          </v-container>
          <small >* Champ obligatoire</small>
        </v-card-text>
        <v-card-actions style="margin-top:-6%">
          <v-spacer></v-spacer>
          <v-btn rounded color="blue darken-1" text @click="update">
           Sauvegarder
          </v-btn>
        </v-card-actions>
      </v-card>
</template>

<script>
import axios from 'axios'
export default {
  name: "UpdateUser",
  props: ["Data"],
  data: () => ({
    dialog: false,
    data: [],
    name:'',
    email:'',
    password:'',
    Rules: [
        v => !!v || 'Ce champ est obligatoire',
      
      ]
  }),
  created() {
    this.data = this.Data;
    console.log(this.Data);
  },
    methods: {
    update() {
      let user = {
        email: this.Data.email,
        name: this.Data.name,
        password: this.Data.password,
        poste: this.Data.poste,
        numero: this.Data.numero,
      }
      // console.log(this.Data)
      axios.put('/user/updateprofile/'+this.Data.id, user,{ headers: { token: localStorage.getItem('token')}})
      .then(
        (response) => (this.id = response.data.id)
        
      );
    }
  },
};
</script>