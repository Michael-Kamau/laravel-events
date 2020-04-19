<template>

    <div>
        <div class="sm:flex border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white" v-if="event">
            <div class="md:w-2/5 px-2">
                <div class="text-gray-900 font-bold text-xl mb-2">{{event[0].name}}</div>
                <img class="max-w-full max-h-full m-auto" src="http://www.ragranjani.com/images/banner-001.jpg" alt="">
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
                    <div class="text-gray-900 font-bold text-xl mb-2">{{event[0].name}}</div>
                    <p class="text-gray-700 text-base">{{event[0].location}}</p>
                    <p class="text-gray-700 text-base">Ksh. {{event[0].charges}}</p>
                </div>
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class=" mb-6 mt-6 md:mb-1">
                        <label class="block  uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                            Ticket Type
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                                <option value="vvip">VVIP</option>
                                <option value="vip">VIP</option>
                                <option value="regular">Regular</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class=" mb-6 mt-6 md:mb-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                            Number Of Tickets
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="1">1 Ticket</option>
                                <option value="2">2 Tickets</option>
                                <option value="3">3 Tickets</option>
                                <option value="4">4 Tickets</option>
                                <option value="5">5 Tickets</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 mt-6">
                        <label class="block  text-gray-700 text-sm font-bold mb-2" for="total-amount">
                            Total Amount
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="total-amount" type="text" disabled placeholder="Amount" v-model="this.totalAmount">
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Buy Tickets
                        </button>
                    </div>
                </form>
                <div class="flex items-center">
                    <div class="text-sm mr-4">
                        <p class="text-gray-900 leading-none">Share</p>
                        <p class="text-gray-600">Event</p>
                    </div>
                    <i class="fab fa-whatsapp w-30 h-30 rounded-full mr-4"></i>
                    <i class="fab fa-twitter w-30 h-30 rounded-full mr-4"></i>
                    <i class="fab fa-facebook-f w-30 h-30 rounded-full mr-4"></i>
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


</template>

<script>
    import EventTemplate from "./EventTemplate.vue";

    export default {
        name: "EventBook.vue",
        components: {EventTemplate},

        data() {
            return {
                eventId: this.$route.params.id,
                ticketsNo:null,
                ticketType:null,
                totalAmount:0

            }
        },
        computed: {
            event() {
                return this.$store.getters.getAllEvents.filter(event => event.id == this.eventId)
            }

        },

        mounted() {
            this.$store.dispatch('getAllEvents');
        }
    }
</script>

<style scoped>

</style>
