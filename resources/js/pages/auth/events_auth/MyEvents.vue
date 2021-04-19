<template>
    <div>
        <div v-if="this.$store.getters.getUserEvents.length">
            <table class="table-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2">Event Title</th>
                    <th class="px-4 py-2">Vvip</th>
                    <th class="px-4 py-2">vip</th>
                    <th class="px-4 py-2">regular</th>
                    <th class="px-4 py-2">Paid</th>
                    <th class="px-4 py-2">View</th>
                    <th class="px-4 py-2">Edit</th>
                    <th class="px-4 py-2">Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="event in this.$store.getters.getUserEvents" :key="event.id">
                    <td class="border px-4 py-2">{{event.name}}</td>
                    <td class="border px-4 py-2">{{event.vvipBookings}}</td>
                    <td class="border px-4 py-2">{{event.vipBookings}}</td>
                    <td class="border px-4 py-2">{{event.regularBookings}}</td>
                    <td class="border px-4 py-2">{{event.paid}}</td>
                    <td class="border px-4 py-2">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                @click="showBookingsModal(event.id)">
                            View
                        </button>
                    </td>
                    <td class="border px-4 py-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                @click="showEditModal(event.id)">
                            Edit
                        </button>
                    </td>
                    <td class="border px-4 py-2">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                @click="deleteEvent(event.id)">
                            Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
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
                    <p class="text-sm">You Have no events at the moment</p>
                </div>
            </div>
        </div>


        <div>
            <modal name="edit-modal" height="auto" width="80%" :scrollable="true">
                <div
                    class="sm:flex border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white p-6"
                    v-if="modalEvent">
                    <div class="md:w-2/5 px-2">
                        <div class="text-gray-900 font-bold text-xl mb-2">{{modalEvent[0].name}}</div>
                        <!--                <img class="max-w-full max-h-full m-auto" src="http://www.ragranjani.com/images/banner-001.jpg" alt="">-->
                        <img class="max-w-full max-h-full m-auto" :src="'/' +modalEvent[0].image " alt="">
                    </div>
                    <div
                        class=" md:w-3/5  rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal p-6">
                        <div class="mb-8">
                            <form class="w-full max-w-lg" enctype="multipart/form-data">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-event-name">
                                            Event Name
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                            id="grid-event-name" type="text" placeholder=""
                                            v-model="modalEvent[0].name">
                                        <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                                    </div>

                                </div>

                                <div class="flex flex-wrap -mx-3 mb-6">

                                    <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-location-name">
                                            Event Location and Time
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                            id="grid-location-name" type="text" placeholder=""
                                            v-model="modalEvent[0].location">
                                        <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                                    </div>
                                </div>


                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="start-date">
                                            Start Date
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="start-date" type="date" placeholder="Albuquerque"
                                            v-model="modalEvent[0].start_date">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="end-date">
                                            End Date
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="end-date" type="date" placeholder="Albuquerque"
                                            v-model="modalEvent[0].end_date">
                                    </div>


                                </div>

                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-vvip">
                                            VVIP
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-vvip" type="number" placeholder="Ksh" v-model="modalEvent[0].vvip">
                                    </div>
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-vip">
                                            VIP
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-vip" type="number" placeholder="Ksh" v-model="modalEvent[0].vip">
                                    </div>
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-regular">
                                            Regular
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-regular" type="number" placeholder="Ksh"
                                            v-model="modalEvent[0].regular">
                                    </div>
                                </div>


                                <button
                                    class="shadow bg-blue-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                    type="button" @click="editEvent(modalEvent[0])">
                                    Save
                                </button>

                                <button
                                    class="shadow bg-green-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                    type="button" @click="hideEditModal">
                                    Cancel
                                </button>

                            </form>
                        </div>
                    </div>
                </div>


            </modal>

            <modal name="bookings-modal" height="auto" width="80%" :scrollable="true">
                <div
                    class="sm:flex border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white p-6"
                    v-if="modalEvent">
                    <div v-if="this.modalEvent[0].bookings.length">
                        <button
                            class="shadow bg-red-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded"
                            type="button" @click="">
                            Download PDF
                        </button>
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Ticket Code</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Ticket Type</th>
                                <th class="px-4 py-2">Ticket Number</th>
                                <th class="px-4 py-2">Amount Paid</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="booking in this.modalEvent[0].bookings" :key="booking.id">
                                <td class="border px-4 py-2">{{booking.id}}</td>
                                <td class="border px-4 py-2">{{booking.name}}</td>
                                <td class="border px-4 py-2">{{booking.email}}</td>
                                <td class="border px-4 py-2">{{booking.type}}</td>
                                <td class="border px-4 py-2">{{booking.number}}</td>
                                <td class="border px-4 py-2">{{booking.amount}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <button
                            class="shadow bg-green-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded"
                            type="button" @click="hideBookingsModal">
                            Cancel
                        </button>
                    </div>
                    <div v-else
                         class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
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
                                <p class="text-sm">The Event does not have any bookings at the moment</p>
                                <button
                                    class="shadow bg-green-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded"
                                    type="button" @click="hideBookingsModal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </modal>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "MyEvents",

        data() {
            return {
                loading: false,
                modalEvent: null,
                bookings: null,

            }

        },

        methods: {

            deleteEvent(id) {
                confirm("Are you sure you want to delete this event?");
                axios.get('/api/events/delete/' + id)
                    .then(response => {
                        this.$store.dispatch('getUserEvents')
                    }).catch(e => {
                    //this.errors.push(e)
                    console.log(e)
                })
            },
            editEvent(payload) {

                axios.post(`/api/events/edit`, payload)
                    .then(response => {
                        console.log(response)
                        this.hideEditModal()
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })

            },
            showEditModal(id) {
                this.modalEvent = this.$store.getters.getUserEvents.filter(event => event.id === id)
                this.$modal.show('edit-modal');
            },
            hideEditModal() {
                this.$modal.hide('edit-modal');
            },

            showBookingsModal(id) {
                this.modalEvent = this.$store.getters.getUserEvents.filter(event => event.id === id)
                this.$modal.show('bookings-modal');
            },
            hideBookingsModal() {
                this.$modal.hide('bookings-modal');
            }

        },

        mounted() {
            this.$store.dispatch('getUserEvents')

        }


    }
</script>

<style scoped>

</style>
