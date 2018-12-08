
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/********************************************Base Start************************************************/
require('./bootstrap');
window.Vue = require('vue');

import HeyUI from 'heyui';
Vue.use(HeyUI);
import 'heyui/themes/index.css';
/********************************************Base End**************************************************/

/********************************************Tools Start***********************************************/
//vform
import {Form,HasError} from 'vform';
window.Form = Form;
//vue-progressbar
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar,{color:'rgb(143,255,199)', failedColor:'red', height:'2px'});
/********************************************Tools End************************************************/

/**************************************Global Components Start****************************************/
Vue.component(HasError.name, HasError);
Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));
Vue.component('example-component', require('./components/Dashboard.vue'));
/**************************************Global Components End***************************************/
/******************************************Router Start********************************************/
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import routes from './routes/index.js';
const router = new VueRouter({
    mode:'history',
    routes
});
/*********************************************Router End******************************************/
/**
 * 可以在此处就请求到用户拥有的权限，然后存在localStorage里，
 * 粗粒度的菜单权限可以直接在master.blade.php布局里就过滤
 * 细粒度的权限可以在vue 的 v-if 方法来根据localStorage里的和具体某个权限进行判断
 */
//axios.get('api/user/profile').then(({data})=>{
//    console.log(data);
//}).catch();

const app = new Vue({
    el: '#app',
    router,
});
