<template>
  <div>
    <Loading v-if="spinner" />
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
            <v-menu transition="slide-x-transition" offset-x>
              <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" color="primary"> Créer </v-btn>
              </template>

              <v-list>
                <v-list-item-group v-model="model" mandatory color="blue">
                  <v-list-item @click="onClick" color="blue">
                    <v-list-item-title @click="create()"
                      >un Projet Vierge</v-list-item-title
                    >
                  </v-list-item>
       
<!--  -->
  <v-menu
      v-model="menu"
      :close-on-content-click="false"
      style="text-align: left;"
      offset-x
      
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          class="bouton"
          v-bind="attrs"
          v-on="on"
        >
          A partir de   
          <v-icon
          dark
          left
          style="margin-left: 53px;"
        >
          mdi-arrow-right
        </v-icon>
        </v-btn>
      </template>
<v-hover>
      <v-card >
        
<v-list-item style="width:119%!important;margin-left: -9%;">
                    <v-dialog
                      v-model="dialogModele"
                      scrollable
                      max-width="63%"
                      max-heigth="30%"
                      style="heigth: 30% !important"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn v-bind="attrs" v-on="on" class="bouton" style="margin-left: -49%;">
                          
                         Modèle
                        </v-btn>
                      </template>
                      <v-card class="body panel left-panel">
                        <v-data-table
                          :headers="headersModele"
                          :items="Modele"
                          sort-by="calories"
                          class="elevation-1"
                          :search="searchModele"
                          :custom-filter="filterOnlyCapsTextModele"
                        >
                          <template v-slot:top>
                            <v-toolbar flat>
                              <v-card-title>
                                <v-text-field
                                  v-model="searchModele"
                                  append-icon="mdi-magnify"
                                  label="Recherche"
                                  single-line
                                  hide-details
                                ></v-text-field>
                              </v-card-title>
                            </v-toolbar>
                          </template>
                          <template v-slot:[`item.actions`]="{ item }">
                            <router-link
                              :to="'/projet/update/' + item.projets_id"
                            >
                              <v-btn
                                class="mx-2"
                                fab
                                dark
                                small
                                color="primary"
                                @click="ProjetModele(item.projets_id)"
                              >
                                <v-icon dark> mdi-pencil </v-icon>
                              </v-btn>
                            </router-link>
                          </template>
                        </v-data-table>
                      </v-card>
                    </v-dialog>
                  </v-list-item>
                  <v-list-item style="width:119%!important;margin-left: -9%;">
                      <v-dialog
                      v-model="dialog"
                      scrollable
                       max-width="63%"
                      max-heigth="30%"
                      style="heigth: 30% !important"
                    >
                    <!-- max-width="63%"
                      max-heigth="30%"
                      style="heigth: 30% !important" -->
                    <!-- <v-dialog v-model="dialog" max-width="60%"> -->
                      <template v-slot:activator="{ on, attrs }">
                        
                        <v-btn class="bouton" v-bind="attrs" v-on="on"    style="margin-left: -35%;" >
                          
                        Ancien Projet
                        </v-btn>
                      </template>
                      
                      <v-card class="body panel left-panel">
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
                              <v-divider
                                class="mx-4"
                                inset
                                vertical
                              ></v-divider>
                              
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
                              <v-btn
                                class="mx-2"
                                fab
                                dark
                                small
                                color="primary"
                                @click="ProjetProjet(item.id)"
                              >
                                <v-icon dark> mdi-pencil </v-icon>
                              </v-btn>
                            </router-link>
                          </template>
                        </v-data-table>
                      </v-card>
                    </v-dialog>
                     </v-list-item>
       
      </v-card>
      </v-hover>
    </v-menu>
