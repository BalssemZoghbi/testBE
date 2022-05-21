<template>
  <div>
    <!-- <navbar /> -->
    <NavDash v-if="this.usertype == 'admin'" />
    <NavDashEmp v-if="this.usertype == 'employe'" />
<Loading v-if="spinner"/>
 
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
            <v-btn color="primary"  @click="create()" dark class="mb-2">
                Ajouter un Modele
              </v-btn>
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
          <router-link :to="'/projet/updateModele/' + item.projets_id">
            <v-btn class="mx-2" fab dark small color="primary">
              <v-icon dark> mdi-pencil </v-icon>
            </v-btn>
          </router-link>
          <v-btn class="mx-2" fab dark small color="red">
            <v-icon dark v-on:click="deleteModele(item.id)">
              mdi-delete
            </v-icon>
          </v-btn>
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
import Loading  from '@/components/Loading.vue';
export default {
  components: {
    NavDash,
    NavDashEmp,
    Footer,
    Loading,
    // navbar
  },
  data: () => ({
     
    spinner:true,
    usertype: "",
    projet: Object,
    appareil:"",
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
        text: "Modele",
        value: "modele",
        align: "start",
        sortable: true,
      },
      { text: "Puissance", value: "puissance" },
      { text: "Tension Primaire", value: "u1n" },
      { text: "Tension Secondaire", value: "u2o" },
      { text: "Couplage", value: "couplage" },
      { text: "Materiau Primaire", value: "materiauMT" },
      { text: "Materiau Secondaire", value: "materiauBT" },
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
    this.getModele();
    
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
    this.getModele();
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
  
    create() {
      let token = localStorage.getItem("token");
      axios
        .post(
          "/modeles/create",
          {},
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then(
          (response) => (
            this.$router.push("/projet/updateModele/"+ response.data.projets_id)
          )
        );
    },

    getModele() {
      axios.get("modeles").then((resp) => {
        this.projets = resp.data;
        this.spinner=false;
      });
    },
    deleteModele(id) {
        console.log(id);
      Swal.fire({
        title: "Supprimer",
        text: "Vous êtes sure de supprimer ce modele?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Supprimer",
      }).then((result) => {
        if (result.isConfirmed) {
        axios.delete("modeles/delete/" + id).then(() => {
        Swal.fire("Supprimé!", "Ce Modele a été supprimé", "success");
        this.getModele();
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