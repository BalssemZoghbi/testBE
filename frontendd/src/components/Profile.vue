<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="350px" max-height="750px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn  v-bind="attrs" v-on="on" style=" background-color:white;   margin-left: -70%!important;   border: 0px!important ;box-shadow: 0px 0px!important; color:black;text-transform: none;font-weight: 400;font-size: 16px;"  >
          Profile
          </v-btn>
      </template>
      <v-card >
        <v-card-title>
          <!-- <span class="text-h5">Bonjour {{ user.name }} </span> -->
        </v-card-title>
        <v-card-text>
          <v-avatar
          color="primary"
          style="margin-left: 41%!important;"
          size="61"><v-icon large color="white">mdi-account</v-icon></v-avatar>
          <v-container style="margin-left: 20%;">
          <h2 style="color:black;">{{  user.name  }}</h2> <br>
           <!-- <v-col
        md="4">Poste: {{  user.poste  }} </v-col>
          <v-col
        md="4"> -->
           <h3><span>Email : </span> {{  user.email  }}</h3>
         <h3> <span>Poste : </span> {{  user.poste  }}</h3>
         <h3><span>Numero tel : </span>  {{  user.numero  }}</h3>
      
         <!-- </v-col> -->
           <!-- <v-col  cols="5">  <v-text-field

      hide-details="auto"
      v-model=" user.numero"
      color="blue"
      style="margin-left:-10%;color:black!important;"
      disabled
    ></v-text-field></v-col> -->
          </v-container>
        </v-card-text>
        <v-form class="px-3" ref="form">
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" text @click="dialog = false"
              >Fermer</v-btn>
            <v-flex class="mt-4 mb-4">
              <Update :Data="user"/>
            </v-flex>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";

import Update from "./UpdateUser.vue";
export default {
  name: "Profile",
  components: {
    Update,
  },

  data: () => ({
    dialog: false,
    name: "",
    email: "",
    type: "",
    password: "",
    numero: "",
    poste: "",
    user: [],
  }),
  watch: {
    dialog(val) {
      val || this.close();
    },
  },
  methods: {
    close() {
      this.dialog = false;
    },
  },
  async created() {
    const response = await axios.get("user");
    this.$store.dispatch("user", response.data);

    this.user = response.data;
  },
  computed: {
    ...mapGetters(["user"]),
  },
  mounted() {
axios.get('/user/'+this.$route.params.id, 
{ headers: { token: localStorage.getItem('token')}})
      .then(res => {
        this.email = res.data.user.email;
        this.password = res.data.password;
        this.name = res.data.user.name;
        this.numero = res.data.user.numero;
        this.poste = res.data.user.poste;
        this.user.email = this.email;
        this.user.password = this.password;
        this.user.name = this.name;
        this.user.numero = this.numero;
        this.user.poste = this.poste;
        console.log(this.user)
      })   
  },
};
</script>
<style scoped>
img{
  margin-top: 10%;
  margin-left:30%;
}
span{
  color: black;
  margin-left: -20%;
}
</style>