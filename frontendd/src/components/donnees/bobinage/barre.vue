<template>
  <div>
    <!-- <NavDash /> -->
    <v-data-table
      :headers="headers"
      :items="gar36"
      sort-by="calories"
      class="elevation-1"
      :search="search"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-card-title>Barres</v-card-title>
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
                Ajouter 
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
                  <!-- <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.designation"
                        label="Designation"
                      ></v-text-field>
                    </v-row> -->
                    <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.largeur"
                        label="Largeur"
                      ></v-text-field>
                    </v-row>
                  <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.epaisseur"
                        label="Epaisseur"
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
          
          <!-- <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5"
                >Are you sure you want to delete this user?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDelete"
                  >Cancel</v-btn
                >
                <v-btn color="red darken-1" text @click="deleteItemConfirm"
                  >OK</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog> -->
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small color="green" class="mr-2" @click="editItem(item)">
          mdi-pencil
        </v-icon>
               <v-icon small color="red" @click="deletegar(item.id)"> mdi-delete </v-icon>

      </template>

     
    </v-data-table>
  </div>
</template>

<script>
import Swal from "sweetalert2/dist/sweetalert2.js";
// import NavDash from "@/components/NavDash.vue";
import axios from "axios";
export default {
   components: {
    // NavDash,
  },
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
{ text: "Designation", value: "designation" },
{ text: "Epaisseur", value: "epaisseur" },
{ text: "Largeur", value: "largeur" },
      { text: "Operation", value: "actions" , sortable: false},
     
    ],
    gar36: [],
    editedIndex: -1,
    editedItem: {
    //   designation: "",
      largeur: "",
      epaisseur: "",
    },
    defaultItem: {
    // designation: "",
      largeur: "",
      epaisseur: "",
    },
  }),
    async created() {
    this.get36();
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Ajouter "
        : "Editer ";
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
  
     async get36() {
    await axios.get("/getBarre").then((resp) => {
        this.gar36 = resp.data;
        // console.log(resp.data);
      });
    },
         deletegar(id) {
      Swal.fire({
        title: "Supprimer",
        text: "Vous êtes sure de supprimer ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Supprimer",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire("Supprimé!", "Cette colonne a été supprimé", "success");
          axios.delete("/deleteBarre/" + id).then(() => {
            this.get36();
          });
        }
      });
    },
    editItem(item) {
      this.editedIndex = this.gar36.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
      //     update() {
      // let user = {
      //   email: this.editedItem.email,
      //   type: this.editedItem.type,
      //   name: this.editedItem.name,
      //   password: this.password,
      // }
      // axios.put('/user/update/'+item.id, user,{ headers: { token: localStorage.getItem('token')}})
      //   .then(res => {
      //     //if successfull
      //     if (res.status === 200) {
      //       localStorage.setItem('token', res.data.token);
      //       console.log(res)
            
      //     }
      //   }, err => {
      //     console.log(err.response);
      //     this.error = err.response.data.error
      //   })
    
    //    axios.put("/user/update/"+this.id, gar36).then(
    //     (response) => (this.id = response.data.id)
    // );
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
        Object.assign(this.gar36[this.editedIndex], this.editedItem);
        console.log('edit');
      axios.put("/updateBarre/"+this.editedItem.id, this.editedItem).then(
          (response) => (this.id = response.data.id)
        );
      } else {
        this.gar36.push(this.editedItem);
         axios.post("/createBarre", this.editedItem).then(
          (response) => (this.id = response.data.id,
          console.log(response.data))
        );
   }
      this.close();
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