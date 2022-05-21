<template>
  <div>
    
    <!-- <NavDash/> -->
    <Loading v-if="spinner"/>
    <v-tabs
      v-model="tab"
      background-color="transparent"
      grow
    >
      <v-tab
        v-for="itemtab in itemstab"
        :key="itemtab"
      >
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
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
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
                <v-container>
                  <v-col>
                    <v-row cols="12" sm="6" md="4">
                     <v-col cols="6"> <v-text-field
                        v-model="editedItem.name"
                        label="Nom"
                      ></v-text-field></v-col>
                      <v-col cols="6">
                         <v-text-field
                        v-model="editedItem.email"
                        label="Email"
                      ></v-text-field>
                      </v-col>
                    </v-row>
                    <v-row cols="12" sm="6" md="4">
                      <v-col  cols="6" md="4"> 
                          <v-select
                        :items="types"
                        label="Type"
                        name="type"
                            type="text"
                            v-model="editedItem.type" 
                        
                      ></v-select>
                        </v-col>
                    
                            <v-col  cols="6" md="4">  <v-text-field
                        v-model="editedItem.poste"
                        label="poste"
                      ></v-text-field></v-col>
                            <v-col  cols="6" md="4"> <v-text-field
                        v-model="editedItem.numero"
                        label="numero"
                      ></v-text-field></v-col>
                    </v-row>
                    <v-row cols="12" sm="6" md="4">
                    
                    </v-row>
                    <v-row cols="12" sm="6" md="4">
                     
                    </v-row>
                    <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.password"
                        label="Mot de passe"
                      ></v-text-field>
                    </v-row>
                  
                    
                  </v-col>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">
                  Cancel
                </v-btn>
                <v-btn color="blue darken-1" text @click="save">
                  Save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          
       
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <!-- <v-icon small color="green" class="mr-2" @click="editItem(item)">
          mdi-pencil
        </v-icon> -->
    <v-btn
      class="mx-2"
      fab
      dark
      small
      color="primary"
    >
      <v-icon dark v-on:click="editItem(item)">
        mdi-pencil
      </v-icon>
    </v-btn>
            <v-btn
      class="mx-2"
      fab
      dark
      small
      color="red"
    >
      <v-icon dark v-on:click="deleteutilisateur(item.id)" :disabled="disable">
        mdi-delete
      </v-icon>
    </v-btn>
               <!-- <v-icon small color="red" @click="deleteutilisateur(item.id)"> mdi-delete </v-icon> -->

      </template>

     
    </v-data-table>
        </v-card>
        </v-tab-item>
        <v-tab-item>
        <v-card
          flat
        >
         <demande/>
        </v-card>

      </v-tab-item>
        <v-tab-item>
        <v-card
          flat
        >
         <Inactive/>
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
import Swal from "sweetalert2/dist/sweetalert2.js";
// import NavDash from "../NavDashboard.vue";
import demande from "../user/demande.vue";
import Inactive from "../user/userInactive.vue";
import Loading from "@/components/Loading.vue";
import axios from "axios";
export default {
   components: {
    // NavDash,
    demande,
    Loading,
    Inactive
  },
  data: () => ({
    spinner:true,
    disable:false,
    types:['employe','admin','En Attente'],
    tab: null,
        itemstab: [
          'Utilisateur', 'Demande Inscription','Utilisateur Inactive'
        ],
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "Name", value: "name" },
      { text: "Email", value: "email" },
      { text: "Type", value: "type" },
      { text: "Poste", value: "poste" },
      { text: "Numero", value: "numero" },
      { text: "Operation", value: "actions" , sortable: false},
     
    ],
    userloc:'',
    users: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: "",
      type: "",
      poste: "",
      numero: "",
      password:""
    },
    defaultItem: {
      name: "",
      email: "",
      type: "",
      poste: "",
      numero: "",
      password:""

    },
  }),
     async created() {
    //      let user =  JSON.stringify(localStorage.getItem('user'));
    //      console.log(user.email);
    //      this.disable=false;
    // if (user) {
    //    this.disable=true;
    // }
    
      const response=await axios.get('user');
    this.$store.dispatch('user',response.data);
    
    let vm=this;
    vm.disable=false;
  let user=response.data;

    if(user){
       console.log(user);
      vm.disable=false;
    }
    else{
      vm.disable=true
    }
    this.getuser();
  },
  
  
  computed: {  // if(response.status===200){
  //   vm.disable=true;
  // }
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
 
  methods: {
  
     async  getuser() {
    await axios.get("/users/get").then((resp) => {
        this.users = resp.data;
        this.spinner=false;
        // console.log(resp.data);
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
        console.log('edit');
        axios.put("/user/update/"+this.editedItem.id, this.editedItem).then(
          (response) => (this.id = response.data.id)
        );
      } else {
        this.users.push(this.editedItem);
     axios
        .post("/user/create",this.editedItem , {
          headers: { token: localStorage.getItem("token") },
        })
        .then(() => {console.log(this.editedItem);
         this.dialog = false;
      this.editedItem = Object.assign({}, this.defaultItem);
      this.getuser();
});      }
      this.close();
    },
    
  //     updateUser(id) {
  //    axios.put("user/update/" + id).then(() => {
  //           this.getuser();
  //         });
  // },
 

 async mounted() {
   
    // console.log(JSON.stringify(localStorage.getItem("user")));
    //  let userloc = localStorage.getItem("user");
    // if (userloc) {
    //    this.disable=true;
    // }
  // const response=await axios.get('user');
  //   this.$store.dispatch('user',response.data);
  //     this.userloc=response.data;
  //   if (userloc) {
  //      this.disable=true;
  //   }

     
  },
}}
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