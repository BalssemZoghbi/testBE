<template>
  <nav
    class="nav justify-content-center"
    style="
      background-color: #c6deed;
      box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    "
  >
    <ul class="nav">
      <img src="../assets/sacem.png" />

      <li class="nav-item">
        <router-link class="nav-link active" aria-current="page" to="/"
          >Projet</router-link
        >
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
  margin-bottom: 3%;
  right: 113%;
  width: 30%;
  height: 96%;
}
</style>
