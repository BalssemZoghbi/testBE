<template>
<div>
    <navbarHome />  
    <form  style="maring-left: -6%">
      <input type="search" placeholder="Search" id="search" v-model="query" />
    </form>
    <div v-for="projet in projets" :key="projet.id" :projet="projet">
      <router-link :to="'/projet/' + projet.id">
        <h4>{{ projet.reference }}</h4>
      </router-link>
              
      <button type="button" v-on:click="deleteprojet(projet.id)">
        supprimer
      </button>
           
      <router-link class="nav-link" :to="'/projet/update/' + projet.id"
                >edit</router-link>
     </div>
</div>
</template>

<script>
import axios from "axios";

import navbarHome from "components/navbarHome";

export default {
  name: "Home",
  components: {
    navbarHome,
  },
  data: () => ({
     projets: {},
      query:"",
  }),
  computed: {
  filtered() {
      return this.projets.filter((projet) =>
        projet.reference.includes(this.query)
      );
  },
   // ...mapState({
    //      user:'userInfos'
    //    })
},
 mounted:function(){
    // console.log(this.$store.state.user);
    if(this.$store.state.user.id==-1){
      this.$router.push('/login');
      return;
    }
  },
  created() {
    this.getprojet();
  },
  methods: {
    deleteprojet(id) {
      axios.delete('projets/delete/'+id).then(() => {
        this.getprojet();
      });
    },
    getprojet() {
      axios.get('/projets').then((resp) => {
        this.projets = resp.data.data;
      });
    },
    
  },
};
</script>