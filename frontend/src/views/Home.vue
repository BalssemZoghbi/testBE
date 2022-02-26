<template>
  <div class="home">
      <div class="container event py-5"> 
         <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    <HelloWorld v-for="projet in projets" :key="projet.id" :projet="projet" />
  </div>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from "@/components/HelloWorld.vue";

export default {
  name: "Home",
  components: {
    HelloWorld,
  },
   data() {
    return {
      // events:null
      projets: [
        {
          id: 0,
          nom: "bien-etre animal",
          titre: "projet 1",
     
        },
        {
          id: 1,
          nom: "bien-etre animal",
          titre: "projet 2",
        
        },
        {
          id: 2,
          nom: "bien-etre animal",
          titre: "projet 3",
  
        },
      ],  
    };
   }}
</script>
<style scoped>
.event{
  display: flex;
  flex-direction: column;
  align-items:left;
}
</style>