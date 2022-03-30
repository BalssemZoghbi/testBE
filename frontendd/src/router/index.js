import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Dashboard from "../views/Dashboard.vue";
import Login from "../views/Login.vue";
import about from "../views/About.vue";
import Register from "../components/Auth/Register.vue";
import Forgot from "../components/Auth/Forgot.vue";
import Reset from "../components/Auth/Reset.vue";
import createProjet from "../components/donnees/generale/create.vue";
import updateProjet from "../components/donnees/generale/update.vue";
import Uni from "../views/Untitled-1.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: Dashboard,
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
    path: "/uni",
    name: "Uni",
    component: Uni,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/register",
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
