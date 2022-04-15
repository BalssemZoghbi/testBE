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
             <v-btn color="primary"  @click="create()" dark class="mb-2">
                Ajouter 
              </v-btn>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-card-title>
              <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>
          </v-toolbar>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
          <router-link :to="'/projet/update/' + item.id">
            <v-icon small class="mr-2"> mdi-pencil </v-icon>
          </router-link>
          <v-icon small v-on:click="deleteprojet(item.id)"> mdi-delete </v-icon>
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
import NavDash from "../components/NavDash.vue";
export default {
  components: {
    NavDash,
    Footer,
    // navbar
  },
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Reference Transformateur",
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
  this.$router.push('/login');
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
.v-data-table {
  /* line-height: 1.5; */
  max-width: 1800px;
  /* margin-left: 3%; */
  /* box-shadow: 20px 20px 50px grey; */
}
.theme--light.v-icon {
  color: #2196f3;
}
</style>