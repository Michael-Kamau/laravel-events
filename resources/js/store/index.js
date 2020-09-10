import Vuex from 'vuex'
import Vue from 'vue'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token: null,
        allEvents: null,
        userEvents: null,
        userDetails:[],
        roles: []

    },

    getters: {
        getAllEvents(state) {
            return state.allEvents
        },

        getUserEvents(state){
            return state.userEvents
        },

        getUserRoles(state){
            return state.roles
        }



    },

    actions: {

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


    },

    mutations: {

        getAllEvents(state, payload) {
            state.allEvents = payload.data
        },
        getUserEvents(state, payload) {
            state.userEvents = payload.data
        },

        checkRole(state, payload) {
            state.roles = payload
        }

    }
})
