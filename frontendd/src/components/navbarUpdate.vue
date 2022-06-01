<template>
  <header>
    <div class="container">
      <input type="checkbox" name="" id="check" />
      <div class="nav-btn">
        <div class="nav-links">
          <ul>
            <li class="nav-link" style="--i: 1.1s">
              <a href="#">Données <i class="fas fa-caret-down"></i></a>
              <div class="dropdown">
                <ul>
                  <li class="dropdown-link" v-if="this.show == 'false'">
                    <router-link
                      :to="'/projet/update/' + this.$route.params.id"
                    >
                      Generale</router-link
                    >
                  </li>
                  <li class="dropdown-link" v-if="this.show == 'true'">
                    <router-link
                      :to="'/projet/updateModele/' + this.$route.params.id"
                    >
                      Generale</router-link
                    >
                  </li>
                  <li class="dropdown-link">
                    <router-link
                      :to="'/projet/electrique/update/' + this.$route.params.id"
                    >
                      Electriques</router-link
                    >
                  </li>
                  <li class="dropdown-link">
                    <router-link
                      :to="'/projet/garantie/' + this.$route.params.id"
                    >
                      Garantie</router-link
                    >
                  </li>
                  <li class="dropdown-link">
                    <router-link
                      :to="'/projet/bobine/' + this.$route.params.id"
                    >
                      Bobinage
                    </router-link>
                  </li>
                  <div class="arrow"></div>
                </ul>
              </div>
            </li>
            <li class="nav-link" style="--i: 1.1s">
              <a href="#">Calcul<i class="fas fa-caret-down"></i></a>
              <div class="dropdown">
                <ul>
                  <li class="dropdown-link">
                    <router-link :to="'/projet/gradin/' + this.$route.params.id"
                      >Gradin</router-link
                    >
                  </li>

                  <li class="dropdown-link">
                    <router-link
                      :to="'/projet/VoltSpires/' + this.$route.params.id"
                      >Volt Spires</router-link
                    >
                  </li>

                  <li
                    class="dropdown-link"
                    v-if="conducteurBT == 'Rond emaille'"
                  >
                    <router-link
                      :to=" '/projet/bobinageSecondaireRond/' +this.$route.params.id"
                      >Bobine Secondaire</router-link
                    >
                  </li>
                  <li
                    class="dropdown-link"
                    v-else-if="conducteurBT == 'feuillard'"
                  >
                    <router-link
                      :to="'/projet/bobinageSecondaireFeuillard/' +this.$route.params.id"
                      >Bobine Secondaire</router-link
                    >
                  </li>
                  <li
                    class="dropdown-link"
                    v-else-if="conducteurBT == 'meplat guipé'"
                  >
                    <router-link :to="'/projet/bobinageSecondaireMeplat/' +this.$route.params.id">Bobine Secondaire</router-link>
                  </li>
                  <li class="dropdown-link" v-else>
                    <router-link to="/notfound">Bobine Secondaire</router-link>
                  </li>

                  <li
                    class="dropdown-link"
                    v-if="conducteurMT == 'Rond emaille'"
                  >
                    <router-link
                      :to="'/projet/bobinagePrimaireRond/' + this.$route.params.id"
                      >Bobine Primaire</router-link
                    >
                  </li>
                  <li
                    class="dropdown-link"
                    v-else-if="conducteurMT == 'feuillard'"
                  >
                    <router-link
                      :to="'/projet/bobinagePrimaireFeuillard/' +this.$route.params.id"
                      >Bobine Primaire</router-link
                    >
                  </li>
                  <li
                    class="dropdown-link"
                    v-else-if="conducteurMT == 'meplat guipé'"
                  >
                    <router-link
                      :to="'/projet/bobinagePrimaireMeplat/' + this.$route.params.id"
                      >Bobine Primaire</router-link
                    >
                  </li>
                  <li class="dropdown-link" v-else>
                    <router-link to="/notfound">Bobine Primaire</router-link>
                  </li>
                  <li class="dropdown-link">
                    <router-link :to="'/projet/pccucc/' + this.$route.params.id"
                      >PCC et UCC</router-link
                    >
                  </li>
                  <li class="dropdown-link">
                    <router-link :to="'/projet/cm/' + this.$route.params.id"
                      >Circuit Magnetique</router-link
                    >
                  </li>

                  <div class="arrow"></div>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="hamburger-menu-container">
        <div class="hamburger-menu">
          <div></div>
        </div>
      </div>
    </div>
  </header>
