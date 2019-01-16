
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.events = new Vue();
window.noty = function (notification) {
    window.events.$emit('notification',notification)
}
window.handelError = function(error){
    if(error.response.status == 422){
        window.noty({
            message:"You had validation error",
            type:"danger"
        })
    }
    window.noty({
        message:"Something wrong please try again",
        type:"danger"
    })
}
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('login-vue', require('./components/login.vue'));
Vue.component('lessons-vue', require('./components/lessons.vue'));
Vue.component('vue-noty', require('./components/noty.vue'));
Vue.component('vimeo-player',require('./components/Player.vue'));

const app = new Vue({
    el: '#app'
});
