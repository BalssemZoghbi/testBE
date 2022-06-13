<template>
  <nav>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant.sync="mini"
      permanent
      color="rgb(5 48 96)"
      dark
      app
    >
      <v-list-item class="px-2 pt-1">
        <v-list-item-avatar>
          <v-img
            src="../assets/sacem.jpg"
            width="900px"
            alt="admin"
            class="mx-auto"
          />
        </v-list-item-avatar>

        <v-list-item-title class="ml-4 text-capitalize"
          >SacemAutocite</v-list-item-title
        >
      </v-list-item>
      <v-list shaped class="clickable" v-if="user.type === 'admin'">
        <template v-for="item in items">
          <v-list-group
            v-if="item.children"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item['icon-ctr']"
            :append-icon="item.model ? item.icon : item['icon-alt']"
            active-class="orange--text"
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>
                  {{ item.text }}
                </v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="(child, i) in item.children"
              :key="i"
              route
              :to="child.route"
            >
              <v-list-item-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>
                  {{ child.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
          <v-list-item v-else :key="item.text" route :to="item.route">
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
      <v-list shaped class="clickable" v-else-if="user.type === 'employe'">
        <template v-for="item in itemsemploye">
          <v-list-group
            v-if="item.children"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item['icon-ctr']"
            :append-icon="item.model ? item.icon : item['icon-alt']"
            active-class="orange--text"
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>
                  {{ item.text }}
                </v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="(child, i) in item.children"
              :key="i"
              route
              :to="child.route"
            >
              <v-list-item-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>
                  {{ child.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
          <v-list-item v-else :key="item.text" route :to="item.route">
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar app color="rgb(5 48 96)" dark>
      <v-app-bar-nav-icon @click.stop="mini = !mini" class="clickable" />
      <v-toolbar-title class="text">
        <span
          class="hidden-sm-and-down"
          v-if="this.$route.path.indexOf('projet') <= 0"
          >SacemAutocite</span
        >
        <navbarUpdate
          :conducteurMT="this.conducteurMT"
          :conducteurBT="this.conducteurBT"
          :show="this.show"
          v-else
        />
      </v-toolbar-title>
      <v-spacer />
      <!-- <v-btn icon v-on:click="logout()"  class="clickable">
        <v-icon>mdi-file-import</v-icon>
      </v-btn> -->
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <span style="cursor: pointer" v-on="on">
            <v-chip link>
              <v-badge dot bottom color="green" offset-y="10" offset-x="10">
                <v-avatar size="40">
                   <img v-bind:src="'http://127.0.0.1:8000/Image/'+user.image" />
                   <!-- <img src="../../../backend/public/public/Image/photo_2022-06-02_23-00-10.jpg" /> -->
                  <!-- <v-icon v-on="on" dark>mdi-account-circle</v-icon> -->
                </v-avatar>
              </v-badge>
              <span class="ml-3">{{ user.name }}</span>
            </v-chip>
          </span>
        </template>
        <v-card class="mx-auto" max-width="300" tile>
          <v-list width="250" class="py-0">
            <!-- <v-subheader>Espace {{ user.name }}</v-subheader> -->
            <v-list-item two-line>
              <v-list-item-avatar>
                <!-- <img src="../assets/usericon.png" /> -->
                <v-btn
                  style="margin-left: 0% !important"
                  class="mx-2"
                  fab
                  dark
                  small
                  color="blue"
                >
                  <!-- <v-icon dark> mdi-account </v-icon> -->
                  <img v-bind:src="'http://127.0.0.1:8000/Image/'+user.image" style="width:40px;heigth:40px;margin-left: -2%;"/>
                   <!-- <img v-bind:src="'../../../backend/public/public/Image/'+user.image" /> -->
                  </v-btn
                >
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>{{ user.name }}</v-list-item-title>
                <v-list-item-subtitle>{{ user.type }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <v-divider />
            <v-spacer></v-spacer>
         <v-list-item router>
              <v-list-item-content style="margin-top: -3%">
                <v-list-item-title>
                  <v-btn icon class="clickable">
                    <v-icon medium color="black">mdi-account</v-icon>
                  </v-btn></v-list-item-title
                >
                <v-btn
                @click="$router.push('/profil')"
                  style="
                    margin-top: -18%;
                    margin-left: -20%;
                    border: 0px !important ;
                    box-shadow: 0px 0px !important;
                    background-color: transparent;
                    font-weight: 400;
                    font-size: 16px;
                    text-transform: capitalize;
                    color: black;
                  "
                >
                  Profile
                </v-btn>
              </v-list-item-content>
            </v-list-item>
            <v-list-item router>
              <v-list-item-content style="margin-top: -3%">
                <v-list-item-title>
                  <v-btn icon class="clickable">
                    <v-icon medium color="black">mdi-logout</v-icon>
                  </v-btn></v-list-item-title
                >
                <v-btn
                  v-on:click="logout()"
                  style="
                    margin-top: -18%;
                    border: 0px !important ;
                    box-shadow: 0px 0px !important;
                    background-color: transparent;
                    font-weight: 400;
                    font-size: 16px;
                    text-transform: capitalize;
                    color: black;
                  "
                >
                  Deconnexion
                </v-btn>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card>
      </v-menu>
    </v-app-bar>
    <v-btn
      v-scroll="onScroll"
      bottom
      color="grey"
      dark
      fab
      fixed
      right
      @click="toTop"
      class="clickable"
    >
      <v-icon>mdi-chevron-up</v-icon>
    </v-btn>
    <Footer />
  </nav>
</template>

<script>
import Footer from "@/components/Footer";
import navbarUpdate from "@/components/navbarUpdate";
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  components: {
    Footer,
    navbarUpdate,
  },
  data: () => ({
    search: "",
    token: null,
    user: "",
    email: "",
    drawer: null,
    mini: false,
    fab: false,
    items: [
      { icon: "mdi-home", text: "Tableau de bord", route: "/dashboard" },
      { icon: "fas fa-charging-station", text: "Projet", route: "/" },
      { icon: "folder_open", text: "Modele", route: "/modele" },
      { icon: "mdi-account", text: "Utilisateur", route: "/user" },
      {
        icon: "mdi-chevron-up",
        "icon-alt": "mdi-chevron-down",
        "icon-ctr": "fas fa-cogs",
        text: "Parametres",
        model: false,
        children: [
          { icon: "reorder", text: "Bobinages", route: "/saillie" },
          { icon: "widgets", text: "Garanties", route: "/garantie24" },
          { icon: "mdi-wrench", text: "Tole Magnetique", route: "/tole" },
        ],
      },
    ],
    itemsemploye: [
      { icon: "mdi-home", text: "Tableau de bord", route: "/dashboardEmploye" },
      { icon: "fas fa-charging-station", text: "projet", route: "/" },
      { icon: "folder_open", text: "Modele", route: "/modele" },
    ],
  }),
  async created() {
    const response = await axios.get("user");
    this.$store.dispatch("user", response.data);
    this.user = response.data;
    console.log(this.user.image);
  },
  computed: {
    ...mapGetters(["user"]),
  },
  methods: {
    logout() {
      localStorage.removeItem("token");
      localStorage.removeItem("user");
      this.$store.dispatch("user", null);
      this.$router.push("/Connexion");
    },
    onScroll(e) {
      if (typeof window === "undefined") return;
      const top = window.pageYOffset || e.target.scrollTop || 0;
      this.fab = top > 20;
    },
    toTop() {
      this.$vuetify.goTo(0);
    },
  },
  props: ["conducteurMT", "conducteurBT", "show"],
};
</script>

<style>
.clickable {
  -webkit-app-region: no-drag;
}
::-webkit-scrollbar {
  width: 12px;
}
::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  border-radius: 10px;
}
::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
}
.v-application .orange--text {
  color: #6791d6 !important;
  caret-color: #063b77 !important;
}

.theme--dark.v-chip:not(.v-chip--active) {
  background: #063b77 !important;
}
</style>
