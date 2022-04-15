import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuetify from "./plugins/vuetify";
import Vuetify from 'vuetify/lib'
import axios from "axios";

axios.defaults.baseURL = "http://127.0.0.1:8000/api";
// axios.defaults.headers.get["Accept"] = "application/json";

Vue.config.productionTip = false;
Vue.use(Vuetify)

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount("#app");
