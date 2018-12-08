
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import {Form,HasError,AlertError} from 'vform';

window.Form = Form;

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);


import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar,{
    color:'rgb(143,255,199)',
    failedColor:'red',
    height:'2px'
});

import swal from 'sweetalert2'
window.swal = swal;
const toast = swal.mixin({
    toast:true,
    position:'top-end',
    showConfirmButton:false,
    timer:3000
});
window.toast = toast;


let routes = [
    {path:'/dashboard',component:require('./components/Dashboard.vue')},
    {path:'/users',component:require('./components/Users.vue')},
    {path:'/profile',component:require('./components/Profile.vue')},
    {path:'/developer',component:require('./components/Developer.vue')},
];
const router = new VueRouter({
    mode:'history',
    routes
});

Vue.filter('upText',(text)=>text.charAt(0).toUpperCase()+text.slice(1));
Vue.filter('myDate',(dateString)=>moment(dateString).format('MMMM Do YY'));

window.Fire = new Vue();


Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))
/**
 * 可以在此处就请求到用户拥有的权限，然后存在localStorage里，
 * 粗粒度的菜单权限可以直接在master.blade.php布局里就过滤
 * 细粒度的权限可以在vue 的 v-if 方法来根据localStorage里的和具体某个权限进行判断
 */
//axios.get('api/user/profile').then(({data})=>{
//    console.log(data);
//}).catch();


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    methods: {
        beforeLeave(element) {
            this.prevHeight = getComputedStyle(element).height;
        },
        enter(element) {
            const { height } = getComputedStyle(element);

            element.style.height = this.prevHeight;

            setTimeout(() => {
                element.style.height = height;
            });
        },
        afterEnter(element) {
            element.style.height = 'auto';
        },
    },
});
