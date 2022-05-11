<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="800px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn  color="black" dark v-bind="attrs" v-on="on" style="color: black!important;margin-left: -49%;"
          >Profile</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">User Profile</span>
        </v-card-title>
        <v-form>
          <v-container>
            <v-row>
              <v-col cols="12" sm="6">
                <v-text-field
                  v-model="name"
                  label="Nom"
                  readonly
                ></v-text-field>
              </v-col>
           
              <v-col cols="12" sm="6">
                <v-text-field
                  v-model="email"
                  label="Email"
                  readonly
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6">
                <v-text-field
                  v-model="date"
                  label="Date"
                  readonly
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-form>

        <v-form class="px-3" ref="form">
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" text @click="dialog = false"
              >Close</v-btn
            >
            <v-flex class="mt-4 mb-4">
              <!-- <Exemple3 :Data="desserts"/> -->
            </v-flex>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import axios from "axios";
// import Exemple3 from "./UpdateUser.vue";
export default {
  name: "Profile",
  components: {
    // Exemple3,
  },
 
  data: () => ({
    dialog: false,
    // username:'',
    date:'',
    name:'',
    email:'',
    desserts: [],
  }),
  watch: {
    dialog(val) {
      val || this.close();
    },
  },
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      this.desserts = [{ name: this.data.name}];
    },
    close() {
      this.dialog = false;
    },
  },
  mounted() {
axios.get('/users/'+this.$route.params.id, 
{ headers: { token: localStorage.getItem('token')}})
      .then(res => {
        // this.username = res.data.user.username;
        this.email = res.data.user.email;
        this.date = res.data.user.date;
        this.name = res.data.user.name;
        // this.desserts.username = this.username;
        this.desserts.email = this.email;
        this.desserts.date = this.date;
        this.desserts.name = this.name;
        console.log(this.desserts)
      })   
  },
};
</script>