</template>
<script>
export default {
  name: "navbarcreate",
  data: () => ({
    id: undefined,
    show: false,
  }),
  props: ["conducteurMT", "conducteurBT"],
  created() {
    this.show = localStorage.getItem("show");
    console.log(this.conducteurMT, this.conducteurBT, this.show);
  },
};
</script>
<style scoped>
ul {
  list-style: none;
}

a {
  text-decoration: none;
  color: white;
}

header {
  position: sticky;
  top: 0px;
  background-color: transparent;
  width: 100%;
  z-index: 1000;
}

.container {
  max-width: 100%;
  padding: 0 1rem;
  margin: 0 auto;
  display: flex;
  position: relative;
}

.nav-btn {
  flex: 3;
  display: flex;
}

.nav-links {
  flex: 2;
}

.btn {
  display: inline-block;
  padding: 0.5rem 1.3rem;
  font-size: 0.8rem;
  border: 2px solid #fff;
  border-radius: 2rem;
  line-height: 1;
  margin: 0 0.2rem;
  transition: 0.3s;
  text-transform: uppercase;
}

.btn.solid,
.btn.transparent:hover {
  background-color: #fff;
  color: #69bde7;
}

.btn.transparent,
.btn.solid:hover {
  background-color: transparent;
  color: #fff;
}

.nav-links > ul {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
}

.nav-link {
  position: relative;
}

.nav-link > a {
  line-height: 3rem;
  color: #fff;
  background-color: rgb(5, 48, 96);
  padding: 0 0.8rem;
  letter-spacing: 1px;
  font-size: 0.95rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  transition: 0.5s;
}

.nav-link > a > i {
  margin-left: 0.2rem;
}

.nav-link:hover > a {
  transform: scale(1.1);
}

.dropdown {
  position: fixed;
  top: 100%;
  /* left: 0; */
  width: 10rem;
  transform: translateY(10px);
  opacity: 0;
  pointer-events: none;
  transition: 0.5s;
}

.dropdown ul {
  position: relative;
}

.dropdown-link > a {
  display: flex;
  background-color: #fff;
  color: rgb(5, 48, 96);
  padding: 0.5rem 1rem;
  font-size: 0.9rem;
  align-items: center;
  justify-content: space-between;
  transition: 0.3s;
}

.dropdown-link:hover > a {
  background-color: rgb(5, 48, 96);
  color: #fff;
}

.dropdown-link:not(:nth-last-child(2)) {
  border-bottom: 1px solid #efefef;
}

.dropdown-link i {
  transform: rotate(-90deg);
}

.arrow {
  position: absolute;
  width: 11px;
  height: 11px;
  top: -5.5px;
  left: 32px;
  background-color: #fff;
  transform: rotate(45deg);
  cursor: pointer;
  transition: 0.3s;
  z-index: -1;
}

.dropdown-link:first-child:hover ~ .arrow {
  background-color: rgb(5, 48, 96);
}

.dropdown-link {
  position: relative;
}

.dropdown.second {
  top: 0;
  left: 100%;
  padding-left: 0.8rem;
  cursor: pointer;
  transform: translateX(10px);
}

.dropdown.second .arrow {
  top: 10px;
  left: -5.5px;
}

.nav-link:hover > .dropdown,
.dropdown-link:hover > .dropdown {
  transform: translate(0, 0);
  opacity: 1;
  pointer-events: auto;
}

.hamburger-menu-container {
  flex: 1;
  display: none;
  align-items: center;
  justify-content: flex-end;
}

.hamburger-menu {
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  align-items: center;
  justify-content: flex-end;
}
.hamburger-menu div {
  width: 0.9rem;
  height: 2px;
  border-radius: 3px;
  /* background-color: #fff; */
  position: relative;
  z-index: 1001;
  margin-right: 57px;
  transition: 0.5s;
}
/* .hamburger-menu div{
    width: 1.6rem;
    height: 3px;
    border-radius: 3px;
    background-color: #fff;
    position: relative;
    z-index: 1001;
    transition: .5s;
} */

