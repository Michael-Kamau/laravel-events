import Router from 'vue-router'
import Vue from 'vue'


import Index from '../components/Index.vue'
import EventsHome from "../components/events/EventsHome.vue";
import EventPage from "../components/events/EventPage.vue";
//Event auth
import MyEvents from "../components/auth/events_auth/MyEvents.vue"
import AddEvent from "../components/auth/events_auth/AddEvent.vue";

import VenuesHome from "../components/venues/VenuesHome.vue";

import ArtistsHome from "../components/artists/ArtistsHome.vue";

import Dashboard from "../components/auth/Dashboard.vue";

import ErrorPage from "../components/ErrorPage.vue";

Vue.use(Router)



// Vue.use(VModal);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'app',
            component: Index,
            children: [

            ]
        },
        {
            path: '/events',
            component: EventsHome,
            name:'events',
            children:[
                {
                    path: '*',
                    name: 'errorEvents',
                    component: ErrorPage
                }
            ]
        },

        {
            path: '/event/:id',
            name:'eventPage',
            component: EventPage
        },
        {
            path: '/venues',
            name:'venues',
            component: VenuesHome
        },
        {
            path: '/artists',
            name:'artists',
            component: ArtistsHome
        },
        {
            path: '/dashboard',
            name:'dashboard',
            component: Dashboard,
            children: [
                {
                    name:'myEvents',
                    path: '/dashboard/myEvents',
                    component: MyEvents
                },
                {
                    name:'addEvent',
                    path: '/dashboard/addEvent',
                    component: AddEvent
                },

            ]

        },

        {
            path: '*',
            name: 'error',
            component: ErrorPage
        }

        ]
})
