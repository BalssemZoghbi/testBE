<template>
  <div>
   <!-- <navbar /> -->
    <NavDash />
   
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

            <v-menu 
             transition="slide-x-transition"
             offset-x> 
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-bind="attrs"
          v-on="on"
          color="primary" 
        >
          Creer
        </v-btn>
      </template>

      <v-list >
         <v-list-item-group
        v-model="model"
        mandatory
        color="blue"
      >
        <v-list-item @click="onClick"   color="indigo">
          <v-list-item-title  @click="create()">Document Vierge</v-list-item-title>
        </v-list-item>

        <v-list-item >
          <v-list-item-title @click="createModele1()">Modele 1</v-list-item-title>
        </v-list-item>

        <v-list-item @click="onClick" >
          <v-list-item-title>Modele 2</v-list-item-title>
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
        <v-btn
      class="mx-2"
      fab
      dark
      small
      color="primary"
    >
      <v-icon dark>
        mdi-pencil
      </v-icon>
    </v-btn>
          </router-link>
                  <v-btn
      class="mx-2"
      fab
      dark
      small
      color="red"
    >
      <v-icon dark v-on:click="deleteprojet(item.id)">
        mdi-delete
      </v-icon>
    </v-btn>
                      <v-btn
      class="mx-2"
      fab
      dark
      small
      color="orange"
    >
      <v-icon dark >
        mdi-cloud-download
      </v-icon>
    </v-btn>
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
export default {
  components: {
    NavDash,
    Footer,
    // navbar
  },
  data: () => ({
     dialog2: false,
     select: [
          { text: 'Document Vierge' },
          { text: 'Modele 1' },
          { text: 'Modele 2' },
          { text: 'Modele 3' },
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
      // { text: "Frequence", value: "frequence" },
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
  mounted(){
  let user=localStorage.getItem('user');
  if(!user){
  this.$router.push('/Connexion');
    }
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
      create(){
     let token= localStorage.getItem('token')
       axios.post('projets/add',{}, {
    headers: {
    'Authorization': token
    }
  }).then(
        (response) => (
          this.createprojet = response.data,
          this.$router.push('/projet/update/'+response.data.id))
      );
    },
      createModele1(){
     let token= localStorage.getItem('token')
       axios.post('projets/create',{}, {
    headers: {
    'Authorization': token
    }
  }).then(
        (response) => (
          this.createprojet = response.data,
          this.$router.push('/projet/update/'+response.data.id))
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
    top: 173px!important;
    left: 395px !important;
    transform-origin: left top;
    z-index: 8;
}
</style>