<!--  -->
                  
                      <v-list-item style="width: 119%!important;margin-left: -9%;">
                    <v-dialog v-model="dialogImp" >
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn class="bouton" v-bind="attrs" v-on="on" style="margin-left: -18%;">
                          Importer un projet
                        </v-btn>
                      </template>
                      
                      <v-card >
                       <uploader/>
                      </v-card>
                    </v-dialog>
                      </v-list-item>
                 
                </v-list-item-group>
              </v-list>
            </v-menu>
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
              <v-tooltip bottom color="primary">
      <template v-slot:activator="{ on, attrs }">
         <v-btn
              class="mx-2"
              fab
              dark
              v-bind="attrs"
              v-on="on"
              small
              color="primary"
              v-on:click="update(item.id)">
              <v-icon dark> mdi-pencil </v-icon>
            </v-btn>
      </template>
      <span>Modifier projet</span>
    </v-tooltip>
          </router-link>
    <v-tooltip bottom color="orange">
      <template v-slot:activator="{ on, attrs }">
         <v-btn
              class="mx-2"
              fab
              dark
                v-bind="attrs"
          v-on="on"
              small 
                 color="orange"
            @click="exportword(item.id)"
            >
              <v-icon dark> mdi-cloud-download </v-icon>
            </v-btn>
      </template>
      <span>exporter rapport</span>
    </v-tooltip>
          <v-menu>
            <template v-slot:activator="{ on, attrs }">
              <v-btn fab
               class="mx-2"
            dark
            small
            v-bind="attrs" v-on="on" color="success">
                <v-icon>mdi-dots-vertical</v-icon>
              </v-btn>
            </template>

            <v-list>
              <!-- <v-list-item
            
              > -->
              <v-list-item-title>
                <v-btn
                  class="ma-2 white--text"
                  v-on:click="deleteprojet(item.id)"
                  outlined
                  color="red"
                >
                  <v-icon dark> mdi-delete </v-icon>

                  Supprimer
                </v-btn>
                <br />
                <v-btn
                  class="ma-2 white--text"
                  @click="getId(item.id)"
                  outlined
                  color="green"
                >
                  <v-icon dark> info </v-icon>
                  Modele
                </v-btn>
              </v-list-item-title>
              <!-- <br> -->
               <v-btn
                  class="ma-2 white--text"
                  v-on:click="exportjson(item.id)"
                  outlined
                  color="cyan"
                >
                <!-- <i class="fa-solid fa-brackets-curly"></i> -->
                  <v-icon dark> mdi-download</v-icon>

                  Exporter
                </v-btn>
              <!-- </v-list-item> -->
            </v-list>
          </v-menu>

          <v-dialog v-model="dialogInfo" max-width="500px">
            <v-card>
              <v-card-title> Modele </v-card-title>
              <v-card-text>
                <v-text-field
                  label="Nom du Modele*"
                  type="text"
                  required
                  v-model="modeles.modele"
                ></v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-btn color="primary" text @click="DevenirModele()">
                  Valider
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </template>
      </v-data-table>
    </div>
    <Footer />
  </div>
