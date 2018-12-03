
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../../../node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js');
require('../../../node_modules/admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js');
require('../../../node_modules/admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
require('../../../node_modules/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');
require('../../../node_modules/chart.js/');
require('../../../node_modules/admin-lte/bower_components/fastclick/lib/fastclick.js');
require('../../../node_modules/admin-lte/dist/js/adminlte.min.js');
require('../../../node_modules/admin-lte/dist/js/demo.js');



window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

/*const app = new Vue({
    el: '#app'
});*/
