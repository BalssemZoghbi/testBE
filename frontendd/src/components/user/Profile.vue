<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="550px" max-height="850px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn  v-bind="attrs" v-on="on" style=" background-color:white;   margin-left: -70%!important;   border: 0px!important ;box-shadow: 0px 0px!important; color:black;text-transform: none;font-weight: 400;font-size: 16px;"  >
          Profile
          </v-btn>
      </template>
      <v-card>
        <v-card-title>
           <v-avatar
          color="success"
          style="margin-left: 41%!important;"
          size="61"><v-icon large color="white">mdi-account</v-icon></v-avatar>
        </v-card-title>
        <!-- <v-form> -->
        <v-container>
          <h1 style="color:black;margin-left: 25%;"> {{  user.name  }}</h1> <br>
            <h3><span style="color:green !important;" >Email : </span> {{  user.email  }}</h3>
         <h3> <span style="color:green !important;" >Poste : </span> {{  user.poste  }}</h3>
         <h3><span style="color:green !important;" >Numero tel : </span>  {{  user.numero  }}</h3>
        </v-container>
        <v-form class="px-3" ref="form">
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" style=" background-color:white;margin-left: 50%!important;" text @click="dialog = false"
              >Fermer</v-btn
            >
            <v-flex>
              <UpdateUser :Data="user"/>
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
import UpdateUser from '../user/UpdateUser.vue';

export default {
  name: "Profile",
  components: {
    UpdateUser
  },

  data: () => ({
    dialog: false,
    name: "",
    email: "",
    type: "",
    password: "",
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
        this.user.email = this.email;
        this.user.password = this.password;
        this.user.name = this.name;
        console.log(this.user)
      })   
  },
};
</script>