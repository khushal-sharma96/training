import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import VueRouter from 'vue-router'
import router from './routes'
import Swal from 'sweetalert2'
//Axios-------------------------->
import axios from 'axios'
axios.defaults.baseURL = "http://localhost/Training/CRUD_PDO/"
//------------------------------->
Vue.config.productionTip = false
Vue.use(VueRouter)
const eventBus = new Vue();
Vue.prototype.$eventBus = eventBus;
// Vue.use(VeeValidate)
Vue.prototype.$axios=axios;
new Vue({
  vuetify,
  router: router,
  Swal,
  render: h => h(App)
}).$mount('#app')


