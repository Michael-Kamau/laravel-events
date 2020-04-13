import Vuex from 'vuex'
import Vue from 'vue'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token:null,
        allEvents:null,
        myVouchers:null,
        myRedeemedVouchers:null,
        admin:null

    },

    getters: {
        getAllEvents(state){
            return state.allEvents
        },
        getMyVouchers(state){
            return state.myVouchers
        },
        getMyRedeemed(state){
            return state.myRedeemedVouchers
        },
        getIfAdmin(state){
            return state.admin
        }




    },

    actions: {

        getAllEvents(state) {
            axios.get(`http://events.appp/api/events`)
                .then(response => {
                    console.log(response.data)
                    let events = response.data
                    state.commit('getAllEvents', events)
                }).catch(e => {
                console.log(e)
            })


        },
        getMyVouchers(state) {
            axios.get(`/api/voucher/bought`)
                .then(response => {
                    console.log(response.data)
                    let vouchers = response.data
                    state.commit('getMyVouchers', vouchers)
                }).catch(e => {
                console.log(e)
            })


        },
        getRedeemedVouchers(state) {
            axios.get(`/api/voucher/redeemed`)
                .then(response => {
                    console.log(response.data)
                    let vouchers = response.data
                    state.commit('getRedeemedVouchers', vouchers)
                }).catch(e => {
                console.log(e)
            })


        },
        buyVoucher(state,payload){
            return new Promise((resolve, reject) => {
                axios.post(`/api/voucher/buy`, payload)
                    .then(response => {
                        console.log(response.data)
                        state.dispatch('getAllVouchers')
                        resolve(response)
                    }).catch(e => {
                    //this.errors.push(e)
                    reject(e)
                    console.log(e)
                })
            })

        },
        giveVoucher(state,payload){
            axios.post(`/api/voucher/give`,payload)
                .then(response => {
                    console.log(response.data)
                    state.dispatch('getMyVouchers')
                }).catch(e => {
                //this.errors.push(e)
                console.log(e)
            })
        },
        redeemVoucher(state,payload){
            return new Promise((resolve, reject) => {
                axios.post(`/api/voucher/redeem`,payload)
                    .then(response => {
                        console.log(response.data)
                        state.dispatch('getMyVouchers')
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            })

        },
        checkRole(state){
            axios.get(`/user/role`)
                .then(response => {
                    console.log(response.data)
                    state.commit('checkRole',response.data)
                }).catch(e => {
                //this.errors.push(e)
                console.log(e)
            })
        },
        generateVouchers(state, payload){
            console.log(payload)
            return new Promise((resolve, reject) => {
                axios.post(`/api/voucher/generate`,payload)
                    .then(response => {
                        console.log(response.data)
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            })

        },


    },

    mutations: {

        getAllEvents(state,payload) {
            state.allEvents=payload.data
        },
        getMyVouchers(state,payload) {
            state.myVouchers=payload.data
        },
        getRedeemedVouchers(state,payload) {
            state.myRedeemedVouchers=payload.data
        },

        checkRole(state,payload){
            state.admin=payload
        }

    }
})
