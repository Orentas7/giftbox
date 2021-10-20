import VueRouter from "vue-router";
import store from "./store.js";
import Home from './components/HomePage.vue';
import EnrolledCampaigns from './components/enrolledCampaigns/Index.vue';
import EnrolledCampaignsShow from './components/enrolledCampaigns/Show.vue';


import Campaigns from './components/campaigns/Index.vue';
import CampaignsCreate from './components/campaigns/Create.vue';
import CampaignsShow from './components/campaigns/Show.vue';

import GiftItems from './components/giftItems/Index.vue';
import GiftItemsCreate from './components/giftItems/Create.vue';
import GiftItemsShow from './components/giftItems/Show.vue';


export default new VueRouter({
    mode: 'history',
    routes: [
        { name:'home', path: '/giftbox/public', component: Home, beforeEnter: (to, from, next) => {
            store.dispatch('isAuth');
            next()
            }  },

        { name:'enrolledCampaigns', path: '/giftbox/public/enrolled-campaigns', component: EnrolledCampaigns, beforeEnter: (to, from, next) => {
            store.dispatch('isAuth');
            if(store.state.auth == false) {
                next({name: 'home'})               
            }else {;
                next()
            }
            } 
        },
        { name:'enrolledCampaignsShow', path: '/giftbox/public/enrolled-campaigns/:id', component: EnrolledCampaignsShow, beforeEnter: (to, from, next) => {
            store.dispatch('isAuth');
            if(store.state.auth == false) {
                next({name: 'home'})             
            }else {;
                next()
            }
            }  },

        { name:'campaigns', path: '/giftbox/public/campaigns', component: Campaigns, beforeEnter: (to, from, next) => {
            store.dispatch('isAuth');
            if(store.state.auth == false) {
                next({name: 'home'})  
            }else {;
                next()
            }
            }  },
        { name:'campaignsCreate', path: '/giftbox/public/campaigns/create', component: CampaignsCreate, beforeEnter: (to, from, next) => {
            store.dispatch('isAuth');
            if(store.state.auth == false) {
                next({name: 'home'})     
            }else {;
                next()
            }
            }  },
        { name:'campaignShow', path: '/giftbox/public/campaigns/:id', component: CampaignsShow, beforeEnter: (to, from, next) => {
            store.dispatch('isAuth');
            if(store.state.auth == false) {
                next({name: 'home'})  
            }else {;
                next()
            }
            }  },

        { name:'giftItems', path: '/giftbox/public/gift-items', component: GiftItems, beforeEnter: (to, from, next) => {
            store.dispatch('isAuth');
            if(store.state.auth == false) {
                next({name: 'home'})       
            }else {;
                next()
            }
            }  },
        { name:'giftItemsCreate', path: '/giftbox/public/gift-items/create', component: GiftItemsCreate, beforeEnter: (to, from, next) => {
            store.dispatch('isAuth');
            if(store.state.auth == false) {
                next({name: 'home'})  
            }else {;
                next()
            }
            }  },
        { name:'giftItemShow', path: '/giftbox/public/gift-items/:id', component: GiftItemsShow, beforeEnter: (to, from, next) => {
            store.dispatch('isAuth');
            if(store.state.auth == false) {
                next({name: 'home'})      
            }else {;
                next()
            }
            } 
         },

    ],
})