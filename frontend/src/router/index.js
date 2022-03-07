import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import createProjet from "../components/createProjet.vue";
import updateProjet from "../components/updateProjet.vue";
import about from "../views/About.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/projet/:id",
    name: "projet.about",
    component: about,
  },
  {
    path: "/projet/create",
    name: "projet.create",
    component: createProjet,
  },
  {
    path: "/projet/update/:id",
    name: "projet.update",
    component: updateProjet,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