.hamburger-menu div:before,
.hamburger-menu div:after {
  content: "";
  position: absolute;
  width: inherit;
  height: inherit;
  background-color: #fff;
  border-radius: 3px;
  transition: 0.5s;
}

.hamburger-menu div:before {
  transform: translateY(-7px);
}

.hamburger-menu div:after {
  transform: translateY(7px);
}

#check {
  position: absolute;
  top: 50%;
  right: 1.5rem;
  transform: translateY(-50%);
  width: 2.5rem;
  height: 2.5rem;
  z-index: 90000;
  cursor: pointer;
  opacity: 0;
  display: none;
}

#check:checked ~ .hamburger-menu-container .hamburger-menu div {
  background-color: transparent;
}

#check:checked ~ .hamburger-menu-container .hamburger-menu div:before {
  transform: translateY(0) rotate(-45deg);
}

#check:checked ~ .hamburger-menu-container .hamburger-menu div:after {
  transform: translateY(0) rotate(45deg);
}

@keyframes animation {
  from {
    opacity: 0;
    transform: translateY(15px);
  }
  to {
    opacity: 1;
    transform: translateY(0px);
  }
}

@media (max-width: 920px) {
  .hamburger-menu-container {
    display: flex;
  }

  #check {
    display: block;
  }

  .nav-btn {
    position: fixed;
    height: calc(100vh - 3rem);
    top: 3rem;
    left: 0;
    width: 100%;
    /* background-color: #69bde7; */
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    overflow-x: hidden;
    overflow-y: auto;
    transform: translateX(100%);
    transition: 0.65s;
  }

  #check:checked ~ .nav-btn {
    transform: translateX(0);
  }

  #check:checked ~ .nav-btn .nav-link,
  #check:checked ~ .nav-btn {
    animation: animation 0.5s ease forwards var(--i);
  }

  .nav-links {
    flex: initial;
    width: 100%;
  }

  .nav-links > ul {
    flex-direction: column;
  }

  .nav-link {
    width: 100%;
    opacity: 0;
    transform: translateY(15px);
  }

  .nav-link > a {
    line-height: 1;
    padding: 1.6rem 2rem;
  }

  .nav-link:hover > a {
    transform: scale(1);
    background-color: rgb(5, 48, 96);
  }

  .dropdown,
  .dropdown.second {
    position: initial;
    top: initial;
    left: initial;
    transform: initial;
    opacity: 1;
    pointer-events: auto;
    width: 100%;
    padding: 0;
    background-color: rgb(4, 41, 83);
    display: none;
  }

  .nav-link:hover > .dropdown,
  .dropdown-link:hover > .dropdown {
    display: block;
  }

  .nav-link:hover > a > i,
  .dropdown-link:hover > a > i {
    transform: rotate(360deg);
  }

  .dropdown-link > a {
    background-color: transparent;
    color: #fff;
    padding: 1.2rem 2rem;
    line-height: 1;
  }

  .dropdown.second .dropdown-link > a {
    padding: 1.2rem 2rem 1.2rem 3rem;
  }

  .dropdown.second .dropdown.second .dropdown-link > a {
    padding: 1.2rem 2rem 1.2rem 4rem;
  }

  .dropdown-link:not(:nth-last-child(2)) {
    border-bottom: none;
  }

  .arrow {
    z-index: 1;
    background-color: #69bde7;
    left: 10%;
    transform: scale(1.1) rotate(45deg);
    transition: 0.5s;
  }

  .nav-link:hover .arrow {
    background-color: rgb(169, 187, 200);
  }

  .dropdown .dropdown .arrow {
    display: none;
  }

  .dropdown-link:hover > a {
    background-color: rgb(7, 55, 110);
  }

  .dropdown-link:first-child:hover ~ .arrow {
    background-color: rgb(169, 187, 200);
  }

  .nav-link > a > i {
    font-size: 1.1rem;
    transform: rotate(-90deg);
    transition: 0.7s;
  }

  .dropdown i {
    font-size: 1rem;
    transition: 0.7s;
  }
}
</style>
