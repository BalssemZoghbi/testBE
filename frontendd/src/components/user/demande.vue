<template>
  <div>
    <Loading/>
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
        <v-btn class="ma-2" color="primary" dark>
          Accepter
          <v-progress-circular
      :width="3"
      color="white"
      indeterminate
      v-if="snackbar"
    ></v-progress-circular>
          <v-icon dark right @click="accept(item.id)">
            mdi-checkbox-marked-circle
          </v-icon>
        </v-btn>
        <v-btn class="ma-2" color="red" dark>
          Refuser
           <v-progress-circular
      :width="3"
      color="white"
      indeterminate
      v-if="!snackbar"
    ></v-progress-circular>
          <v-icon dark right @click="decline(item.id)">
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
      });
    },
    async accept(id) {
      console.log(id);
      await axios.put("/user/accept/" + id).then(() => {
        this.getuser();
      });
      this.snackbar=true;
    },
    async decline(id) {
      console.log(id);
      await axios.delete("/user/decline/" + id).then(() => {
        this.getuser();
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