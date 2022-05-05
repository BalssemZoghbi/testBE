<template>
  <div>
      <NavDash/>  
        <v-layout style="margin-left:4%">
    <v-row class="clickable">
      <v-col cols="12" md="10">
        <v-card  class="ml-5 mr-5">
          <v-app-bar
          dark
          color="rgb(5 48 96)"
          >
          <v-btn icon>
            <v-icon>mdi-finance</v-icon>
          </v-btn>
          <v-toolbar-title>Statistiques</v-toolbar-title>
          </v-app-bar>
        <v-container>
          <v-row>
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
      <v-btn text >{{userCount}}</v-btn>
      <!-- <v-btn text v-model="userCount">{{userCount}}</v-btn> -->
      <v-spacer></v-spacer>
      <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon>

    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>
             <!-- <v-col cols="12" sm="4">
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
        <v-list-item-title class="headline mb-1">Devices</v-list-item-title>

      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
       color="#F79F1F"
      >
        <v-icon dark>fas fa-laptop-house</v-icon>
      </v-list-item-avatar>
    </v-list-item>
    <v-divider></v-divider>
    <v-card-actions>
      <v-icon flab color="#F79F1F">description</v-icon>
      <v-btn text>300k</v-btn>
      <v-spacer></v-spacer>
      <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon>

    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col> -->
          </v-row>
              <div style="margin-top: 4%;margin-right: -43%;width: 155%;">
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
  </div>
  <div style="    margin-top: -44%;width: 51%;">
    <Bar
    :chart-options="chartOptionsBar"
    :chart-data="chartDataBar"
    :chart-id="chartIdBar"
    :dataset-id-key="datasetIdKeyBar"
    :plugins="pluginsBar"
    :css-classes="cssClassesBar"
    :styles="stylesBar"
    :width="widthBar"
    :height="heightBar"
  />
  </div>
        </v-container>
        </v-card>
      </v-col>
      <!-- <v-col cols="10" sm="12">
    <v-card class="px-2">
        <Carousel />
    </v-card>

      </v-col> -->
    
    </v-row>
   
  </v-layout>
 
  </div>
  
  
</template>

<script>
import { Pie ,Bar} from 'vue-chartjs/legacy'
// import { Bar } from 'vue-chartjs/legacy'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale,
  BarElement,
  LinearScale
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale,BarElement,  LinearScale)

  import NavDash from '@/components/NavDashboard';
import axios from "axios";

  export default {
    name: 'Dashboard',
    components: {
      Pie,
      Bar,
      NavDash
    },
      props: {
    chartId: {
      type: String,
      default: 'pie-chart'
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
     chartIdBar: {
      type: String,
      default: 'bar-chart'
    },
    datasetIdKeyBar: {
      type: String,
      default: 'label'
    },
    widthBar: {
      type: Number,
      default: 400
    },
    heightBar: {
      type: Number,
      default: 400
    },
    cssClassesBar: {
      default: '',
      type: String
    },
    stylesBar: {
      type: Object,
      default: () => {}
    },
    pluginsBar: {
      type: Array,
      default: () => []
    }
  },
  data: () => ({
    userCount:"",
    projetCount:"",
    UserChart:[],
    UserProjet:[],
    UserName:[],
    chartData:{},
    chartOptions:{},
    chartDataBar:{},
    chartOptionsBar:{},
    // chartDataBar: {
    //     labels: [
    //       'Utilisateur1',
    //       'Utilisateur2',
    //       'Utilisateur3',
    //       'Utilisateur4',
    //       'Utilisateur5',
    //       'Utilisateur6'
    //     ],
    //     datasets: [
    //       {
    //         label: 'Projets',
    //         backgroundColor: '#448DD3',
    //         data: [40, 20, 12, 39, 10, 40]
    //       }
    //     ]
    //   },
    //   chartOptionsBar: {
    //     responsive: true,
    //     maintainAspectRatio: false
    //   }
    
  }),
    mounted(){
  let user=localStorage.getItem('user');
  if(!user){
  this.$router.push('/Connexion');
    }
  },
  created(){
    
     axios
        .post("/stat")
        .then((response) => (this.userCount=response.data.userCount,
        this.projetCount=response.data.projetCount,
        this.UserChart=response.data.UserChart,
        this.UserProjet=response.data.UserProjet,
        this.UserName=response.data.UserName,
        console.log(this.UserChart),
        this.chartData= {
        labels: ['Employé', 'En Attente', 'Administrateur','Inactive'],
        datasets: [
          {
            backgroundColor: [' #3358FF', '#0628C4', '#00D8FF','#1DA1B0'],
            data: response.data.UserChart,
          }
        ]
      },
      this.chartOptions= {
        responsive: true,
        maintainAspectRatio: false
      },
      this.chartDataBar= {
        labels:response.data.UserName,
        datasets: [
          {
            label: 'Projets',
            backgroundColor: '#448DD3',
            data: [40, 20, 12]
          }
        ]
      },
      this.chartOptionsBar= {
        responsive: true,
        maintainAspectRatio: false
      }
        ),
        
        );
  }
  }
</script>
