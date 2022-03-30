<template>
  <div>
    <!-- <navbar /> -->
    <v-data-table
      :headers="headers"
      :items="projets"
      sort-by="calories"
      class="elevation-1"
      :search="search"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-card-title>Sites</v-card-title>
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
                Ajouter Site
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.title"
                        label="title"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.url"
                        label="url"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.email"
                        label="email"
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
                      <v-switch
                        v-model="editedItem.etat"
                        label="Etat"
                      ></v-switch>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.date"
                        label="Date"
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
                >Are you sure you want to delete this site?</v-card-title
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
      <!-- <template v-slot:item.etat="{item}">
        <v-etat-linear
      height="22"
      v-model= "item.etat"
      class="fas fa-eye" style="font-size: 24px; color: #00b44e"
    ></v-etat-linear>
    </template> -->
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
import axios from "axios";
  export default {
    data: () => ({
      search:"",
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          text: 'Reference Transformateur',
          align: 'start',
          sortable: false,
          value: 'couplage',
        },
        { text: 'Puissance', value: 'puissance' },
        { text: 'Tension Primaire', value: 'u1n' },
          { text: 'Tension Secondaire', value: 'u2o' },
          { text: 'Couplage', value: 'couplage' },
          { text: 'Frequence', value: 'frequence' },
        { text: 'Actions', value: 'actions', sortable: false },
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
    }),created() {
    this.getprojet();
  },


    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },


    methods: {
            getprojet() {
      axios.get('/electrique').then((resp) => {
        this.projets = resp.data.data;
      });
    },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.desserts.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>
<style scoped>
.body{
  padding:80px;
}
.v-card {
  margin-left: 85%;
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
    font-size: 58px;
    letter-spacing: normal;
    max-width:50%;
    margin-left: 50%;
    text-align: right;
}
.v-card > *:last-child:not(.v-btn):not(.v-chip):not(.v-avatar) {
    border-bottom-left-radius: inherit;
    border-bottom-right-radius: inherit;
    border-top: thin solid rgba(0, 0, 0, 0.12);}
.v-data-table {
    /* line-height: 1.5; */
    max-width: 88%;
      margin-left: 5%;

}
.theme--light.v-icon {
    color: #2196f3;
}

</style>