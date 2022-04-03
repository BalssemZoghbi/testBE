<template>
<div>
   <navbar /> 
   <div class="body">
     
  <v-data-table
    :headers="headers"
    :items="projets"
    sort-by="calories"
    class="elevation-1"
    :search="search"
    :custom-filter="filterOnlyCapsText"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Projets</v-toolbar-title>
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
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
        <!-- <v-dialog
          v-model="dialog"
          max-width="500px"
        >
        
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>


            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog> -->
      </v-toolbar>
    </template>
      <!-- <router-link class="nav-link" :to="'/projet/update/' + projet.id">edit -->

    <template v-slot:[`item.actions`]="{ item }">
      <router-link :to="'/projet/update/' + item.id">
      <v-icon
        small
        class="mr-2"
      >
      
        mdi-pencil
      </v-icon>
      </router-link>
      <v-icon
        small
        v-on:click="deleteprojet(item.id)"
      >
        mdi-delete
      </v-icon>
    </template>

  </v-data-table>
   </div>
    <Footer/> 
</div>
</template>
<script>
import axios from "axios"; 
//  import navbar from "../components/nav.vue";
import Footer from '@/components/Footer'

import navbar from "../components/navbar.vue";
  export default {
    components: {
    navbar,
    Footer
  },
    data: () => ({
      search:"",
      dialog: false,
      dialogDelete: false,
      headers: [
          {
          text: 'Reference Transformateur',
          value: 'reference',
          align: 'start',
          sortable: true
        },
        { text: 'Appareil', value: 'appareil' },
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
      axios.get('/projets').then((resp) => {
        this.projets = resp.data;
        console.log(this.projets);
      });
    },
    deleteprojet(id) {
      console.log(id)
      axios.delete('projets/delete/'+id).then(() => {
       this.getprojet();
      });
      // axios.delete('electrique/delete/'+this.projets.electrique_id).then(() => {
      //   this.getprojet();
      // });
    },
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
        filterOnlyCapsText (value, search) {
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().indexOf(search) !== -1
      },
      
    // },
  }
</script>
<style scoped>
.body{
  background-color: #a2c7ff77;
  padding:70px;
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
   width:340px;
    text-align: right;
}
.v-card > *:last-child:not(.v-btn):not(.v-chip):not(.v-avatar) {
    border-bottom-left-radius: inherit;
    border-bottom-right-radius: inherit;
    border-top: thin solid rgba(0, 0, 0, 0.12);}
.v-data-table {
    /* line-height: 1.5; */
    max-width: 1800px;
      /* margin-left: 3%; */

}
.theme--light.v-icon {
    color: #2196f3;
}

</style>