<template>
  <div>
    <Loading v-if="spinner" />
    <v-tabs v-model="tab" background-color="transparent" grow>
      <v-tab v-for="itemtab in itemstab" :key="itemtab">
        {{ itemtab }}
      </v-tab>
    </v-tabs>

    <v-tabs-items v-model="tab">
      <v-tab-item>
        <v-card flat>
          <v-data-table
            :headers="headers"
            :items="users"
            sort-by="calories"
            class="elevation-1"
            :search="search"
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-card-title>Utilisateur</v-card-title>
                <v-spacer></v-spacer>
                <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="Search"
                  single-line
                  hide-details
                >
                </v-text-field>

                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="700px">
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      color="primary"
                      dark
                      class="mb-2"
                      v-bind="attrs"
                      v-on="on"
                    >
                      Ajouter utilisateur
                    </v-btn>
                  </template>
                  <v-card>
                    <v-card-title>
                      <span class="text-h5">
                        {{ formTitle }}
                      </span>
                    </v-card-title>

                    <v-card-text>
                      
                        <v-form>
                               <v-row no-gutters>
                           <v-col
                              cols="6"
                              md="6"
                            >
                          <v-text-field
                            label="Nom"
                            name="Name"
                            prepend-icon="person"
                            type="text"
                            v-model="editedItem.name"
                             required
                          />  </v-col> 
                           <v-col
                             cols="6"
                              md="6"
                          > 
                            <v-select
                                :items="types"
                                label="Type"
                                name="type"
                                type="text"
                            prepend-icon="person"
                                v-model="editedItem.type"
                              ></v-select>
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
                            v-model="editedItem.poste" 
                        
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
                            v-model="editedItem.numero" 
                          />
                          </v-form> </v-col>
                          </v-row>
                           <v-text-field
                            label="email*"
                            name="email"
                            prepend-icon="email"
                            type="text"
                             v-model="editedItem.email"
                          /> 
                             <v-text-field
                            id="password"
                            label="Mot de passe*"
                            name="password"
                            prepend-icon="lock"
                            type="password"
                            v-model="editedItem.password"
                          />
                            <template :disabled="isimage">
                           <v-file-input
                            truncate-length="15"
                            
                            @change="onFileChange"
                            label="Image*"
                          ></v-file-input>
                            </template>
                          <!-- <img v-bind:src="'../../../../backend/public/public/Image/'+imagePreview" v-show="showPreview" width="100" height="100" />  -->

                        </v-form>
                      </v-card-text>
                      <div class="text-center mt-n5">
                        
                      </div>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="close">
                        Annuler
                      </v-btn>
                      <v-btn color="blue darken-1" text @click="save">
                        Sauvegarder
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-toolbar>
            </template>
            <template v-slot:[`item.actions`]="{ item }">
              <v-btn class="mx-2" fab dark small color="primary">
                <v-icon dark v-on:click="editItem(item)"> mdi-pencil </v-icon>
              </v-btn>
              <template v-if="$store.getters.user.email != item.email" :disabled="isdisable">
              <v-btn  class="mx-2" fab dark small color="red">
                <v-icon dark v-on:click="deleteutilisateur(item.id)">
                  mdi-delete
                </v-icon>
              </v-btn>
              </template>
        </template>
          </v-data-table>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <demande />
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <Inactive />
        </v-card>
      </v-tab-item>
    </v-tabs-items>
    <!-- <v-tabs center-active style="margin-left: 33%;">
    <v-tab>Utilisateurs</v-tab>
    <v-tab><router-link class="nav-link" to="/demande"  style="text-decoration:none;">Demande d'inscription</router-link></v-tab>
  </v-tabs> -->
  </div>
</template>

