import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
// import jwtPagination from 'jw-vue-pagination'
// import Vue from 'vue'
// Vue.use(jwtPagination)
createApp(App).use(store).use(router).mount("#app");
