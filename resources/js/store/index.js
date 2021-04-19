import Vuex from 'vuex'
import Vue from 'vue'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token: null,
        allEvents: [],
        userEvents: [],
        allVenues:[],
        userVenues:[],
        allArtists:[],
        userArtist:[],
        userDetails:[],
        roles: []

    },

    getters: {
        getUserRoles(state){
            return state.roles
        },

        getAllEvents(state) {
            return state.allEvents
        },

        getUserEvents(state){
            return state.userEvents
        },

        getAllVenues(state){
            return state.allVenues
        },

        getUserVenues(state){
         return state.userVenues
        },

        getAllArtists(state){
            return state.allArtists
        },

        getAnArtist: (state) => (id) => {
            return state.allArtists.filter(artist=>artist.id === id)
        },

        getUserArtists(state){
            return state.userArtist
        }



    },

    actions: {

        checkRole(state) {
            axios.get(`/api/user/roles`)
                .then(response => {
                    console.log('Roles',response.data)
                    state.commit('checkRole', response.data)
                }).catch(e => {
                //this.errors.push(e)
                console.log(e)
            })
        },

        getAllEvents(state) {
            axios.get(`/api/events`)
                .then(response => {
                    console.log(response.data)
                    let events = response.data
                    state.commit('getAllEvents', events)
                }).catch(e => {
                console.log(e)
            })

        },

        getUserEvents(state) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/events/userEvents`)
                    .then(response => {
                        console.log(response.data)
                        state.commit('getUserEvents', response.data)
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            })

        },
        addEvent(state, payload) {
            console.log(payload)
            return new Promise((resolve, reject) => {
                axios.post(`/api/events/create`, payload)
                    .then(response => {
                        console.log(response)
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            })

        },

        getAllVenues(state) {
            axios.get(`/api/venues`)
                .then(response => {
                    console.log(response.data)
                    let venues = response.data
                    state.commit('getAllVenues', venues)
                }).catch(e => {
                console.log(e)
            })

        },


        getUserVenues(state){
            axios.get('/api/venues/userVenues')
                .then(response => {
                    console.log(response.data)
                    let userVenues = response.data
                    state.commit('getUserVenues', userVenues)
                }).catch(e => {
                    console.log(e)
            })
        },


        addVenue(state, payload) {
            console.log(payload)
            return new Promise((resolve, reject) => {
                axios.post(`/api/venues/create`, payload)
                    .then(response => {
                        console.log(response)
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            })

        },


        getAllArtists(state) {
            axios.get(`/api/artists`)
                .then(response => {
                    console.log(response.data)
                    let venues = response.data
                    state.commit('getAllArtists', venues)
                }).catch(e => {
                console.log(e)
            })

        },


        getUserArtist(state){
            axios.get('/api/artists/profile')
                .then(response => {
                    console.log(response.data)
                    let userArtist = response.data
                    state.commit('getUserArtist', userArtist)
                }).catch(e => {
                console.log(e)
            })
        },

        editArtist(state, payload) {
            console.log(payload)
            return new Promise((resolve, reject) => {
                axios.post(`/api/artists/edit`, payload)
                    .then(response => {
                        console.log(response)
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            })

        },


        addVideo(state, payload) {
            return new Promise((resolve, reject) => {
                axios.post(`/video/save`, payload)
                    .then(response => {
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                })
            })

        },
        deleteVideo(state, imageId) {
            return new Promise((resolve, reject) => {
                axios.get(`/video/delete/`+imageId)
                    .then(response => {
                        console.log(response)
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            })

        }


    },

    mutations: {

        checkRole(state, payload) {
            state.roles = payload
        },
        getAllEvents(state, payload) {
            state.allEvents = payload.data
        },

        getUserEvents(state, payload) {
            state.userEvents = payload.data
        },

        getAllVenues(state, payload) {
            state.allVenues = payload.data
        },

        getUserVenues(state, payload) {
            state.userVenues = payload.data
        },

        getAllArtists(state, payload) {
            state.allArtists = payload.data
        },

        getUserArtist(state, payload) {
            state.userArtist = payload.data
        }

    }
})
