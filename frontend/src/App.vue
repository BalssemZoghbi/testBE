<template>
  <div>
    <nav class="nav justify-content-center" style="background-color: #c6deed">
      <ul class="nav">
        <img src="./assets/sacem.png" />

        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/"
            >Projet</router-link
          >
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/about">Crée</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/about">Importer</router-link>
        </li>
      </ul>
    </nav>
    <router-view />
  </div>
</template>

<style>
/* #app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
} */
img {
  position: relative;
  margin-bottom: 5%;
  right: 130%;
}
</style>
