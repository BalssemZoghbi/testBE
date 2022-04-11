<template>
  <div>
    <NavDash />
    <v-data-table
      :headers="headers"
      :items="gar24"
      sort-by="calories"
      class="elevation-1"
      :search="search"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-card-title>Garantie24 </v-card-title>
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
                    <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.pn"
                        label="Pn"
                      ></v-text-field>
                    </v-row>
                 
                    <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.po"
                        label="Po"
                      ></v-text-field>
                    </v-row>
                    <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.lo"
                        label="lo"
                      ></v-text-field>
                    </v-row>
                     <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.pcc"
                        label="Pcc"
                      ></v-text-field>
                    </v-row>
                 
                    <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.ucc"
                        label="Ucc"
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
                <v-btn color="blue darken-1" text @click="addgar">
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
          </v-dialog>  -->
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]={item}>
        <v-icon small color="green" class="mr-2" @click="updategar(item)">
          mdi-pencil
        </v-icon>
        
        
               <v-icon small color="red" @click="deletegar(item.id)"> mdi-delete </v-icon>

      </template>

     
    </v-data-table>
  </div>
</template>

<script>
import Swal from "sweetalert2/dist/sweetalert2.js";
import NavDash from "../components/NavDash.vue";
import axios from "axios";
export default {
   components: {
    NavDash,
  },
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "Pn", value: "pn" },
      { text: "Po", value: "po" },
      { text: "lo", value: "lo" },
        { text: "Pcc", value: "pcc" },
      { text: "Ucc", value: "ucc" },
      { text: "Operation", value: "actions" , sortable: false},
     
    ],
    gar24: [],
    editedIndex: -1,
    editedItem: {
      pn: "",
      po: "",
      lo: "",
      pcc:"",
      ucc:"",
    },
    defaultItem: {
      pn: "",
      po: "",
      lo: "",
      pcc:"",
      ucc:"",
    },
  }),
     created() {
        this.get24();
  },
  methods:{
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
          Swal.fire("Supprimé!", "la colonne a été supprimé", "success");
          axios.delete("/garantie24/delete/" + id).then(() => {
            this.get24();
          });
        }
      });
    },
     async  get24() {
    await axios.get("/garantie24").then((resp) => {
        this.gar24 = resp.data;
        console.log(resp.data);
      });
    },
 async addgar(){
   await axios.post("/create24", this.editedItem).then(() => {
      this.dialog = false;
      this.editedItem = Object.assign({}, this.defaultItem);
    });
  },
  // updategar(item) {
  //   axios.put("/update24/" + item.id, this.editedItem).then(
  //       (response) => (this.id = response.item.id));
  // },
  },

}
  

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