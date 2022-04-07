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
import updateElec from "../components/donnees/electrique/update.vue";
import createElec from "../components/donnees/electrique/create.vue";
import Uni from "../views/Untitled-1.vue";
import notFound from "../components/NotFound.vue";
import loginn from "../components/Auth/loginn.vue";
import updateGarantie from "../components/donnees/garantie/update.vue";
import Bobine from "../components/donnees/bobinage/update.vue";


Vue.use(VueRouter);

const routes = [
  {
    path: "*",
    name: "NotFound",
    component: notFound,
  },
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
    path: "/loginn",
    name: "loginn",
    component: loginn,
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
  {
    path: "/electrique/update/:id/:elec_id",
    name: "electrique.update",
    component: updateElec,
  },
  {
    path: "/electrique/create/:id",
    name: "electrique.create",
    component: createElec,
  },
  {
    path: "/garantie/:id",
    name: "garantie.update",
    component: updateGarantie,
  },
  {
    path: "/bobine/:id",
    name: "bobine.update",
    component: Bobine,
  },
];

const router = new VueRouter({
  routes,
});

export default router;
