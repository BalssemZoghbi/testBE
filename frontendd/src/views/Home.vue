<template>
<div>
   <!-- <navbarHome />  -->
   <div class="body">
  <v-card>
    <v-card-title>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="projets"
      :search="search"
    ></v-data-table>
  </v-card>
  </div>
   </div>
</template>

<script>
import axios from "axios";
// import navbarHome from "../components/navbarHome.vue";
  export default {
    components: {
    // navbarHome,

  },
    data () {
      return {
        search: '',
        headers: [
          {
            text: 'Puissance',
            align: 'start',
            filterable: true,
            value: 'puissance',
          },
          // { text: 'Appareil', value: 'appareil' },
          { text: 'Tension Primaire', value: 'u1n' },
          { text: 'Tension Secondaire', value: 'u2o' },
          { text: 'Couplage', value: 'couplage' },
          { text: 'Frequence', value: 'frequence' },
        ],
        projets: [],
      }
    },
    created() {
    this.getprojet();
  },

    methods:{
       getprojet() {
      axios.get('/electrique').then((resp) => {
        this.projets = resp.data.data;
      });
    },
    },
  }
</script>
<style scoped>
.body{
  padding:50px;
}
.v-card {
  margin-left: 12%;
    border-width: thin;
    display: block;
    max-width: 75%;
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
    font-size: 16px;
    letter-spacing: normal;
    max-width: 50%;
    margin-left: 68%;
    /* text-align: right; */
}
.v-card > *:last-child:not(.v-btn):not(.v-chip):not(.v-avatar) {
    border-bottom-left-radius: inherit;
    border-bottom-right-radius: inherit;
    border-top: thin solid rgba(0, 0, 0, 0.12);}
/* .v-data-footer {
    display: none;
    flex-wrap: wrap; 
    align-items: center;
    font-size: 0.75rem;
     padding: 0 8px;
} */
</style>