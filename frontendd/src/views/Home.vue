<template>
  <div>
    <!-- <navbar /> -->
    <NavDash v-if="this.usertype == 'admin'" />
    <NavDashEmp v-if="this.usertype == 'employe'" />

    <!-- <button class="nav-link" @click="create()" >Crée</button> -->
    <div class="body panel left-panel">
      <v-data-table
        :headers="headers"
        :items="projets"
        sort-by="calories"
        class="elevation-1"
        :search="search"
        :custom-filter="filterOnlyCapsText"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <!-- <v-toolbar-title>Projets</v-toolbar-title> -->

            <!-- <v-btn
        color="primary"
        class="ma-2"
        dark
        @click="dialog2 = true"
      >
        Creer
      </v-btn>
        <v-dialog
        v-model="dialog2"
        max-width="500px"
      >
        <v-card>
          <v-card-title>
            Creer
          </v-card-title>
          <v-card-text>
            <v-select
              :items="select"
              label="Creer depuis un "
              item-value="text"
            ></v-select>
          </v-card-text>
          <v-card-actions>
            <v-btn
              color="primary"
              text
              @click="dialog2 = false"
            >
              Fermer
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog> -->

            <v-menu transition="slide-x-transition" offset-x>
              <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" color="primary"> Creer </v-btn>
              </template>

              <v-list>
                <v-list-item-group v-model="model" mandatory color="blue">
                  <v-list-item @click="onClick" color="blue">
                    <v-list-item-title @click="create()"
                      >Document Vierge</v-list-item-title
                    >
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-title @click="createModeleFeuillardEmaille()"
                      >Modele Feuillard Emaille</v-list-item-title
                    >
                  </v-list-item>

                  <v-list-item @click="createModeleMeplatEmaille()">
                    <v-list-item-title>Modele Emaille Meplat</v-list-item-title>
                  </v-list-item>
                  <v-list-item @click="createModeleFeuillardMeplat()">
                    <v-list-item-title
                      >Modele Feuillard Meplat</v-list-item-title
                    >
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-menu>

            <!-- <v-btn color="primary"  @click="create()" dark class="mb-2">
                Ajouter 
              </v-btn> -->
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-card-title>
              <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Recherche"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>
          </v-toolbar>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
          <router-link :to="'/projet/update/' + item.id">
            <!-- <v-btn
              color="cyan"
              
    dark
    fab 
 small
    class="clickable"
    > <v-icon > mdi-pencil </v-icon></v-btn> -->
            <v-btn class="mx-2" fab dark small color="primary">
              <v-icon dark> mdi-pencil </v-icon>
            </v-btn>
          </router-link>
          <v-btn class="mx-2" fab dark small color="red">
            <v-icon dark v-on:click="deleteprojet(item.id)">
              mdi-delete
            </v-icon>
          </v-btn>
          <!-- <v-form ref="form"> -->
          <v-btn
            class="mx-2"
            fab
            dark
            small
            color="orange"
            @click="exportword()"
            :disabled="isDisabled"
          >
            <v-icon dark> mdi-cloud-download </v-icon>
          </v-btn>
          <!-- </v-form> -->
          <!-- <v-icon small > mdi-delete </v-icon> -->
        </template>
      </v-data-table>
    </div>
    <Footer />
  </div>
