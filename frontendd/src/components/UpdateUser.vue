<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="750px">
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
                  label="Nom"
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
                  label="Mot de passe*"
                  type="password"
                  required
                  v-model="password"
                ></v-text-field>
              </v-row>
            </v-col>
                                <form @submit.prevent="update" method="" enctype="multipart/form-data">
            <div >
                <input type="file" @change="imageSelected"  id="customFile">
                <label  for="customFile">Choose an image</label>
            </div>
            <div v-if="imagePreview" class="mt-3">
                <img :src="imagePreview" class="figure-img img-fluid rounded"  style="max-width:300px;margin-top:2%;margin-right:12px">
            </div>
            <!-- <button class="btn btn-success mt-5" type="submit">Upload profile</button> -->
        </form>
          </v-container>
          <small>* Champ obligatoire</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn  color="red darken-1" text @click="dialog = false">
            Close
          </v-btn>
          <v-btn color="green darken-1"  @click="update()">
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
    password:'',
        image:null,
      imagePreview:null,
  }),
  mounted() {
    this.data = this.Data;
    console.log(this.data);
  },
    methods: {
          imageSelected(e)
    {
       this.image=e.target.files[0];
       let reader=new FileReader();
       reader.readAsDataURL(this.image);
        reader.onload= e =>{
          this.imagePreview=e.target.result;
        };
    },
    //     profileUpload()
    // {
    //   let data= new FormData();
    //   data.append('image',this.image);
    //   axios.post('userprofile',data).then(response=>{
    //     console.log(response.data);
    //   }).catch(error=>{
    //     console.log(error);
    //   });
    // },
    update() {
      let img= new FormData();
      img.append('image',this.image);
      let user = {
        email: this.data.email,
        name: this.data.name,
        password: this.password,
        image: this.data.img,
      }
   
      // console.log(user)
      axios.post('user/updateprofile/'+this.data.id, user,{ headers: { token: localStorage.getItem('token')}})
      .then(
        (response) => (this.id = response.data.id)
        
      );
      //   axios.post('user/updateprofile/'+this.data.id,img).then(response=>{
      //   console.log(response.data);
      // }).catch(error=>{
      //   console.log(error);
      // });
    }
  },
};
</script>