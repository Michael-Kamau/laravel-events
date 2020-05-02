import Router from 'vue-router'
import Vue from 'vue'


import Index from '../components/Index.vue'
import EventsHome from "../components/events/EventsHome.vue";
import EventBook from "../components/events/EventBook.vue";

//Event auth
import MyEvents from "../components/auth/events_auth/MyEvents.vue"
import AddEvent from "../components/auth/events_auth/AddEvent.vue";


//venues Auth
import VenuesHome from "../components/venues/VenuesHome.vue";


//Artists Auth
import ArtistsHome from "../components/artists/ArtistsHome.vue";

//Admin Auth
import EventManagers from "../components/auth/admin_auth/EventManagers.vue";
import ArtistsManagers from "../components/auth/admin_auth/ArtistManagers.vue";
import VenueManagers from "../components/auth/admin_auth/VenueManagers.vue";




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
            component: EventBook
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
                {
                    name:'eventManagers',
                    path: '/dashboard/event-managers',
                    component: EventManagers
                },
                {
                    name:'artistManagers',
                    path: '/dashboard/artists',
                    component: ArtistsManagers
                },
                {
                    name:'venueManagers',
                    path: '/dashboard/venue-managers',
                    component: VenueManagers
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
