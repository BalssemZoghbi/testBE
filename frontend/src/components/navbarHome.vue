<template>
   <nav
    class="nav justify-content-center"
    style="background-color: #c6deed;"
  >
    <ul class="nav">
       <div class="container-fluid">
       <a class="navbar-brand" href="http://www.sacemindustries.com/">
     <img src="../assets/sacem.png" alt="" >
        
       </a>
       
     </div>
      <li class="nav-item">
        <router-link class="nav-link active" aria-current="page" to="/">Projets</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/projet/create">Crée</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/about">Importer</router-link>
      </li>
      
    </ul>
  </nav>
</template>
<script>
export default {
  name: "navbarHome",
};
</script>
<style scoped>
img {
  position: relative;
  margin-top: 3%;
  right: 113%;
  width: 30%;
  height: 96%;
}
li{
   /* margin-bottom: 3%; */
   top:120%;
}
</style>
