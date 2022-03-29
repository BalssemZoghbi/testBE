<template>
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
</template>
<script>
import axios from "axios";
  export default {
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
    }
  }
</script>