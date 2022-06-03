<template>
  <div>
    <Loading v-if="load"/>
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
         
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <!-- <template v-if="user.id == item.user.id" > -->
           <v-btn
      :loading="spinner"
      :disabled="spinner"
      color="blue"
      class="ma-2 white--text"
      @click="accept(item.id)"
    >
      Accepter
      <v-icon
        right
        dark
      >
        mdi-checkbox-marked-circle
      </v-icon>
    </v-btn>
    <!-- </template> -->
        <!-- <v-btn class="ma-2" color="primary" v-if="!spinner"  dark>
          Accepter
          <v-icon dark right @click="accept(item.id)">
            mdi-checkbox-marked-circle
          </v-icon>
        </v-btn> -->
        <!-- <v-btn class="ma-2" color="primary"  v-if="spinner"  dark>
          Accepter
           <v-progress-circular
      color="white"
      indeterminate
     
    ></v-progress-circular>
        </v-btn> -->
        <!-- <v-btn class="ma-2" color="red" v-if="!spinnerDecline" dark>
          Refuser
          <v-icon dark right @click="decline(item.id)">
            mdi-cancel
          </v-icon>
        </v-btn>
        <v-btn class="ma-2" color="red" v-if="spinnerDecline" dark>
          Refuser
           <v-progress-circular
      color="white"
      indeterminate
      
    ></v-progress-circular>
        </v-btn> -->
                  <v-btn
      :loading="spinnerDecline"
      :disabled="spinnerDecline"
      color="red"
      class="ma-2 white--text"
      @click="decline(item.id)"
    >
      Refuser
      <v-icon
        right
        dark
      >
        mdi-cancel
      </v-icon>
    </v-btn>
        <v-snackbar v-model="snackbarDecline">
          {{ textDecline }}

          <template v-slot:action="{ attrs }">
            <v-btn color="blue" text v-bind="attrs" @click="snackbarDecline = false">
              Fermer
            </v-btn>
          </template>
        </v-snackbar>
        <v-snackbar v-model="snackbar">
          {{ text }}

          <template v-slot:action="{ attrs }">
            <v-btn color="blue" text v-bind="attrs" @click="snackbar = false">
              Fermer
            </v-btn>
          </template>
        </v-snackbar>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import axios from "axios";
import Loading from "@/components/Loading.vue";
export default {
  components: {
    Loading,
  },
  data: () => ({
    spinner:false,
    load:true,
    spinnerDecline:false,
    snackbar: false,
    text: `L'utilisateur a été accepté`,
    snackbarDecline: false,
    textDecline: `L'utilisateur a été refusé`,
    model: "tab-2",
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "Name", value: "name" },
      { text: "Email", value: "email" },
      { text: "Type", value: "type" },
      { text: "Poste", value: "poste" },
      { text: "Numero", value: "numero" },
      { text: "Operation", value: "actions", sortable: false },
    ],
    users: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: "",
      type: "",
      poste: "",
      numero: "",
    },
    defaultItem: {
      name: "",
      email: "",
      type: "",
      poste: "",
      numero: "",
    },
  }),
  created() {
    this.getuser();
  },
   
  methods: {
     async getuser() {
      await axios.get("/users/p").then((resp) => {
        this.users = resp.data;
        this.load = false;
      });
    },
    async accept(id) {
      // console.log(id);
       this.spinner=true,
      await axios.put("/user/accept/" + id).then(() => {
        this.getuser()
          this.spinner=false;
      });
      this.snackbar=true;
    },
    async decline(id) {
       this.spinnerDecline=true,
      console.log(id);
      await axios.delete("/user/decline/" + id).then(() => {
        this.getuser(),  
          this.spinnerDecline=false;
      });
      this.snackbarDecline=true;
    },
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