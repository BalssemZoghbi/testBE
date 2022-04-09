<template>
  <div>
    <NavDash />
    <v-data-table
      :headers="headers"
      :items="desserts"
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
                  <!-- {{ formTitle }} -->
                  </span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.name"
                        label="Name"
                      ></v-text-field>
                    </v-col>
                 
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.email"
                        label="Email"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.logo"
                        label="logo"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.phone"
                        label="phone"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.fax"
                        label="fax"
                      ></v-text-field>
                    </v-col>
                    
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.codeGAnalytics"
                        label="Code G-Analytics"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">
                  Cancel
                </v-btn>
                <v-btn color="blue darken-1" text @click="addSite">
                  Save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
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
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small color="green" class="mr-2" @click="editItem(item)">
          mdi-pencil
        </v-icon>
        <v-icon small color="red" @click="deleteItem(item)">
          mdi-delete
        </v-icon>
      </template>

      <template v-slot:no-data>
        <v-btn color="primary" @load="initialize"> Reset </v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import NavDash from "../components/NavDash.vue";
// import axios from "axios";
export default {
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "name", value: "name" },
      { text: "email", value: "email" },
      { text: "logo", value: "logo" },
      { text: "phone", value: "phone" },
      { text: "fax", value: "fax" },
      { text: "Etat", value: "etat" },
      { text: "", value: "actions", sortable: false },
    ],
    desserts: [{ date: "" }, { codeGAnalytics: "" }],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: "",
      logo: "",
      phone: "",
      fax: "",
      etat: false,
      date: "",
      codeGAnalytics: "",
    },
    defaultItem: {
      name: "",
      url: "",
      email: "",
      logo: "",
      phone: "",
      fax: "",
      etat: false,
      date: "",
      codeGAnalytics: "",
    },
  }),
  computed: {
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
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      this.desserts = [
        /* {
          title: this.data.title,
          url: this.data.url,
          logo: this.data.logo,
          email: this.data.email,
          phone: this.data.phone,
          fax: this.data.fax,
          etat: this.data.etat,
        }, */
      ];
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1);
      this.closeDelete();
    },
    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    },
//     addSite() {
//       axios
//         .post("http://localhost:5000/api/sites/addSite",this.editedItem , {
//           headers: { token: localStorage.getItem("token") },
//         })
//         .then(() => {console.log(this.editedItem);
// });
//     },
  },
  components: {
    NavDash,
  },

  // mounted() {
  //   axios.get("http://localhost:5000/api/sites/sites").then((res) => {
  //     this.desserts = res.data.sites;
  //     console.log(this.desserts);
  //   });
  //   axios.post("http://localhost:5000/api/sites/addSite").then((res) => {
  //     this.desserts = res.data.sites;
  //     console.log(this.desserts);
  //   });
  // },
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