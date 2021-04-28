/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import router from './routes';
import store from './store/index';
import './interceptors';
import  './middlewares';
import Select2 from 'v-select2-component';
import VueSweetalert2 from 'vue-sweetalert2';
import { localize,extend } from 'vee-validate';
import es from 'vee-validate/dist/locale/es.json';
import { Settings } from 'luxon'
import Multiselect from 'vue-multiselect'
import VModal from 'vue-js-modal'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'
import VueMoment from 'vue-moment'
import moment from 'moment-timezone'
import VueLodash from 'vue-lodash'
import lodash from 'lodash'
moment.tz.setDefault('America/Cancun')
moment.locale('es');


// Install and Activate the Arabic locale.
localize("es", es);
Settings.defaultLocale = "es";

window.Vue = require("vue");
Vue.use(Select2);
Vue.use(VueSweetalert2);
Vue.use(VueMoment, {
    moment,
})
Vue.use(VModal, { dynamicDefault: { draggable: true, resizable: true } })
Vue.component('multiselect', Multiselect);
Vue.use(VueLodash, { name: 'custom' , lodash: lodash })

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component("login-component", require("./views/Login/index.vue").default);
Vue.component(
    "dashboard-component",
    require("./views/Dashboard/index.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    store,
});