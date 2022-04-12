<template>
  <div>
    <NavDash />
    <v-data-table
      :headers="headers"
      :items="users"
      sort-by="calories"
      class="elevation-1"
      :search="search"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-card-title>Demande </v-card-title>
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
          <!-- <v-dialog v-model="dialog" max-width="700px">
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
                      <v-text-field
                        v-model="editedItem.name"
                        label="Name"
                      ></v-text-field>
                    </v-row>
                 
                    <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.email"
                        label="Email"
                      ></v-text-field>
                    </v-row>
                    <v-row cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.type"
                        label="type"
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
                <v-btn color="blue darken-1" text @click="addUser">
                  Save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog> -->
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
      <template v-slot:[`item.actions`]="{item}">
         <v-btn
        class="ma-2"
        color="primary"
        dark
      >
        Accept
        <v-icon
          dark
          right
          v-on:click="accept(item.id)"
        >
          mdi-checkbox-marked-circle
        </v-icon>
      </v-btn>
        <!-- <v-icon small color="green" class="mr-2" v-on:click="accept(item.id)">
          mdi-pencil
        </v-icon> -->
         <v-btn
        class="ma-2"
        color="red"
        dark
        
      >
        Decline
        <v-icon
          dark
          right
          v-on:click="decline(item.id)" 
        >
          mdi-cancel
        </v-icon>
      </v-btn>
               <!-- <v-icon small color="red" v-on:click="decline(item.id)" > mdi-delete </v-icon> -->

      </template>

     
    </v-data-table>
  </div>
</template>

<script>
// import Swal from "sweetalert2/dist/sweetalert2.js";
import NavDash from "../NavDash.vue";
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
      { text: "Name", value: "name" },
      { text: "Email", value: "email" },
      { text: "Type", value: "type" },
      { text: "Operation", value: "actions" , sortable: false},
     
    ],
    users: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: "",
      type: "",
    },
    defaultItem: {
      name: "",
      email: "",
      type: "",
    },
  }),
     created() {
       this.getuser();
  },
  methods:{
 async accept(id){
  console.log(id);
   await axios.put("/user/accept/"+id).then(() => {
}
);
},
async decline(id){
    console.log(id);
  await axios.delete("/user/decline/"+id).then(() => {
        console.log('declined');
}
);
},
async getuser(){
  await axios.get("/users/p").then((resp) => {
        this.users = resp.data;
}
);
},
  
  mounted() {
    this.accept();
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