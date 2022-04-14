<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="blue" dark v-bind="attrs" v-on="on"> Mise à jour </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">Modifier Profile</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-col>
              <v-row cols="12" sm="6" md="4">
                <v-text-field
                  label="name"
                  required
                  v-model="data.name"
                ></v-text-field>
              </v-row>
            
              <v-row cols="12">
                <v-text-field
                  label="Email*"
                  required
                  v-model="data.email"
                ></v-text-field>
              </v-row>
              <v-row cols="12">
                <v-text-field
                  label="Password*"
                  type="password"
                  required
                  v-model="password"
                ></v-text-field>
              </v-row>
            </v-col>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn  color="red darken-1" text @click="dialog = false">
            Close
          </v-btn>
          <v-btn color="green darken-1" text @click="update">
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import axios from 'axios'
export default {
  name: "UpdateUser",
  props: ["Data"],
  data: () => ({
    dialog: false,
    data: [],
    name:'',
    email:'',
    password:''
  }),
  mounted() {
    this.data = this.Data;
    console.log(this.data);
  },
    methods: {
    update() {
      let user = {
        email: this.data.email,
        name: this.data.name,
        password: this.password,
      }
      // console.log(user)
      axios.put('/user/updateprofile/'+this.data.id, user,{ headers: { token: localStorage.getItem('token')}})
      .then(
        (response) => (this.id = response.data.id)
        
      );
    }
  },
};
</script>