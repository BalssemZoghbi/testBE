<template>
  <div>
      <NavDash/>  
        <v-layout>
    <v-row class="clickable">
      <v-col cols="12" md="12">
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
      <v-btn text>40,664</v-btn>
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
      <v-btn text>40,664</v-btn>
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
  import NavDash from '@/components/NavDashboard';

  export default {
    name: 'Dashboard',

    components: {
      NavDash
    },
  data: () => ({
    //
  }),
    mounted(){
  let user=localStorage.getItem('user');
  if(!user){
  this.$router.push('/Connexion');
    }
  },
  }
</script>
