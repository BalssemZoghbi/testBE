<template>
  <div>
      <NavDash/>  
        <v-layout style="margin-left:4%">
    <v-row class="clickable">
        <v-container>
          <v-row style="margin-left:-4%">
              <div class="flex4">
            <v-col >
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
             <v-col >
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
      <v-spacer></v-spacer>
<router-link to="/user" style="text-decoration:none"><v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
  
      </v-hover>

            </v-col>
            <v-col >
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
        <v-icon dark medium>business</v-icon>
      </v-list-item-avatar>
    </v-list-item>
    <v-divider></v-divider>
    <v-card-actions>
      <v-icon flab color="blue darken-2">business</v-icon>
      <v-btn text >{{NbreCuivre}}</v-btn>
      <v-spacer></v-spacer>
      <!-- <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon> -->
<router-link to="/" style="text-decoration:none">  <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>
            <v-col >
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
       color="#009432"
      >
        <v-icon dark>dialpad</v-icon>
      </v-list-item-avatar>
    </v-list-item>
    <v-divider></v-divider>
    <v-card-actions>
      <v-icon flab color="#009432">dialpad</v-icon>
      <v-btn text >{{NbreAlu}}</v-btn>
      <v-spacer></v-spacer>
      <!-- <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon> -->
<router-link to="/" style="text-decoration:none">  <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>

             <!-- <div class="flex">
            <v-col >
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
<router-link to="/" style="text-decoration:none">  <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col> -->
            <!-- <v-col >
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
      <v-spacer></v-spacer>
<router-link to="/user" style="text-decoration:none"><v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
  
      </v-hover>

            </v-col> -->
             </div>
          </v-row>
          <div class="flex">
            <!-- style="margin-top: 4%;width: 139%;" -->
              <div >
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
  <!-- style="    margin-top: -35%;
    width: 51%;
    margin-left: -2%;" -->
  <div >
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
  </div>
   <!-- style="margin-top: 5%;
    width: 50%;
    margin-left: 39%;" -->
    <div class="flex">
   <div >
   <LineChartGenerator
    :chart-options="chartOptionsLine"
    :chart-data="chartDataLine"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
  />
  </div>
  <!-- style="margin-top: -37%;width: 139%;margin-left:-50%"-->
  <div >
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
  </div>
        </v-container>
        <!-- </v-card>
      </v-col> -->
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
import { Doughnut } from 'vue-chartjs/legacy'
import { Line as LineChartGenerator } from 'vue-chartjs/legacy'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale,
  BarElement,
  LinearScale,
   LineElement,
  PointElement
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale,BarElement,  LinearScale,LineElement,PointElement)

  import NavDash from '@/components/NavDash.vue';
import axios from "axios";

  export default {
    name: 'Dashboard',
    components: {
      Pie,
      Bar,
      Doughnut,
      LineChartGenerator,
      NavDash
    },
      props: {
    chartId: {
      type: String,
      default: 'pie-chart'
    },
    chartLineChartId: {
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
     chartIdBar: {
      type: String,
      default: 'bar-chart'
    },
      chartIdDonut: {
      type: String,
      default: 'doughnut-chart'
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
    NbreCuivre:"",
    NbreAlu:"",
    UserChart:[],
    UserProjet:[],
    UserName:[],
    chartData:{},
    chartOptions:{},
    chartDataBar:{},
    chartOptionsBar:{},
    chartDataLine:{},
    chartOptionsLine:{},
    chartDataDonut:{},
    chartOptionsDonut:{},
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
     this. chartDataLine= {
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
     this. chartOptionsLine={
        responsive: true,
        maintainAspectRatio: false
      }
      ),);
  
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
        labels: response.data.UserName,
        // response.data.UserName,
        datasets: [
          {
            label: 'Projets',
            backgroundColor: '#448DD3',
            data :response.data.UserProjet
          }
        ]
      },
      this.chartOptionsBar= {
        responsive: true,
        maintainAspectRatio: false
      }
      ),);
  }
  }
</script>
<style scoped>
.flex{
  display: grid;
    grid-template-columns: repeat(2, 1fr);
    /* grid-gap: 10px; */
    margin-top: 10px;
}
.flex4{
  display: grid;
    grid-template-columns: repeat(4, 1fr);
    /* grid-gap: 10px; */
    margin-top: 10px;
}
@media (max-width: 1245px) {
  .flex {
    grid-template-columns: repeat(1, 1fr);
    /* margin-left: 0%; */
    }
  .flex4 {
    grid-template-columns: repeat(2, 1fr);
    margin-left: 4%;
    }
  }
</style>