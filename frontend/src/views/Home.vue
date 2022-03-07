<template>
  <div class="home">
    <div class="container event py-5">
      
      <form class="d-flex">
        <input
          class="form-control me-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
        />
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
       <router-link class="nav-link" to="/projet/create">
          <button class="btn btn-primary">add</button></router-link>
      <div v-for="projet in projets" :key="projet.id" :projet="projet">
              <div class="projet-card card">
          
          <div class="card-body">
            <router-link class="nav-link" :to="'/projet/'+projet.id ">
              <p>{{ projet.reference }}</p>
            </router-link>
            <div class="button">

        <button class="btn btn-danger" v-on:click="deleteprojet(projet.id)">delete</button>
              <router-link class="nav-link" :to="'/projet/update/'+projet.id"><button class="btn btn-warning">edit</button></router-link >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
export default {
  name: "Home",
  data() {
    return {
      projets: null,
    };
  },
  created() {
     this.getprojet();
  },
  methods: {
    deleteprojet(id) {
       ProjetService.deleteProjet(id).then(() => {
        this.getprojet();
      });
    },
    getprojet(){
        ProjetService.getProjets().then((resp) => {
        this.projets = resp.data.data;
        });
    }
  },
};
</script>
<style scoped>
.event {
  display: flex;
  flex-direction: column;
  align-items: left;
}
.projet-card {
  margin-top: 20px;
  padding: 20px;
  cursor: pointer;
  border: 1px solid black;
  background: #ffffff;
  box-shadow: 0px 1px 19px rgba(198, 222, 237, 0.25);
  border-radius: 40px;
  width: 100%;
  /* left: 175px; */
  /* top: 12%; */
  height: 75px;
}
.projet-card:hover {
  transform: scale(1.01);
  box-shadow: 0 3px 12px 0 rgba(0, 0, 1, 0);
}
p {
  margin-top: -2%;
  /* margin-right: 80%; */
}
.button {
  /* display:inline-block; */
  /* text-align: justify; */
  margin-top: -5%;
  margin-left: 80%;
  border-radius: 20px;
}
</style>
