import Router from 'vue-router'
import Vue from 'vue'


import Index from '../components/Index.vue'
import EventsHome from "../components/events/EventsHome.vue";
import Event from "../components/events/Event.vue";
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
                    path: 'event',
                    name:'event',
                    component: Event
                },
                {
                    path: '*',
                    name: 'errorEvents',
                    component: ErrorPage
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
