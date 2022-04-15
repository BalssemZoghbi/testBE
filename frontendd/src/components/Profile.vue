<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="550px" max-height="750px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn outlined color="blue" dark v-bind="attrs" v-on="on"
          >Profile</v-btn
        >
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">Bonjour {{ user.name }} </span>
        </v-card-title>
        <!-- <v-form> -->
        <!-- <v-container> -->
        <div class="p-3 mb-5 bg-body">
          <div class="row g-0">
            <div class="col-md-4">
              <!-- <strong>Photo :</strong> -->
              <br />
              <img
                src="../assets/user.png"
                style="
                  width: 100%;
                  height: 100%;
                  margin-left: -4%;
                "
              />
            </div>
            <div class="col-md-8">
              <h6>Details :</h6>
              <br />
              <p>
                <i class="fa fa-user">: {{ user.name }}</i>
              </p>
              <hr />
              <br />
              <!-- <strong>Social Media :</strong> -->
              <p>
               <i class="fa-solid fa-envelope">: {{ user.email }}</i>
              </p>
              <hr />
              <br />
              <p>
                <i class="fa fa-user-tie">: {{ user.type }}</i>
              </p>
            </div>
          </div>
        </div>
        <!-- <v-col>
              <v-row cols="4" sm="4">
                <v-text-field
                  v-model="user.name"
                  label="name"
                  readonly
                ></v-text-field>
              </v-row>
              <v-row cols="6" sm="6">
                <v-text-field
                  v-model="user.email"
                  label="Email"
                  readonly
                ></v-text-field>
              </v-row>
              <v-row cols="6" sm="6">
                <v-text-field
                  v-model="user.type"
                  label="Email"
                  readonly
                ></v-text-field>
              </v-row>
            </v-col> -->
        <!-- </v-container> -->
        <!-- </v-form> -->

        <v-form class="px-3" ref="form">
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" text @click="dialog = false"
              >Fermer</v-btn
            >
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