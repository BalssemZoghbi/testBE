<template>
       <v-card class="mx-auto ml-2" height="100%" tile>

       <v-card class="mx-auto ml-2 mr-2" max-width="100%"  style=" top: 20px" tile>
          <v-img height="300px" src="../../assets/pres2.jpg"></v-img>
          <v-col>
            <!-- <v-avatar size="100" style="position:absolute; top: 240px">
              <v-img src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg"></v-img>
            </v-avatar> -->
            <v-avatar color="primary" size="90" style="position:absolute; top: 240px;margin-left:41%">
      <v-icon dark size="35">
        mdi-account-circle
      </v-icon>:
    </v-avatar>
          </v-col>
            <v-list-item color="rgba(0, 0, 0, .4)">
              <v-list-item-content>
                <v-list-item-title class="title" style="margin-left:40%">{{  user.name  }}</v-list-item-title>
                <v-list-item-subtitle style="margin-left:-9%;text-align:center">{{  user.poste  }}</v-list-item-subtitle>
                <hr>
               <v-text style="margin-left:20%"> <v-icon>mdi-email</v-icon> {{  user.email  }}</v-text>
               <v-text style="margin-top:-2%;margin-left:65%"> <v-icon>mdi-phone</v-icon> {{  user.numero  }}</v-text>
               <v-text style="margin-left:-9%;text-align:center"> <v-icon>mdi-email</v-icon> {{  user.type  }}</v-text>

              </v-list-item-content>
            </v-list-item>
             </v-card>
           <br>
           <br>
            <v-card class="mx-auto ml-14 mr-14">
             <v-tabs vertical >
      <v-tab>
        <v-icon left >
          mdi-account
        </v-icon>
        Option 1
      </v-tab>
      <v-tab>
        <v-icon left>
          mdi-lock
        </v-icon>
        Option 2
      </v-tab>
      <v-tab>
        <v-icon left>
          mdi-access-point
        </v-icon>
        Option 3
      </v-tab>

      <v-tab-item>
        <v-card flat>
          <v-card-text  style="width:65%;">
             <v-col >
                      <v-card-text >
                        <h4 class="text-center blue--text " style="font-size:20px!important">
                           Mettre à jour votre profil {{ name}}
                        </h4>
                        <v-form>
                            <v-row no-gutters>
                           <v-col
                              cols="6"
                              md="6"
                            >
                          <v-text-field
                            label="Nom*"
                            name="Name"
                            prepend-icon="person"
                            type="text"
                            v-model="user.name"
                            :rules="Rules"
                             required
                          />    </v-col> 
                           <v-col
                             cols="6"
                              md="6"
                          >
                           <v-text-field
                            label="Email*"
                            name="Email"
                            prepend-icon="email"
                            type="text"
                             v-model="user.email"
                             :rules="Rules"
                          /> 
                           </v-col>
                          </v-row>
                             <v-row no-gutters>
                           <v-col
                              cols="6"
                              md="6"
                            >
                               <v-select
                        :items="Poste"
                        label="Poste"
                        name="poste"
                            prepend-icon="fa fa-user-tie"
                            type="text"
                            v-model="user.poste" 
                            :rules="nameRules"
                        
                      ></v-select>
                      </v-col> 
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
                            v-model="user.numero" 
                            :rules="Rules"
                          />
                          </v-form> </v-col>
                          </v-row>
                          
                            
                        </v-form>
                      </v-card-text>
                      <div class="text-center mt-n5">
                        
                      </div>
                    </v-col>
          <v-card-text>
           <small >* Champ obligatoire</small>
        </v-card-text>
        <v-card-actions style="margin-top:-6%">
          <v-spacer></v-spacer>
          <!-- <v-btn rounded color="blue darken-1" text @click="update">
           Sauvegarder
          </v-btn>
             <v-btn
      color="blue"
      class="ma-2 white--text"
      -->
    <!-- >
      Accepter -->
      <v-icon
        right
        dark
      :loading="spinner"
      :disabled="spinner"
         @click="update"
      >
        mdi-pencil
      </v-icon>
    <!-- </v-btn> -->

        </v-card-actions>
          </v-card-text>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <v-card-text>
       <v-text-field
                            id="password"
                            label="Mot de passe*"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="user.password"
                            :rules="Rules"
                          />
          </v-card-text>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <v-card-text>
            <p>
              Fusce a quam. Phasellus nec sem in justo pellentesque facilisis. Nam eget dui. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In dui magna, posuere eget, vestibulum et, tempor auctor, justo.
            </p>

            <p class="mb-0">
              Cras sagittis. Phasellus nec sem in justo pellentesque facilisis. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nam at tortor in tellus interdum sagittis.
            </p>
          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs>
     </v-card>
                  <!-- <v-card height="80px" max-width="38%"  style="top:8%" tile> -->
                    <!--  -->
          <!-- <v-img height="400px" src="../assets/pres2.jpg"></v-img> -->
         
            <!-- <v-list-item color="rgba(0, 0, 0, .4)"> 
              <v-col> -->
                <!--  -->
            <!-- <v-avatar size="100px" style="position:absolute;top:-15%">
              <v-img src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg"></v-img>
               <v-icon  color="success"> mdi-account-circle </v-icon>
            </v-avatar> -->
               <!-- <v-avatar color="indigo" >
      <v-icon dark>
        mdi-account-circle
      </v-icon>
    </v-avatar>
         </v-col>
              <v-row>
                <v-list-item-title class="title">{{user.numero}}</v-list-item-title>
                <v-list-item-subtitle>{{user.type}}</v-list-item-subtitle>
              </v-row> 
            </v-list-item>
      </v-card> -->
       
         <!-- <v-card height="650px" style=" top: -45%;width:60%;margin-left:40%;">
        <v-card-text>
             <v-col >
                      <v-card-text style="margin-top: 20%!important;">
                        <h4 class="text-center display-2 blue--text text--accent-3" style="font-size:35px!important">
                           Mettez a jour votre profile
                        </h4>
                        <h4 class="text-center mt-4" >
                        Bienvenue {{ name}}
                        </h4>
                        <v-form>
                          <v-text-field
                            label="Nom*"
                            name="Name"
                            prepend-icon="person"
                            type="text"
                            v-model="user.name"
                            :rules="Rules"
                             required
                          />   
                             <v-row no-gutters>
                           <v-col
                              cols="6"
                              md="6"
                            >
                               <v-select
                        :items="Poste"
                        label="Poste"
                        name="poste"
                            prepend-icon="fa fa-user-tie"
                            type="text"
                            v-model="user.poste" 
                            :rules="nameRules"
                        
                      ></v-select>
                      </v-col> 
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
                            v-model="user.numero" 
                            :rules="Rules"
                          />
                          </v-form> </v-col>
                          </v-row>
                           <v-text-field
                            label="Email*"
                            name="Email"
                            prepend-icon="email"
                            type="text"
                             v-model="user.email"
                             :rules="Rules"
                          /> 
                             <v-text-field
                            id="password"
                            label="Mot de passe*"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="user.password"
                            :rules="Rules"
                          />
                        </v-form>
                      </v-card-text>
                      <div class="text-center mt-n5">
                        
                      </div>
                    </v-col> -->
            
          <!-- </v-container> -->
          <!-- <small >* Champ obligatoire</small>
        </v-card-text>
        <v-card-actions style="margin-top:-6%">
          <v-spacer></v-spacer>
          <v-btn rounded color="blue darken-1" text @click="update">
           Sauvegarder
          </v-btn>
        </v-card-actions>
      </v-card> -->
      </v-card>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "Profile",
  data: () => ({
          Poste:['Directeur','Technicien','Ingenieur'],
    id:"",
    dialog: false,
    name: "",
    email: "",
    type: "",
    password: "",
    user: [],
      Rules: [
        v => !!v || 'Ce champ est obligatoire',
      
      ]
  }),
  watch: {
    dialog(val) {
      val || this.close();
    },
  },

 
  async created() {
    const response = await axios.get("user");
    this.$store.dispatch("user", response.data);
    this.user = response.data;

  },
  computed: {
    ...mapGetters(["user"]),
  },
 async mounted() {
   const response = await axios.get("user");
    this.$store.dispatch("user", response.data);
    this.user = response.data;

   axios.get('/user/'+this.user.id).then((response) => {
    this.$store.dispatch("user", this.user.id);
     this.user = response.data;
    
        this.email = response.data.email;
        this.password = response.data.password;
        this.name = response.data.name; 
        this.poste = response.data.poste; 
        this.numero = response.data.numero; 
        this.user.email = this.email;
        this.user.password = this.password;
        this.user.name = this.name; 
        this.user.poste = this.poste; 
        this.user.numero = this.numero; 
         })

  },
   methods: {
    update() {
    let user = {
        email: this.user.email,
        name: this.user.name,
        password: this.user.password,
        poste: this.user.poste,
        numero: this.user.numero,
      }
      axios.put('/user/updateprofile/'+this.user.id, user,{ headers: { token: localStorage.getItem('token')}})
      .then(
        (response) => (this.id = response.data.id)
        
      );
  },
   close() {
      this.dialog = false;
    },
  }
};
</script>
<style scoped>
.col {
    flex-basis: 0;
    /* flex-grow: 1; */
    max-width: 100%;
}
</style>