</template>
<script>
import axios from "axios";
import Footer from "@/components/Footer";
import uploader from "@/components/uploader";
import Swal from "sweetalert2/dist/sweetalert2.js";
import Loading from "@/components/Loading.vue";
export default {
  components: {
    Footer,
    Loading,
    uploader,
  },
  data: () => ({
    DevenirModeleId: "",
    dialogInfo: false,
    dialogm1: "",
    dialog: false,
    dialogImp: false,
    dialogModele: false,
    Modele: [],
    Projet: [],
    spinner: true,
    usertype: "",
    modeles: {
      modele: "",
    },
    projet: Object,
    appareil: "",
    isDisabled: false,
    dialog2: false,
    select: [
      { text: "Document Vierge" },
      { text: "Modele Feuillard Emaille" },
      { text: "Modele Emaille Meplat" },
      { text: "Modele Feuillard Meplat" },
    ],
    dialogDelete: false,
    headers: [
      // {
      //   text: "Appareil",
      //   value: "appareil",
      //   align: "start",
      //   sortable: true,
      // },
      { text: "Puissance", value: "puissance" },
      { text: "Tension Primaire", value: "u1n" },
      { text: "Tension Secondaire", value: "u2o" },
      { text: "Couplage", value: "couplage" },
      { text: "Materiau Primaire", value: "materiauMT" },
      { text: "Materiau Secondaire", value: "materiauBT" },
      { text: "Actions", value: "actions",sortable: false },
    ],
    headersModele: [
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
    search: "",
    searchModele: "",
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
    getProjet: [],
    info:""
  }),

  async created() {
    this.usertype = JSON.parse(localStorage.getItem("user")).type;
    console.log(this.usertype);
    const response = await axios.get("user");
    this.$store.dispatch("user", response.data);
    this.user = response.data;
    this.Modeles();
    localStorage.setItem("show", false);
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
    getId(id) {
      this.dialogInfo = true;
      this.DevenirModeleId = id;
    },
    DevenirModele() {
      const modeles = {
        modele: this.modeles.modele,
      };
      axios
        .post("/ProjetDevenirModele/" + this.DevenirModeleId, modeles)
        .then((this.dialogInfo = false), this.getprojet());
    },
    exportword(id) {
      axios({
        url: "http://localhost:8000/api/documents/" + id,
        method: "GET",
        responseType: "blob",
      }).then((response) => {
        var headers = response.headers;
        console.log(headers);
        var fileURL = window.URL.createObjectURL(
          new Blob([response.data], { type: headers["content-type"] })
        );
        var fileLink = document.createElement("a");
        fileLink.href = fileURL;
        fileLink.setAttribute("download", "conceptionTransfo.doc");
        document.body.appendChild(fileLink);

        fileLink.click();
      });
    },
    exportjson(id) {
      let date= new Date();
      let now_time = (date.getFullYear() + "_" + date.getMonth() + "_" + date.getDay()).toString()

     console.log(new Date());
      // let name=now_time+'_'+id;
      axios({
        url: "/json/" + id,
        method: "GET",
        responseType: "blob",
      }).then((response) => {
        var headers = response.headers;
        console.log(headers);
        var fileURL = window.URL.createObjectURL(
          new Blob([response.data], { type: headers["content-type"] })
        );
        var fileLink = document.createElement("a");
        fileLink.href = fileURL;
        fileLink.setAttribute("download", now_time+'_'+id+'.json');
        document.body.appendChild(fileLink);

        fileLink.click();
      });
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
    async update(id) {
      const result = await axios.get("projets/" + id);
      this.$store.dispatch("projet", result.data);
      this.getProjet = result.data;
      let load = JSON.stringify(this.getProjet);
      localStorage.setItem("projet", load);
    },
    ProjetModele(id) {
      let token = localStorage.getItem("token");
      axios
        .post(
          "/projet/modeles/create/" + id,
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
    ProjetProjet(id) {
      let token = localStorage.getItem("token");
      axios
        .post(
          "/projet/projet/create/" + id,
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
    Modeles() {
      axios.get("/modeles").then((resp) => {
        this.Modele = resp.data;
      });
    },
    async getprojet() {
      await axios.get("/projets").then((resp) => {
        this.$store.dispatch("projet", resp.data);
        this.projets = resp.data;
        console.log(this.projet);
        this.spinner = false;
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
          axios.delete("projets/delete/" + id).then(() => {
            Swal.fire("Supprimé!", "Ce projet a été supprimé", "success");
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
  filterOnlyCapsTextModele(value, searchModele) {
    return (
      value != null &&
      searchModele != null &&
      typeof value === "string" &&
      value.toString().indexOf(searchModele) !== -1
    );
  },

  // },
};
</script>
<style scoped>

.file{
  background-color: primary;
  color: rgb(5, 48, 96);
  /* rgb(5, 48, 96) */
}
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
.bouton {
  color: dodgerblue;
  border: 0px !important;
  box-shadow: 0px 0px !important;
  border-radius: 0px !important;
  background-color: transparent ;
  text-transform: none;
  /* align-items: center; */
    display: flex;
    flex: 1 1 100%;
    letter-spacing: normal;
    min-height: 48px;
    outline: none;
    padding: 0 16px;
    position: relative;
    text-decoration: none;
    width: 100%;
}
.v-dialog [data-v-fae5bece] {
    border-radius: 4px;
    /* overflow-y: auto; */
    pointer-events: auto;
    transition: 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    width: 100%;
    z-index: inherit;
    box-shadow: 0px 0px 0px 0px rgb(0 0 0 / 0%), 0px 0px 0px 0px rgb(0 0 0 / 0%), 0px 0px 0px 0px rgb(0 0 0 / 0%);
}
</style>
