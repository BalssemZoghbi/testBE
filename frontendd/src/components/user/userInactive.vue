<template>
  <div>
    <Loading v-if="spinner" />
    <v-data-table
      :headers="headers"
      :items="users"
      sort-by="calories"
      class="elevation-1"
      :search="search"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-card-title>Utilisateurs Inactives</v-card-title>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Recherche"
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
                      <v-col cols="6">
                        <v-text-field
                          v-model="editedItem.name"
                          label="Nom"
                        ></v-text-field
                      ></v-col>
                      <v-col cols="6">
                        <v-text-field
                          v-model="editedItem.email"
                          label="Email"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                    <v-row cols="12" sm="6" md="4">
                      <v-col cols="6" md="4">
                        <v-select
                          :items="types"
                          label="Type"
                          name="type"
                          type="text"
                          v-model="editedItem.type"
                        ></v-select>
                      </v-col>

                      <v-col cols="6" md="4">
                        <v-select
                          :items="Poste"
                          label="Poste"
                          name="poste"
                          type="text"
                          v-model="editedItem.poste"
                        ></v-select
                      ></v-col>
                      <v-col cols="6" md="4">
                        <v-text-field
                          v-model="editedItem.numero"
                          label="numero"
                        ></v-text-field
                      ></v-col>
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
                  Anuuler
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
        <v-btn class="mx-2" fab dark small color="red">
          <v-icon dark v-on:click="deleteutilisateur(item.id)">
            mdi-delete
          </v-icon>
        </v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import Swal from "sweetalert2/dist/sweetalert2.js";
import axios from "axios";
import Loading from "@/components/Loading.vue";
export default {
  components: {
    Loading,
  },
  data: () => ({
    spinner: true,
    types: ["employe", "admin", "En Attente", "Décliné", "Bloqué"],
    Poste: ["Directeur", "Technicien", "Ingenieur"],
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
      password: "",
    },
    defaultItem: {
      name: "",
      email: "",
      type: "",
      poste: "",
      numero: "",
      password: "",
    },
  }),
  async created() {
    this.getuser();
  },
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

  methods: {
    async getuser() {
      await axios.get("/usersInactive").then((resp) => {
        this.users = resp.data;
        this.spinner = false;
        console.log(resp.data);
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
          axios.delete("userInactive/delete/" + id).then(() => {
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
        axios
          .put("/userInactive/update/" + this.editedItem.id, this.editedItem)
          .then((response) => (this.id = response.data.id));
      } else {
        this.users.push(this.editedItem);
        axios
          .post("/userInactive/create", this.editedItem, {
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