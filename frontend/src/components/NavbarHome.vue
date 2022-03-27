<template>
  <header>
    <!-- header inner -->
    <div class="header">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
            <div class="full">
              <div class="center-desk">
                <div class="logo">
                  <!-- <a href="sacemindustries.com"
                    ><img
                      src="../assets/sacem.png"
                      width="100px"
                      alt="sacemindustries"
                  /></a> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
            <nav class="navigation navbar navbar-expand-md navbar-dark">
              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarsExample04"
                aria-controls="navbarsExample04"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <router-link class="nav-link" aria-current="page" to="/"
                      >Projet</router-link
                    >
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" to="/projet/create"
                      >Crée</router-link
                    >
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" to="/about">Importer</router-link>
                  </li>
                  <li class="nav-item">
                  <router-link class="nav-link" to="/login" @click="logout()"> <span>logout</span></router-link>
                  </li>
                </ul>
                <div class="Call">
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
<script>
 export default {
  name: "navbarHome",
  methods:{
    logout:function(){
      console.log('before logout')
      this.$store.commit('logout');
      console.log('after logout')

      this.$router.push('/login');
    }
  }
};
</script>
<style scoped>
.header {
  width: 100%;
  background: #eae9e4;
  padding: 20px 30px;
}

.logo a {
  font-size: 40px;
  font-weight: bold;
  text-transform: uppercase;
  color: #fff;
  line-height: 40px;
}
a {
  color: #1f1f1f;
  text-decoration: none !important;
  outline: none !important;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

ul,
li,
ol {
  margin: 0px;
  padding: 0px;
  list-style: none;
}

p {
  margin: 0px;
  font-weight: 500;
  font-size: 15px;
  line-height: 24px;
}

a {
  color: #222222;
  text-decoration: none;
  outline: none !important;
}

a,
.btn {
  text-decoration: none !important;
  outline: none !important;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

img {
  /* margin-left: -20%; */
  max-width: 100%;
  height: auto;
}

:focus {
  outline: 0;
}

.btn-custom {
  margin-top: 20px;
  background-color: transparent !important;
  border: 2px solid #ddd;
  padding: 12px 40px;
  font-size: 16px;
}

.navigation.navbar {
  padding: 0px;
}

.navigation.navbar-dark .navbar-nav .nav-link {
  padding: 0 50px;
  color: #3e93c3;
  font-size: 16px;
  line-height: 20px;
  font-weight: 500;
  text-transform: uppercase;
}

.navbar-dark .navbar-nav .nav-link:focus,
.navbar-dark .navbar-nav .nav-link:hover {
  color: #5a2f27 !important;
}

.navbar-expand-md .navbar-nav {
  padding-right: 10px;
}

.Call a {
  display: inline-block;
  padding: 7px 0;
  color: #5a2f27;
  font-size: 20px;
}
.yellow {
  color: #3e93c3;
  font-weight: bold;
}
</style>
