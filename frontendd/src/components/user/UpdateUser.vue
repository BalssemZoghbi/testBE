<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="50%" max-height="50%" style="margin-top:30%!important;" >
      <template v-slot:activator="{ on, attrs }">
        <v-btn dark v-bind="attrs" color="green darken-1" text v-on="on" style=" background-color:white;margin-left: 20%!important;"  > Mise à jour </v-btn>
      </template>
      <v-card >
        <v-card-title>
          <!-- <span class="text-h5">Modifier Profile</span> -->
        </v-card-title>
        <v-card-text>
          <v-container >
             <v-col >
                      <v-card-text class="mt-4" style="margin-top: -5%!important;">
                        <h4 class="text-center display-2 blue--text text--accent-3" style="font-size:35px!important">
                           Mettez a jour votre profile
                        </h4>
                        <!-- <h4 class="text-center display-2 blue--text text--accent-3">
                            Bienvenue {{ data.name}}
                        </h4> -->
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
                          
                      <!-- <v-row no-gutters> -->
                            <!-- <v-col
                            cols="7"
                          >    -->
                           <v-text-field
                            label="Email*"
                            name="Email"
                            prepend-icon="email"
                            type="text"
                             v-model="data.email"
                             :rules="Rules"
                          /> 
                         <!-- </v-col>
                           <v-col
                            cols="5"
                          >   -->
                             <v-text-field
                            id="password"
                            label="Mot de passe*"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="data.password"
                            :rules="Rules"
                          />
                          <!-- </v-col> -->
                          <!-- </v-row> -->
                        </v-form>
                      </v-card-text>
                      <div class="text-center mt-n5">
                        
                      </div>
                    </v-col>
            <!-- <v-col>
              <v-row cols="12" sm="6" md="4">
                <v-text-field
                  label="Nom"
                  required
                  v-model="data.name"
                ></v-text-field>
              </v-row>
            
              <v-row cols="12">
                <v-text-field
                  label="Email*"
                  required
                  v-model="data.email"
                ></v-text-field>
              </v-row>
              <v-row cols="12">
                <v-text-field
                  label="Mot de passe*"
                  type="password"
                  required
                  v-model="password"
                ></v-text-field>
              </v-row>
            </v-col> -->
          </v-container>
          <small >* Champ obligatoire</small>
        </v-card-text>
        <v-card-actions style="margin-top:-6%">
          <v-spacer></v-spacer>
          <v-btn rounded  color="red darken-1" text @click="dialog = false">
            Fermer
          </v-btn>
          <!-- <v-btn rounded color="blue accent-3" dark @click="createAccount()"
                          >Inscription</v-btn
                        > -->
          <v-btn rounded color="blue darken-1" text @click="update">
           Sauvegarder
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
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
  mounted() {
    this.data = this.Data;
    console.log(this.data);
  },
    methods: {
    update() {
      let user = {
        email: this.data.email,
        name: this.data.name,
        password: this.password,
      }
      // console.log(user)
      axios.put('/user/updateprofile/'+this.data.id, user,{ headers: { token: localStorage.getItem('token')}})
      .then(
        (response) => (this.id = response.data.id)
        
      );
    }
  },
};
</script>