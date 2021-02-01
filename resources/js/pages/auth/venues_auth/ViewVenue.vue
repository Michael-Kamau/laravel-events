<template>
    <div>
        <div class="flex p-1">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-1"
                    @click="setStatus('submitted')">
                Submitted
            </button>

            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-1"
                    @click="setStatus('confirmed')">
                Confirmed
            </button>

            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-1"
                    @click="setStatus('completed')">
                Paid
            </button>

            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded "
                    @click="setStatus('rejected')">
                Rejected
            </button>

        </div>
        <div v-if="bookings.length > 0">
            <table class="table-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Booking date</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="booking in bookings" :key="booking.id">

                    <td class="border px-4 py-2">{{booking.name}}</td>
                    <td class="border px-4 py-2">{{booking.status}}</td>
                    <td class="border px-4 py-2">{{booking.date}}</td>
                    <td class="border px-4 py-2">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                @click="showModal('actions-modal',booking.id)">
                            Actions
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
                    <p class="text-sm">You Have no bookings at the moment</p>
                </div>
            </div>
        </div>

        <modal name="actions-modal" height="auto" :adaptive="true" :scrollable="true">
            <div>
                <BookingActions v-bind:booking="modalBooking" @close-modal="hideModal('actions-modal')" @reload-bookings="fetchVenueBookings()"/>
            </div>
        </modal>

    </div>
</template>

<script>
    import axios from "axios";

    import BookingActions from "./modals/BookingActions";

    export default {
        name: "ViewVenue",

        components: {BookingActions},

        mounted() {
            this.fetchVenueBookings()
        },

        data() {
            return {
                venueId: this.$route.params.id,
                venue: [],
                allBookings: [],
                modalBooking: {},
                status: 'submitted'
            }

        },
        methods: {
            showModal(modal, id) {
                this.modalBooking = this.bookings.filter(booking => booking.id === id)[0]
                this.$modal.show(modal);
            },

            hideModal(modal) {
                this.$modal.hide(modal);
            },

            setStatus(status) {
                this.status = status
            },

            fetchVenueBookings() {
                axios.get('/api/venues/bookings/' + this.venueId)
                    .then(response => {
                        if (response.data.status === 201) {
                            this.allBookings = response.data.bookings
                        }
                    }).catch(e => {
                    console.log(e)
                })
            }
        },

        computed: {
            bookings() {

                return this.allBookings.filter(booking => booking.status === this.status)
            }
        }
    }
</script>

<style scoped>

</style>
