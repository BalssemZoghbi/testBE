<template>
  <div>
        <v-layout >
    <v-row class="clickable">
        <v-container>
          <v-row style="margin-left:0.25%">
              <div class="flex4">
            <v-col style="width:170%!important">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="100"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto item"
        max-width="300"
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

            </v-col>
            
             <v-col style="margin-left:-1%">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="100"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto item"
        max-width="270"
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
             <v-col style="margin-left:-2%">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="200"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto item"
        max-width="300"
        outlined

  >
    <v-list-item three-line>
      <v-list-item-content>
        <v-list-item-title class="headline mb-1">Modeles</v-list-item-title>

      </v-list-item-content>

      <v-list-item-avatar
        tile
        size="80"
      color="blue darken-2"
      >
        <v-icon dark>folder_open</v-icon>
      </v-list-item-avatar>
    </v-list-item>
    <v-divider></v-divider>
    <v-card-actions>
      <v-icon flab color="blue darken-2">folder_open</v-icon>
      <v-btn text >{{ModeleCount}}</v-btn>
      <v-spacer></v-spacer>
<router-link to="/" style="text-decoration:none">  <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>

            <!--  -->
            
          
            
             <!-- <div class="grid2"> -->
                 <v-col style="margin-left:-2%">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="200"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto item"
        max-width="250"
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
<router-link to="/" style="text-decoration:none">  <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>
            <!--  -->
           <v-col style="margin-left:-12%">
              <v-hover
        v-slot:default="{ hover }"
        open-delay="200"
      >
       <v-card
       :elevation="hover ? 16 : 2"
        class="mx-auto item"
        max-width="270"
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
<router-link to="/" style="text-decoration:none">  <v-icon flab color="#2C3A47">mdi-chevron-right</v-icon></router-link>
    </v-card-actions>
  </v-card>
      </v-hover>

            </v-col>
             </div>
          </v-row>
          <br>
          <div class="flex">

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
  </div>
  <br>
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

import axios from "axios";

  export default {
    name: 'Dashboard',
    components: {
      Pie,
      Bar,
      Doughnut,
      LineChartGenerator
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
    ModeleCount:"",
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
        this.ModeleCount=response.data.ModeleCount,
        this.NbreCuivre=response.data.NbreCuivre,
        this.chartDataDonut={
        labels: ['Meplat Guipé Primaire', 'Rond Emaillé Primaire', 'Feuillard Primaire', 'Meplat Guipé Secondaire', 'Rond Emaillé Secondaire', 'Feuillard Secondaire'],
        datasets: [
          {
            backgroundColor: ['#3358FF', '#0628C4', '#00D8FF', '#1DA1B0','#3358FF', '#0628C4'],
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
          'Mars',
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
    grid-gap: 6%;
}
.grid2{
  display: grid;
    grid-template-columns: repeat(2, 1fr);
       grid-gap: 10px;
  margin-top: 10px;
  margin-left: 20%;
}
.flex4{
  display: grid;
    grid-template-columns: repeat(5, 1fr);
     grid-gap: 10px;
  margin-top: 10px;
  margin-left: -5%;
}
.item{
  width: 110%;
}
@media (max-width: 1245px) {
  .flex {
    grid-template-columns: repeat(1, 1fr);
    }
  .flex4 {
    grid-template-columns: repeat(2, 1fr);
    margin-left: 4%;
    }
  .grid2 {
    grid-template-columns: repeat(2, 1fr);
    margin-left: 4%;
     /* margin-bottom: 4%; */
    }
  }
</style>