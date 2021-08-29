<template>

    <div>
        <div>
            <div
                class="sm:flex border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white"
                v-if="event">
                <div class="md:w-2/5 px-2 pt-2">
                    <div class="text-gray-900 font-bold text-xl mb-2">{{event[0].name}}</div>
                    <!--                <img class="max-w-full max-h-full m-auto" src="http://www.ragranjani.com/images/banner-001.jpg" alt="">-->
                    <img class="max-w-full max-h-full m-auto" :src="'/' +event[0].image " alt="">
                </div>
                <div
                    class=" md:w-3/5  rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                    <div class="mb-8">
                        <p class="text-sm text-gray-600 flex items-center">
                            <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/>
                            </svg>
                            Event Details
                        </p>
                        <p class="text-gray-700 text-base">{{event[0].location}}</p>
                        <p class="text-gray-700 text-base">Vvip: Ksh. {{event[0].vvip}}</p>
                        <p class="text-gray-700 text-base">Vip: Ksh. {{event[0].vip}}</p>
                        <p class="text-gray-700 text-base">Regular: Ksh. {{event[0].regular}}</p>
                        <div v-if="event[0].streamlink.length>4">
                            <button
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="button">
                                <a :href="event[0].streamlink">Stream Event</a>
                            </button>

                        </div>
                    </div>
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class=" mb-6 mt-6 md:mb-1">
                            <label class="block  uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Ticket Type
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                    v-model="form.ticketPrice">
                                    <option v-bind:value="event[0].vvip">VVIP: Ksh. {{event[0].vvip}}</option>
                                    <option v-bind:value="event[0].vip">VIP: Ksh. {{event[0].vip}}</option>
                                    <option v-bind:value="event[0].regular">REGULAR: Ksh. {{event[0].regular}}</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class=" mb-6 mt-6 md:mb-1">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Number Of Tickets
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                    v-model="form.ticketNo">
                                    <option value="1">1 Ticket</option>
                                    <option value="2">2 Tickets</option>
                                    <option value="3">3 Tickets</option>
                                    <option value="4">4 Tickets</option>
                                    <option value="5">5 Tickets</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 mt-6">
                            <label class="block  text-gray-700 text-sm font-bold mb-2" for="total-amount">
                                Total Amount
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="total-amount" type="text" disabled placeholder="Amount" v-model="amount">
                        </div>
                        <div>
                            <p>By booking ticket, you agree to our <a href="/terms" class="text-green-600">Terms and conditions</a> </p>

                        </div>
                        <div class="flex items-center justify-between">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="button" @click="showBuyModal">
                                Buy Tickets
                            </button>
                        </div>
                    </form>
                    <div class="flex items-center">
                        <div class="text-sm mr-4">
                            <p class="text-gray-900 leading-none">Share</p>
                            <p class="text-gray-600">Event</p>
                        </div>
                        <a :href="'https://www.facebook.com/sharer/sharer.php?u='+url($route.fullPath)" target="_blank"><i class="fab fa-facebook-f w-30 h-30 rounded-full mr-4"></i></a>
                        <a :href="'https://wa.me/?text='+url($route.fullPath)"><i class="fab fa-whatsapp w-30 h-30 rounded-full mr-4"></i></a>
                        <a :href="'https://twitter.com/intent/tweet?text='+url($route.fullPath)"><i class="fab fa-twitter w-30 h-30 rounded-full mr-4"></i></a>

                    </div>
                </div>
            </div>

            <div v-else class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                 role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Notification</p>
                        <p class="text-sm">No Events Available currently</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <modal name="buy-modal" height="auto" :adaptive="true" :scrollable="true">
                <div class="p-6">
                    Buy Modal
                    <div
                        class=" md:w-full  rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                            <p class="text-sm text-gray-600 flex items-center">
                                <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path
                                        d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/>
                                </svg>
                                Ticket Details
                            </p>
                            <div class="text-gray-900 font-bold text-xl mb-2">Event Name : {{event[0].name}}</div>
                            <p class="text-gray-700 text-base">Tickets : {{form.ticketNo}} @ {{form.ticketPrice}} </p>
                            <p class="text-gray-700 text-base">Total Amount: Ksh. {{amount}}</p>

                        </div>
                        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <div class="mb-4 mt-6">
                                <label class="block  text-gray-700 text-sm font-bold mb-2" for="firstname">
                                    Firstname
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="firstname" type="text" placeholder="Firstname" v-model="form.firstname">
                            </div>

                            <div class="mb-4 mt-6">
                                <label class="block  text-gray-700 text-sm font-bold mb-2" for="lastname">
                                    LastName
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="lastname" type="text" placeholder="Lastname" v-model="form.lastname">
                            </div>

                            <div class="mb-4 mt-6">
                                <label class="block  text-gray-700 text-sm font-bold mb-2" for="email">
                                    Email
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="email" type="text" placeholder="email" v-model="form.email">
                            </div>

                            <div class="mb-4 mt-6">
                                <label class="block  text-gray-700 text-sm font-bold mb-2" for="phone">
                                    Phone Number
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="phone" type="text" placeholder="+254..(safaricom line)" v-model="form.phone">
                            </div>
                            <div class="flex items-center justify-between">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="button" @click="bookEvent">
                                    Buy Tickets
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </modal>
        </div>
    </div>


</template>

<script>
    import EventTemplate from "./EventTemplate.vue";
    import axios from "axios";
    import {siteUrl} from '../../globals/functions';

    export default {
        name: "EventBook.vue",
        components: {EventTemplate},

        beforeCreate() {
            console.log('before Create')
            this.$store.dispatch('getAllEvents');
        },

        data() {
            return {
                eventId: this.$route.params.id,
                ticketsNo: null,
                ticketPrice: null,
                totalAmount: 0,
                form: {
                    id: this.eventId
                }

            }
        },
        computed: {
            event() {
                console.log('event function')
                return this.$store.getters.getAllEvents.filter(event => event.id == this.eventId)
            },

            amount() {
                if (this.form.ticketNo && this.form.ticketPrice) {
                    return this.form.ticketNo * this.form.ticketPrice
                } else {
                    return 0
                }
            },

        },

        methods: {
            showBuyModal() {
                this.$modal.show('buy-modal');
            },


            hideBuyModal() {
                this.$modal.hide('buy-modal');
            },

            bookEvent() {
                this.form.id = this.$route.params.id;
                axios.post(`/api/events/bookEvent`, this.form)
                    .then(response => {
                        console.log('And this is the data',response.data.data.TransToken)

                        if(response.data.success){
                            window.location.href = `https://secure.3gdirectpay.com/payv2.php?ID=${response.data.data.TransToken}`;

                        }
                        resolve(response)
                        this.$modal.hideAll()
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            },

            url(path){
                return siteUrl(path)
            }
        },


    }
</script>

<style scoped>

</style>
