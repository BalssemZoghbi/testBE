<template>
  <div>
    <v-tabs v-model="tab" background-color="transparent" grow>
      <v-tab v-for="itemtab in itemstab" :key="itemtab">
        {{ itemtab }}
      </v-tab>
    </v-tabs>
    <Loading v-if="spinner" />
    <v-tabs-items v-model="tab">
      <v-tab-item>
        <v-card flat>
          <v-data-table
            :headers="headers"
            :items="gar24"
            sort-by="calories"
            class="elevation-1"
            :search="search"
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-card-title>Garantie24</v-card-title>
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
                          <v-row cols="12" md="8">
                            <v-text-field
                              v-model="editedItem.pn"
                               prepend-icon="info"
                              label="Pn"
                            ></v-text-field>
                          </v-row>
                          <v-row>
                            <v-col cols="6">
                              <v-text-field
                                v-model="editedItem.po"
                                 prepend-icon="widgets"
                                label="Po"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                              <v-text-field
                                v-model="editedItem.lo"
                                 prepend-icon="gavel"
                                label="lo"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                          <v-row>
                            <v-col cols="6">
                              <v-text-field
                                v-model="editedItem.pcc"
                                 prepend-icon="folder_open"
                                label="Pcc"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                              <v-text-field
                                v-model="editedItem.ucc"
                                 prepend-icon="event"
                                label="Ucc"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                        </v-col>
                      </v-container>
                    </v-card-text>

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
              <v-btn class="mx-2" fab dark small color="red">
                <v-icon dark v-on:click="deletegar(item.id)">
                  mdi-delete
                </v-icon>
              </v-btn>
            </template>
          </v-data-table>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <garantie36 />
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>

<script>
import Swal from "sweetalert2/dist/sweetalert2.js";
import garantie36 from "../garantie/garantie36.vue";
import Loading from "@/components/Loading.vue";

import axios from "axios";
export default {
  components: {
    garantie36,
    Loading,
  },
  data: () => ({
    spinner: true,
    tab: null,
    itemstab: ["Garantie 24", "Garantie 36"],
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "Pn", value: "pn" },
      { text: "Po", value: "po" },
      { text: "lo", value: "lo" },
      { text: "Pcc", value: "pcc" },
      { text: "Ucc", value: "ucc" },
      { text: "Operation", value: "actions", sortable: false },
    ],
    gar24: [],
    editedIndex: -1,
    editedItem: {
      pn: "",
      po: "",
      lo: "",
      pcc: "",
      ucc: "",
    },
    defaultItem: {
      pn: "",
      po: "",
      lo: "",
      pcc: "",
      ucc: "",
    },
  }),
  async created() {
    this.get24();
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Ajouter " : "Editer ";
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
    async get24() {
      await axios.get("/garantie24").then((resp) => {
        this.gar24 = resp.data;
        this.spinner = false;
        console.log(resp.data);
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
          axios.delete("/garantie24/delete/" + id).then(() => {
            Swal.fire("Supprimé!", "Cette colonne a été supprimé", "success");
            this.get24();
          });
        }
      });
    },
    editItem(item) {
      this.editedIndex = this.gar24.indexOf(item);
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
        Object.assign(this.gar24[this.editedIndex], this.editedItem);
        console.log("edit");
        axios
          .put("/update24/" + this.editedItem.id, this.editedItem)
          .then((response) => ((this.id = response.data.id), this.get24()));
      } else {
        this.gar24.push(this.editedItem);
        axios
          .post("/create24", this.editedItem)
          .then((response) => ((this.id = response.data.id), this.get24()));
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