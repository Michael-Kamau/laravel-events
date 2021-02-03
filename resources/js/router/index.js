import Router from 'vue-router'
import Vue from 'vue'


import Index from '../pages/Index.vue'

import EventsHome from "../pages/events/EventsHome.vue";
import EventBook from "../pages/events/EventBook.vue";

import VenuesHome from "../pages/venues/VenuesHome.vue";
import VenueBook from "../pages/venues/VenueBook";
import VenuePayment from "../pages/venues/VenuePayment";

import ArtistsHome from "../pages/artists/ArtistsHome.vue";
import ArtistBook from "../pages/artists/ArtistBook";

//Event auth
import MyEvents from "../pages/auth/events_auth/MyEvents.vue"
import AddEvent from "../pages/auth/events_auth/AddEvent.vue";


//venues Auth
import MyVenues from "../pages/auth/venues_auth/MyVenues";
import AddVenue from "../pages/auth/venues_auth/AddVenue";
import ViewVenue from "../pages/auth/venues_auth/ViewVenue";


//Artists Auth
import ViewArtist from "../pages/auth/artists_auth/ViewArtist";
import ArtistBookings from "../pages/auth/artists_auth/ArtistBookings";



//Admin Auth
import EventManagers from "../pages/auth/admin_auth/EventManagers.vue";
import ArtistsManagers from "../pages/auth/admin_auth/ArtistManagers.vue";
import VenueManagers from "../pages/auth/admin_auth/VenueManagers.vue";


import Dashboard from "../pages/auth/Dashboard.vue";

import ErrorPage from "../pages/ErrorPage.vue";


Vue.use(Router)


// Vue.use(VModal);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'app',
            component: Index,
            children: []
        },
        {
            path: '/events',
            component: EventsHome,
            name: 'events',
            children: [
                {
                    path: '*',
                    name: 'errorEvents',
                    component: ErrorPage
                }
            ]
        },

        {
            path: '/event/:id',
            name: 'eventPage',
            component: EventBook
        },
        {
            path: '/venues',
            name: 'venues',
            component: VenuesHome
        },

        {
            path: '/venue/:id',
            name: 'venuePage',
            component: VenueBook
        },
        {
            path: '/venue/venuePayment/:id',
            name: 'venuePayment',
            component: VenuePayment
        },
        {
            path: '/artists',
            name: 'artists',
            component: ArtistsHome
        },
        {
            path: '/artists/:id',
            name: 'artistPage',
            component: ArtistBook
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            children: [
                {
                    name: 'myEvents',
                    path: '/dashboard/myEvents',
                    component: MyEvents
                },
                {
                    name: 'addEvent',
                    path: '/dashboard/addEvent',
                    component: AddEvent
                },
                {
                    name: 'eventManagers',
                    path: '/dashboard/event-managers',
                    component: EventManagers
                },
                {
                    name: 'venueManagers',
                    path: '/dashboard/venue-managers',
                    component: VenueManagers
                },
                {
                    name: 'myVenues',
                    path: '/dashboard/myVenues',
                    component: MyVenues

                },
                {
                    name: 'addVenue',
                    path: '/dashboard/addVenue',
                    component: AddVenue
                },
                {
                    name: 'viewVenue',
                    path: '/dashboard/viewVenue/:id',
                    component: ViewVenue
                },
                {
                    name: 'artistManagers',
                    path: '/dashboard/artists',
                    component: ArtistsManagers
                },
                {
                    name: 'viewArtist',
                    path: '/dashboard/artistProfile',
                    component: ViewArtist

                },
                {
                    name: 'artistBookings',
                    path: '/dashboard/artistBookings',
                    component: ArtistBookings
                }

            ]

        },

        {
            path: '*',
            name: 'error',
            component: ErrorPage
        }

    ]
})
