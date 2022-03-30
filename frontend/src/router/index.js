import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Dashboard from "../views/Dashboard.vue";
import Login from "../views/Login.vue";
import Forgot from "../views/Forgot.vue";
import Reset from "../views/Reset.vue";
import Register from "../views/Register.vue";
import about from "../views/About.vue";
import createProjet from "../components/donnees/generale/create.vue";
import updateProjet from "../components/donnees/generale/update.vue";
Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: Dashboard,
  },
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/reset/:token",
    name: "Reset",
    component: Reset,
  },
  {
    path: "/forgot",
    name: "Forgot",
    component: Forgot,
  },
  {
    path: "/Register",
    name: "Register",
    component: Register,
  },
  {
    path: "/projet/create",
    name: "projet.create",
    component: createProjet,
  },
  {
    path: "/projet/:id",
    name: "projet.about",
    component: about,
  },
 
  {
    path: "/projet/update/:id",
    name: "projet.update",
    component: updateProjet,
  },
];

const router = new VueRouter({
  routes,
});

export default router;

