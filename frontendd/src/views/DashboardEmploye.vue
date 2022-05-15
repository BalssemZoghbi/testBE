<template>
  <div>
    <NavDashEmp  />
      <v-layout>
    <v-row class="clickable">
      <!-- <v-col cols="12" md="10"> -->
        <!-- <v-card  class="ml-5 mr-5"> -->
          <!-- <v-app-bar
          dark
          color="rgb(5 48 96)"
          >
          <v-btn icon>
            <v-icon>mdi-finance</v-icon>
          </v-btn>style="margin-left:-12%;margin-bottom:1%"
          <v-toolbar-title>Statistiques</v-toolbar-title>
          </v-app-bar> -->
        <v-container>
          <v-row >
            <v-col cols="12" sm="4">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="200"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto"
        max-width="260"
        outlined

  >
    <v-list-item three-line>
      <v-list-item-content>
        <v-list-item-title class="headline mb-1">Projets</v-list-item-title>

      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
       color="blue darken-2"
      >
        <v-icon dark>fas fa-project-diagram</v-icon>
      </v-list-item-avatar>
    </v-list-item>
    <v-divider></v-divider>
    <v-card-actions>
      <v-icon flab color="blue darken-2">apps</v-icon>
      <v-btn text >{{projetCount}}</v-btn>
      <v-spacer></v-spacer>
      <!-- <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon> -->
<router-link to="/" style="text-decoration:none">  <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>
            <v-col cols="10" sm="4">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="200"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto"
        max-width="260"
        outlined

  >
    <v-list-item three-line>
      <v-list-item-content>
        <v-list-item-title class="headline mb-1">Cuivre</v-list-item-title>

      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
       color="blue darken-2"
      >
        <v-icon dark>fas fa-project-diagram</v-icon>
      </v-list-item-avatar>
    </v-list-item>
    <v-divider></v-divider>
    <v-card-actions>
      <v-icon flab color="blue darken-2">apps</v-icon>
      <v-btn text >{{NbreCuivre}}</v-btn>
      <v-spacer></v-spacer>
      <!-- <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon> -->
<router-link to="/" style="text-decoration:none">  <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>
            <v-col cols="12" sm="4">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="200"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto"
        max-width="260"
        outlined

  >
    <v-list-item three-line>
      <v-list-item-content>
        <v-list-item-title class="headline mb-1">Aluminium</v-list-item-title>

      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
       color="blue darken-2"
      >
        <v-icon dark>fas fa-project-diagram</v-icon>
      </v-list-item-avatar>
    </v-list-item>
    <v-divider></v-divider>
    <v-card-actions>
      <v-icon flab color="blue darken-2">apps</v-icon>
      <v-btn text >{{NbreAlu}}</v-btn>
      <v-spacer></v-spacer>
      <!-- <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon> -->
<router-link to="/" style="text-decoration:none">  <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>
          </v-row>
        </v-container>
    </v-row>
      </v-layout>
        <!-- <v-layout style="margin-left:4%">
    <v-row class="clickable"> -->
      
        <!-- <v-container>
          <v-row style="margin-left:-2%">
            <v-col cols="12" sm="6">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="200"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto"
        max-width="344"
        outlined

  >
    <v-list-item three-line>
      <v-list-item-content>
        <v-list-item-title class="headline mb-1">Projets</v-list-item-title>

      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
       color="blue darken-2"
      >
        <v-icon dark>fas fa-project-diagram</v-icon>
      </v-list-item-avatar>
    </v-list-item>
    <v-divider></v-divider>
    <v-card-actions>
      <v-icon flab color="blue darken-2">apps</v-icon>
      <v-btn text >{{projetCount}}</v-btn>
      <v-spacer></v-spacer>
      <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon>

    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>
            <v-col cols="12" sm="4">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="200"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto"
        max-width="344"
        outlined

  >
    <v-list-item three-line>
      <v-list-item-content>
        <v-list-item-title class="headline mb-1">Utilisateurs</v-list-item-title>

      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
       color="#009432"
      >
        <v-icon dark>mdi-account</v-icon>
      </v-list-item-avatar>
    </v-list-item>
    <v-divider></v-divider>
    <v-card-actions>
      <v-icon flab color="#009432">directions_walk</v-icon>
      <v-btn text >{{userCount}}</v-btn> -->
      <!-- <v-spacer></v-spacer>
      <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon>

    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col> -->
          
          <!-- </v-row>
              <div style="margin-top: 4%;width: 139%;">
   <Pie
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
  />
  </div> -->
   <!-- style="    margin-top: -35%;
    width: 51%;
    margin-left: -2%;" -->
  <div style="margin-top: 1%;
    width: 54%;
    margin-left: 2%;">
   <LineChartGenerator
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
  />
  </div>
  <div style="margin-top: -32%;width: 150%;">
  <Doughnut
    :chart-options="chartOptionsDonut"
    :chart-data="chartDataDonut"
    :chart-id="chartIdDonut"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
  />
  </div>
        <!-- </v-container>
    </v-row>
   
  </v-layout>
  -->
  </div>
  
  
</template>

<script>
import axios from "axios";
import NavDashEmp from "../components/NavDashboardEmploye.vue";
import { Doughnut } from 'vue-chartjs/legacy'
import { Line as LineChartGenerator } from 'vue-chartjs/legacy'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale,
  LinearScale,
  LineElement,
  PointElement
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale,
// ,BarElement,  
LinearScale,LineElement,PointElement)

// import axios from "axios";

  export default {
    name: 'DashboardEmploye',
    components: {
       Doughnut,
      LineChartGenerator,
        NavDashEmp,
    },
      props: {
     props: {
    chartId: {
      type: String,
      default: 'line-chart'
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      default: 400
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Array,
      default: () => []
    },
     chartIdDonut: {
      type: String,
      default: 'doughnut-chart'
    }
    
  },
  },
  data: () => ({
    NbreCuivre:"",
    NbreAlu:"",
    projetCount:"",
    // UserChart:[],
    // UserProjet:[],
    // UserName:[],
    chartData:{},
    chartOptions:{},
    chartDataDonut:{},
    chartOptionsDonut:{},
     
      
  }),
    mounted(){
  let user=JSON.parse(localStorage.getItem('user'));
  if(!user){
  this.$router.push('/Connexion');
    }
  },
  created(){
       axios
        .post("/stat")
        .then((response) => (this.userCount=response.data.userCount,
        this.projetCount=response.data.projetCount)),
     axios
        .post("/statEmploye")
        .then((response) => (this.ProjetChart=response.data.ProjetChart,
        this.NbreAlu=response.data.NbreAlu,
        this.NbreCuivre=response.data.NbreCuivre,
        this.chartDataDonut={
        labels: ['Vierge', 'Feuillard&Emaille', 'Feuillard&Meplat', 'Meplat&Emaille'],
        datasets: [
          {
            backgroundColor: ['#3358FF', '#0628C4', '#00D8FF', '#1DA1B0'],
            data: response.data.ProjetChart
          }
        ]
      },
      this.chartOptionsDonut= {
        responsive: true,
        maintainAspectRatio: false
      },
     this. chartData= {
        labels: [
          'Janvier',
          'Fevrier',
          'Mas',
          'Avril',
          'Mai',
          'Juin',
          'Juillet',
          'Aout',
          'Septembre',
          'Octobre',
          'Novembre',
          'Decembre',
        ],
        datasets: [
          {
            label: 'Projets',
            backgroundColor: '#448DD3',
            data: response.data.NbreProjet
          }
        ]
      },
     this. chartOptions={
        responsive: true,
        maintainAspectRatio: false
      }
      ),);
  }
  }
</script>