</template>
<script>
import axios from "axios";
//  import NavDash from "../components/nav.vue";
import Footer from "@/components/Footer";
import Swal from "sweetalert2/dist/sweetalert2.js";
// import navbar from "../components/navbar.vue";
import NavDash from "../components/NavDashboard.vue";
import NavDashEmp from "../components/NavDashboardEmploye.vue";
export default {
  components: {
    NavDash,
    NavDashEmp,
    Footer,
    // navbar
  },
  data: () => ({
    usertype: "",
    projet: Object,
    
    isDisabled: false,
    dialog2: false,
    select: [
      { text: "Document Vierge" },
      { text: "Modele Feuillard Emaille" },
      { text: "Modele Emaille Meplat" },
      { text: "Modele Feuillard Meplat" },
    ],
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Reference",
        value: "reference",
        align: "start",
        sortable: true,
      },
      { text: "Appareil", value: "appareil" },
      { text: "Puissance", value: "puissance" },
      { text: "Tension Primaire", value: "u1n" },
      { text: "Tension Secondaire", value: "u2o" },
      { text: "Couplage", value: "couplage" },
      { text: "Frequence", value: "frequence" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    projets: [],
    editedIndex: -1,
    editedItem: {
      Reference: "",
      Puissance: "",
      u1n: "",
      u2o: "",
      couplage: "",
      frequence: "",
    },
    defaultItem: {
      Reference: "",
      Puissance: "",
      u1n: "",
      u2o: "",
      couplage: "",
      frequence: "",
    },
  }),

  async created() {
    this.usertype = JSON.parse(localStorage.getItem("user")).type;
    console.log(this.usertype);
    const response = await axios.get("user");
    this.$store.dispatch("user", response.data);
    this.user = response.data;
    this.getprojet();
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },
  mounted() {
    let user = localStorage.getItem("user");
    if (!user) {
      this.$router.push("/Connexion");
    }
    this.getprojet();
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
    exportword() {
      axios.get("projets/" + this.$route.params.id).then((resp) => {
        this.projet = resp.data;
        console.log(this.projet);
      });
      // var formdata=new FormData(this.$refs.form);
      // var form={
      //   projet:this.projet,
      //   formdata:formdata
      // }
      axios
        .post("documents/" + this.$route.params.id, {
          Reference: this.projet.reference,
          Puissance: this.projet.Puissance,
          u1n: this.projet.u1n,
          u2o: this.projet.u2o,
          couplage: this.projet.couplage,
          frequence: this.projet.frequence,
        })
        .then(function (response) {
          console.log(response.data);
        });
      //      axios.post("documents/" + this.$route.params.id, formdata , {responseType:'blob'}).then(function (response) {
      //       var headers = response.headers;
      //        console.log(headers);
      //        var blob=new Blob([response.data],{type:headers['content-type']});
      //         var link = document.createElement("a");
      //           link.href = window.URL.createObjectURL(blob);
      //           link.download = vm.appareil;
      //           link.click();
      //           link.remove();
      //  vm.isDisabled = false;
      //      }) .catch(function (error) {
      //           console.log(error);
      //         });
    },
    create() {
      let token = localStorage.getItem("token");
      axios
        .post(
          "projets/add",
          {},
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then(
          (response) => (
            (this.createprojet = response.data),
            this.$router.push("/projet/update/" + response.data.id)
          )
        );
    },
    createModeleFeuillardEmaille() {
      let token = localStorage.getItem("token");
      axios
        .post(
          "projets/storeFeuillardEmaille",
          {},
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then(
          (response) => (
            (this.createprojet = response.data),
            this.$router.push("/projet/update/" + response.data.id)
          )
        );
    },
    createModeleFeuillardMeplat() {
      let token = localStorage.getItem("token");
      axios
        .post(
          "projets/storeFeuillardMeplat",
          {},
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then(
          (response) => (
            (this.createprojet = response.data),
            this.$router.push("/projet/update/" + response.data.id)
          )
        );
    },
    createModeleMeplatEmaille() {
      let token = localStorage.getItem("token");
      axios
        .post(
          "projets/storeMeplatEmaille",
          {},
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then(
          (response) => (
            (this.createprojet = response.data),
            this.$router.push("/projet/update/" + response.data.id)
          )
        );
    },
    getprojet() {
      axios.get("/projets").then((resp) => {
        this.projets = resp.data;
      });
    },
    deleteprojet(id) {
      Swal.fire({
        title: "Supprimer",
        text: "Vous êtes sure de supprimer ce projet?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Supprimer",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire("Supprimé!", "Ce projet a été supprimé", "success");
          axios.delete("projets/delete/" + id).then(() => {
            this.getprojet();
          });
        }
      });
    },
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
  filterOnlyCapsText(value, search) {
    return (
      value != null &&
      search != null &&
      typeof value === "string" &&
      value.toString().indexOf(search) !== -1
    );
  },

  // },
};
</script>
<style scoped>
.body {
  /* background-color: #a2c7ff77; */
  padding: 20px;
  margin: 1.3%;
}
.v-card {
  /* margin-left: 85%; */
  border-width: thin;
  display: block;
  max-width: 100%;
  outline: none;
  text-decoration: none;
  transition-property: box-shadow, opacity;
  overflow-wrap: break-word;
  position: relative;
  white-space: normal;
}
.v-input {
  align-items: flex-start;
  display: flex;
  flex: 1 1 auto;
  font-size: 17px;
  letter-spacing: normal;
  width: 340px;
  text-align: right;
}
.v-card > *:last-child:not(.v-btn):not(.v-chip):not(.v-avatar) {
  border-bottom-left-radius: inherit;
  border-bottom-right-radius: inherit;
  border-top: thin solid rgba(0, 0, 0, 0.12);
}
/* .v-data-table { */
/* line-height: 1.5; */
/* max-width: 1800px; */
/* margin-top: -12%; */
/* box-shadow: 20px 20px 50px grey; */
/* } */
/* .theme--light.v-icon {
  color: #2196f3;
} */
.v-menu_content {
  min-width: 82px;
  top: 173px !important;
  left: 395px !important;
  transform-origin: left top;
  z-index: 8;
}
</style>