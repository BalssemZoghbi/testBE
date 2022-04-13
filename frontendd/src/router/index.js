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
import updateGradin from "../components/calcul/gradin/update.vue";
import updateVolt from "../components/calcul/voltspire/update.vue";

import Bobine from "../components/donnees/bobinage/update.vue";
import User from "../components/user/User.vue";

import Demande from "../components/user/demande.vue";
import garantie24 from "../components/garantie24.vue";
import garantie36 from "../components/garantie36.vue";
import saillie from "../components/donnees/bobinage/saillie.vue";
import Hbrin from "../components/donnees/bobinage/hbrin.vue";
Vue.use(VueRouter);

const routes = [
  {
    path: "/garantie24",
    name: "garantie24",
    component: garantie24,
  },
  {
    path: "/garantie36",
    name: "garantie36",
    component: garantie36,
  },
  {
    path: "/saillie",
    name: "saillie",
    component: saillie,
  },
  {
    path: "/Hbrin",
    name: "Hbrin",
    component: Hbrin,
  },
  {
    path: "/demande",
    name: "Demande",
    component: Demande,
  },
  {
    path: "/user",
    name: "User",
    component: User,
  },
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
  {
    path: "/gradin/:id",
    name: "gradin.update",
    component: updateGradin,
  },
  {
    path: "/VoltSpires/:id",
    name: "volt.update",
    component: updateVolt,
  },
];

const router = new VueRouter({ 
  mode: "history",
  routes,
});

export default router;
