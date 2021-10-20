require('./bootstrap');


import Vuetify from "../plugins/vuetify"
import router from "./routes"

// Vue.component('home-page', require('./components/HomePage.vue').default);

// Vue.component('enrolled-campaigns', require('./components/enrolledCampaigns/Index.vue').default);
// Vue.component('enrolled-campaigns-show', require('./components/enrolledCampaigns/Show.vue').default);

// Vue.component('campaigns-index', require('./components/campaigns/Index.vue').default);
// Vue.component('campaigns-create', require('./components/campaigns/Create.vue').default);
// Vue.component('campaigns-show', require('./components/campaigns/Show.vue').default);

// Vue.component('gift-item-index', require('./components/giftItems/Index.vue').default);
// Vue.component('gift-item-create', require('./components/giftItems/Create.vue').default);
// Vue.component('gift-item-show', require('./components/giftItems/Show.vue').default);

Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
});
import store from "./store.js"

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router,
    store    
});
