<template>
       <v-card class="mx-auto ml-2" height="100%" tile>

       <v-card class="mx-auto ml-2 mr-2" max-width="100%"  style=" top: 15px" tile>
          <v-img height="180px" src="../../assets/pres2.jpg"></v-img>
          <v-col>
            <!-- <v-avatar size="100" style="position:absolute; top: 240px">
              <v-img src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg"></v-img>
            </v-avatar> -->
            <v-avatar color="primary" size="90" style="position:absolute; top: 130px;margin-left:40%">
      <!-- <v-icon dark size="35">
        mdi-account-circle
      </v-icon>: -->
         <img v-bind:src="'http://127.0.0.1:8000/Image/'+user.image" width="90px" height="90px"/>

    </v-avatar>
          </v-col>
            <v-list-item color="rgba(0, 0, 0, .4)">
              <v-list-item-content>
                <v-list-item-title class="title" style="margin-left:40%">{{  user.name  }}</v-list-item-title>
                <v-list-item-subtitle style="margin-left:-9%;text-align:center">{{  user.poste  }}</v-list-item-subtitle>
               <v-list-item-subtitle style="margin-left:-9%;text-align:center"> {{  user.type  }}</v-list-item-subtitle>

                <hr>
               <v-text style="margin-left:20%"> <v-icon>mdi-email</v-icon> {{  user.email  }}</v-text>
               <v-text style="margin-top:-2%;margin-left:49%"> <v-icon>mdi-phone</v-icon> {{  user.numero  }}</v-text>
               <!-- <v-text style="margin-left:-9%;text-align:center"> <v-icon>fa fa-user-tie</v-icon> {{  user.type  }}</v-text> -->

              </v-list-item-content>
            </v-list-item>
             </v-card>
           <br>
           <br>
            <v-card class="mx-auto ml-2 mr-2">
             <v-tabs vertical >
      <v-tab >
        <v-icon left >
          mdi-account
        </v-icon>
        Information Profil
      </v-tab>
      <v-tab>
        <v-icon left style="margin-left: -30%;">
          mdi-lock
        </v-icon>
        Mot de passe
      </v-tab>

      <v-tab-item>
        <v-card flat>
          <v-card-text  style="width:65%;">
             <v-col >
                      <v-card-text >
                        <h4 class="text-center warning--text " style="font-size:20px!important">
                           Mettre à jour votre profil {{ name}}
                        </h4>
                        <v-form  :disabled="edit">
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
                             <v-text-field
                            label="Numero de telephone*"
                            name="numero"
                            prepend-icon="phone"
                            type="text"
                            v-model="user.numero" 
                            :rules="Rules"
                          /> </v-col>
                          </v-row>
                                             <!-- <v-file-input
                            truncate-length="15"
                            
                            @change="onFileChange"
                            label="Image*"
                          ></v-file-input>
                          <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/>  -->
                            
                        </v-form>
                      </v-card-text>
                      <div class="text-center" style="margin-top:-9%">
                      </div>
                    </v-col>
          <v-card-text>
           <small >* Champ obligatoire</small>
        </v-card-text>
        <v-card-actions style="margin-top:-9%">
          <v-spacer></v-spacer>
              <template v-if="edit" >
          <v-btn
      color="warning"
      class="ma-2 white--text"
         @click="innabled"
    >
      <v-icon
        right
        dark
      >
        mdi-pencil
      </v-icon>
    </v-btn>
    </template>
        <v-btn
        v-else
      color="success"
      class="ma-2 white--text"
    
         @click="update"
    >
      <v-icon
        right
        dark
      >
        mdi-floppy

      </v-icon>
    </v-btn>
    <v-snackbar
      v-model="snackbar"
    >
      Profil modifié avec succès

      <template v-slot:action="{ attrs }">
        <v-btn
          color="blue"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
      </v-card-actions>
          </v-card-text>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
             <v-card-text  style="width:65%;">
                        <h4  class="text-center warning--text " style="font-size:20px!important">
                           Mettre à jour votre Mot de passe {{ name}}
                        </h4>
                        
                         <v-text-field
                        
                            id="password"
                            label="Mot de passe actuel"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="old_password"
                            :rules="Rules"
                          />
                            <v-row no-gutters>
                           <v-col
                              cols="6"
                              md="6"
                            >
                         <v-text-field
                           :disabled="edit"
                            id="password"
                            label="Nouveau mot de passe*"
                            name="password"
                            prepend-icon="password"
                            type="password"
                            v-model="password"
                            :rules="Rules"
                          />
                           </v-col> 
                           <v-col
                             cols="6"
                              md="6"
                          >
                         <v-text-field
                           :disabled="edit"
                            id="password"
                            label="Confirmer mot de passe*"
                            name="password"
                            prepend-icon="password"
                            type="password"
                            v-model="password_confirm"
                            :rules="Rules"
                          />
                           </v-col>
                          </v-row>
                       <v-card-actions style="margin-top:-2%">
          <v-spacer></v-spacer>
        <template v-if="edit" >
                <v-btn
            color="warning"
            class="ma-2 white--text"
              @click="innabled"
              >
      <v-icon
        
        dark
      >
        mdi-pencil
      </v-icon>
    </v-btn>
    </template>
        <v-btn
        v-else
      color="success"
      class="ma-2 white--text"
         @click="changePass"
    >
      <v-icon
        
        dark
      >
        mdi-floppy
      </v-icon>
    </v-btn>
    <v-snackbar
      v-model="snackbar"
    >
      Mot De Passe modifié avec succès

      <template v-slot:action="{ attrs }">
        <v-btn
          color="blue"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
                       </v-card-actions>    
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
                  
      </v-card>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "Profile",
  data: () => ({
          snackbar: false,
     spinner:false,
//        imagePreview: null,
// showPreview: false,
    load:true,
          Poste:['Directeur','Technicien','Ingenieur'],
          edit:true,
    id:"",
    dialog: false,
    name: "",
    email: "",
    // image: "",
    type: "",
    password: "",
    old_password: "",
    password_confirm: "",
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
    // current_password() {
    //   console.log(this.user.password);
    //   return this.password;

    // },
  },
 async mounted() {
  //  const response = await axios.get("user");
  //   this.$store.dispatch("user", response.data);
  //   this.user = response.data;
console.log(this.user);
   axios.get('/user/'+this.user.id).then((response) => {
    this.$store.dispatch("user", this.user.id);
     this.user = response.data;
    
        this.email = response.data.email;
        this.password = response.data.password;
        this.name = response.data.name; 
        this.poste = response.data.poste; 
        this.numero = response.data.numero; 
        // this.image = response.data.image; 
        this.user.email = this.email;
        this.user.password = this.password;
        this.user.name = this.name; 
        this.user.poste = this.poste; 
        this.user.numero = this.numero; 
        // this.user.image = this.image; 
         })

  },
   methods: {
    innabled() {
  this.edit = !this.edit
},
async changePass() {
      const response = await axios.put("user/changepass/"+this.user.id, {
        old_password: this.old_password,
        password: this.password,
        password_confirm: this.password_confirm,
      });
      
        this.snackbar = true
            console.log(response);

},
      // onFileChange(e){
      //  this.files.push(file);
        // const files=e.target.files;
      // let  reader=new FileReader();
      //   reader.onload=(e)=> this.formFields.image.push(e.target.result);
      //   reader.readAsDataURL(file);
    // this.formFields.image = event.target.files[0];
      //  console.log(e.target.files);
      // this.user.image = event.target.files[0];
    
    // let reader  = new FileReader();
// // 
//     reader.addEventListener("load", function () {
//         this.showPreview = true;
//         this.imagePreview = reader.result;
//     }.bind(this), false);
    // if( this.user.image ){
    //     if ( /\.(jpe?g|png|gif)$/i.test( this.user.image.name ) ) {
    //         reader.readAsDataURL( this.user.image );
    //     }
    // }
// },
    update() {
    //    let formData = new FormData();

    // formData.append("image", this.user.image);
    // formData.append("email", this.user.email);
    // formData.append("name", this.user.name);
    // formData.append("password", this.user.password);
    // formData.append("poste", this.user.poste);
    // formData.append("numero", this.user.numero);
    
    let user = {
        email: this.user.email,
        name: this.user.name,
        password: this.user.password,
        poste: this.user.poste,
        numero: this.user.numero,
      }
        // email: this.user.email,
        // name: this.user.name,
        // password: this.user.password,
        // poste: this.user.poste,
        // numero: this.user.numero,
      
      this.spinner=true,
      axios.put('/user/updateprofile/'+this.user.id, user,{ headers: { token: localStorage.getItem('token')}})
      .then(
        (response) => (this.id = response.data.id),
        this.spinner=false,
        this.snackbar = true
      );
  },
   close() {
      this.dialog = false;
    },
  }
};
</script>
<style scoped>
img[data-v-299e74d5] {
    /* width: 90px; */
    margin-left: 0%;
    margin-top:0%;
}
.col {
    flex-basis: 0;
    /* flex-grow: 1; */
    max-width: 100%;
}
</style>