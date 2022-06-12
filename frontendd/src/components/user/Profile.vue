<template>
       <v-card class="mx-auto ml-2" height="100%" tile>

       <v-card class="mx-auto ml-2 mr-2" max-width="100%"  style=" top: 20px" tile>
          <v-img height="180px" src="../../assets/pres2.jpg"></v-img>
          <v-col>
            <!-- <v-avatar size="100" style="position:absolute; top: 240px">
              <v-img src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg"></v-img>
            </v-avatar> -->
            <v-avatar color="primary" size="90" style="position:absolute; top: 130px;margin-left:41%">
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
               <v-text style="margin-left:-9%;text-align:center"> <v-icon>fa fa-user-tie</v-icon> {{  user.type  }}</v-text>

              </v-list-item-content>
            </v-list-item>
             </v-card>
           <br>
            <v-card class="mx-auto ml-2 mr-14">
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
                                             <v-file-input
                            truncate-length="15"
                            
                            @change="onFileChange"
                            label="Image*"
                          ></v-file-input>
                          <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/> 
                            
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
          <v-btn
      color="warning"
      class="ma-2 white--text"
     :loading="spinner"
      :disabled="spinner"
         @click="update"
    >
      <v-icon
        right
        dark
      >
        mdi-pencil
      </v-icon>
    </v-btn>
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
                            label="Mot de passe*"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="user.password"
                            :rules="Rules"
                          />
                       <v-card-actions style="margin-top:-2%">
          <v-spacer></v-spacer>
          <v-btn
      color="warning"
      class="ma-2 white--text"
     :loading="spinner"
      :disabled="spinner"
         @click="update"
    >
      
      <v-icon
        right
        dark
      
      >
        mdi-pencil
      </v-icon>
    </v-btn>
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
     spinner:false,
       imagePreview: null,
showPreview: false,
    load:true,
          Poste:['Directeur','Technicien','Ingenieur'],
    id:"",
    dialog: false,
    name: "",
    email: "",
    image: "",
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
        this.image = response.data.image; 
        this.user.email = this.email;
        this.user.password = this.password;
        this.user.name = this.name; 
        this.user.poste = this.poste; 
        this.user.numero = this.numero; 
        this.user.image = this.image; 
         })

  },
   methods: {
      onFileChange(e){
      //  this.files.push(file);
        // const files=e.target.files;
      // let  reader=new FileReader();
      //   reader.onload=(e)=> this.formFields.image.push(e.target.result);
      //   reader.readAsDataURL(file);
    // this.formFields.image = event.target.files[0];
       console.log(e.target.files);
      this.user.image = event.target.files[0];
    /*
    Initialize a File Reader object
    */
    let reader  = new FileReader();
// 
    /*
    Add an event listener to the reader that when the file
    has been loaded, we flag the show preview as true and set the
    image to be what was read from the reader.
    */
    reader.addEventListener("load", function () {
        this.showPreview = true;
        this.imagePreview = reader.result;
    }.bind(this), false);

    /*
    Check to see if the file is not empty.
    */
    if( this.user.image ){
        /*
            Ensure the file is an image file.
        */
        if ( /\.(jpe?g|png|gif)$/i.test( this.user.image.name ) ) {

       
            /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
            reader.readAsDataURL( this.user.image );
        }
    }
},
    update() {
       let formData = new FormData();

    formData.append("image", this.user.image);
    formData.append("email", this.user.email);
    formData.append("name", this.user.name);
    formData.append("password", this.user.password);
    formData.append("poste", this.user.poste);
    formData.append("numero", this.user.numero);
    
        // email: this.user.email,
        // name: this.user.name,
        // password: this.user.password,
        // poste: this.user.poste,
        // numero: this.user.numero,
      
      this.spinner=true,
      axios.put('/user/updateprofile/'+this.user.id, formData,{ headers: { token: localStorage.getItem('token')}})
      .then(
        (response) => (this.id = response.data.id),
        this.spinner=false,
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