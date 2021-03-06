import Vue from 'vue';
import VueCollapse from 'vue2-collapse';
import i18n from './lib/i18n';
import App from './App.vue';
import router from './router';
import store from './store';
import './assets/css/compliant.css';
import './assets/css/ui-kit.css';

Vue.use(VueCollapse);

Vue.config.productionTip = process.env.NODE_ENV === 'production';

new Vue({
  router,
  store,
  i18n,
  render: h => h(App),
}).$mount('#app');