<script>
import "@/store/index";
import Swal from "sweetalert2/dist/sweetalert2.js";
import demande from "../user/demande.vue";
import Inactive from "../user/userInactive.vue";
import Loading from "@/components/Loading.vue";
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  components: {
    demande,
    Loading,
    Inactive,
  },
  data: () => ({
    spinner: true,
    isdisable: true,
    isimage: false,
    // disabled: 0,
    types: ["employe", "admin", "En Attente"],
    Poste: ["Directeur", "Technicien", "Ingenieur"],
    tab: null,
    itemstab: ["Utilisateur", "Demande Inscription", "Utilisateur Inactive"],
    search: "",
    dialog: false,
    imagePreview: null,
    showPreview: false,
    dialogDelete: false,
    headers: [
      { text: "Name", value: "name" },
      { text: "Email", value: "email" },
      { text: "Type", value: "type" },
      { text: "Poste", value: "poste" },
      { text: "Numero", value: "numero" },
      { text: "Operation", value: "actions", sortable: false },
    ],
    userloc: "",
    // users: [],
    userslist: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: "",
      type: "",
      poste: "",
      numero: "",
      image: "",
      password: "",
    },
    defaultItem: {
      name: "",
      email: "",
      type: "",
      poste: "",
      numero: "",
      image: "",
      password: "",
    },
  }),
  async created() {
   await this.getuser();
   
  },
   computed: {
    users(){
      return this.userslist;
    },
    ...mapGetters(["user"]),
    formTitle() {
      return this.editedIndex === -1
        ? "Ajouter un nouveau utilisateur"
        : "Editer utilisateur";
    },
  
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
 mounted(){
console.log("balsseemm", this.$store.getters.user.email);
},

  methods: {
     onFileChange(e){
      this.editedItem.image = event.target.files[0];
      console.log(e.target.files);
    let reader  = new FileReader();
    // reader.addEventListener("load", function () {
        this.showPreview = true;
        this.imagePreview = reader.result;
    // }.bind(this), false);
    if( this.editedItem.image ){
        if ( /\.(jpe?g|png|gif)$/i.test( this.editedItem.image.name ) ) {
            reader.readAsDataURL( this.editedItem.image );
        }
    }
},
    

   getuser() {
    axios.get("/users/get").then((response) => {
         this.userslist=response.data;
                console.log("users",this.userslist);
                this.spinner = false;
            });
        },
    deleteutilisateur(id) {
      Swal.fire({
        title: "Supprimer",
        text: "Vous êtes sure de supprimer cette utilisateur?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Supprimer",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire("Supprimé!", "Cette utilisateur a été supprimé", "success");
          axios.delete("user/delete/" + id).then(() => {
            this.getuser();
          });
        }
      });
    },
    editItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
         
      if (this.editedIndex > -1) {
        Object.assign(this.users[this.editedIndex], this.editedItem);
        console.log("edit");
        
    // let user = {
    //     email: this.user.email,
    //     name: this.user.name,
    //     password: this.user.password,
    //     poste: this.user.poste,
    //     numero: this.user.numero,
    //   }
      this.isimage=false;
     
        let user = {
        email: this.editedItem.email,
        name: this.editedItem.name,
        password: this.editedItem.password,
        poste: this.editedItem.poste,
        type: this.editedItem.type,
        numero: this.editedItem.numero,
      }
    //         let formData = new FormData();

    // formData.append("image", this.editedItem.image);
    // formData.append("email", this.editedItem.email);
    // formData.append("name", this.editedItem.name);
    // formData.append("password", this.editedItem.password);
    // formData.append("poste", this.editedItem.poste);
    // formData.append("type", this.editedItem.type);
    // formData.append("numero", this.editedItem.numero);
    
        axios
          .put("/user/update/" + this.editedItem.id, user)
          .then((response) => (this.id = response.data.id));
      } else {
         this.isimage=true;
        this.users.push(this.editedItem);
      let formData = new FormData();

    formData.append("image", this.editedItem.image);
    formData.append("email", this.editedItem.email);
    formData.append("name", this.editedItem.name);
    formData.append("password", this.editedItem.password);
    formData.append("poste", this.editedItem.poste);
    formData.append("type", this.editedItem.type);
    formData.append("numero", this.editedItem.numero);
        axios
          .post("/user/create", formData, {
            headers: { token: localStorage.getItem("token") },
          })
          .then(() => {
            console.log(this.editedItem);
            this.dialog = false;
            this.editedItem = Object.assign({}, this.defaultItem);
            this.getuser();
          });
      }
      this.close();
    },

    //     updateUser(id) {
    //    axios.put("user/update/" + id).then(() => {
    //           this.getuser();
    //         });
    // },

 
  },
};
</script>
<style scoped>
.v-data-table {
  /* line-height: 1.5; */
  max-width: 1800px;
  margin: 3%;
}
.theme--light.v-icon {
  color: #2196f3;
}
</style>
