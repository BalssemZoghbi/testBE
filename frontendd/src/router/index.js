import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Dashboard from "../views/Dashboard.vue";
import DashboardEmploye from "../views/DashboardEmploye.vue";
import about from "../views/About.vue";
import Forgot from "../components/Auth/Forgot.vue";
import Reset from "../components/Auth/Reset.vue";
import updateProjet from "../components/donnees/generale/update.vue";
import updateElec from "../components/donnees/electrique/update.vue";
import Uni from "../views/Untitled-1.vue";
import notFound from "../components/NotFound.vue";
import Connexion from "../components/Auth/Connexion.vue";
import updateGarantie from "../components/donnees/garantie/update.vue";
import updateGradin from "../components/calcul/gradin/update.vue";
import tole from "../components/calcul/gradin/tole.vue";
import updateVolt from "../components/calcul/voltspire/update.vue";

import Bobine from "../components/donnees/bobinage/update.vue";
import bobinage from "../components/donnees/bobinage/updateCalcul.vue";
import bobinagePrimaireRond from "../components/donnees/bobinage/BobinagePrimaire/RondEmaille.vue";
import bobinagePrimaireFeuillard from "../components/donnees/bobinage/BobinagePrimaire/Feuillard.vue";
import bobinagePrimaireMeplat from "../components/donnees/bobinage/BobinagePrimaire/MeplatGuipe.vue";
import bobinageSecondaireRond from "../components/donnees/bobinage/BobinageSecondaire/RondEmaille.vue";
import bobinageSecondaireFeuillard from "../components/donnees/bobinage/BobinageSecondaire/Feuillard.vue";
import bobinageSecondaireMeplat from "../components/donnees/bobinage/BobinageSecondaire/MeplatGuipe.vue";

import User from "../components/user/User.vue";
import Profile from '@/components/Profile';

import Demande from "../components/user/demande.vue";
import garantie24 from "../components/donnees/garantie/garantie24.vue";
import garantie36 from "../components/donnees/garantie/garantie36.vue";
import saillie from "../components/donnees/bobinage/saillie.vue";
import Hbrin from "../components/donnees/bobinage/hbrin.vue";
import barre from "../components/donnees/bobinage/barre.vue";
import updatecourcircuit from "../components/calcul/Pcc/Ucc/update.vue";
import updatecircuitmag from "../components/calcul/circuitMagnetique/update.vue";
import t from "../components/t.vue";
Vue.use(VueRouter);

const routes = [
  {
    path: "/t",
    name: "t",
    component: t,
  },
  {
    path: "/profil",
    name: "profil",
    component: Profile,
  },
  {
    path: "/tole",
    name: "tole",
    component: tole,
  },
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
    path: "/barre",
    name: "barre",
    component: barre,
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
    path: "/notfound",
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
    path: "/dashboardEmploye",
    name: "dashboardEmploye",
    component: DashboardEmploye,
  },
  {
    path: "/Connexion",
    name: "Connexion",
    component: Connexion,
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
    path: "/electrique/update/:id",
    name: "electrique.update",
    component: updateElec,
  },

  {
    path: "/pccucc/:id",
    name: "courcircuit.update",
    component: updatecourcircuit,
  },
  {
    path: "/cm/:id",
    name: "circuitmag.update",
    component: updatecircuitmag,
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
    path: "/bobinagePrimaireRond/:id",
    name: "bobinagePrimaireRond.update",
    component: bobinagePrimaireRond,
  },
  {
    path: "/bobinagePrimaireFeuillard/:id",
    name: "bobinagePrimaireFeuillard.update",
    component: bobinagePrimaireFeuillard,
  },
  {
    path: "/bobinagePrimaireMeplat/:id",
    name: "bobinagePrimaireMeplat.update",
    component: bobinagePrimaireMeplat,
  },
  {
    path: "/bobinageSecondaireRond/:id",
    name: "bobinageSecondaireRond.update",
    component: bobinageSecondaireRond,
  },
  {
    path: "/bobinageSecondaireFeuillard/:id",
    name: "bobinageSecondaireFeuillard.update",
    component: bobinageSecondaireFeuillard,
  },
  {
    path: "/bobinageSecondaireMeplat/:id",
    name: "bobinageSecondaireMeplat.update",
    component: bobinageSecondaireMeplat,
  },
  {
    path: "/bobinecal/:id",
    name: "bobine",
    component: bobinage,
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
