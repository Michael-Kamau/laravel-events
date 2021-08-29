<template>
    <div>
        <div v-if="booking"
             class="sm:flex border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white">
            <div class="md:w-2/5 px-2">
                <!--                    <div class="text-gray-900 font-bold text-xl mb-2">{{booking.name}}</div>-->
                <!--                <img class="max-w-full max-h-full m-auto" src="http://www.ragranjani.com/images/banner-001.jpg" alt="">-->
                <img class="max-w-full max-h-full m-auto" :src="'/' +booking.venue.image " alt="">
            </div>
            <div
                class=" md:w-3/5  rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <div class="text-gray-900 font-bold text-xl mb-2">Dear {{ booking.name }},</div>
                        <p>To secure your booking, you need to make payment.</p>
                    </div>
                    <div class=" mb-6 mt-2 md:mb-1">
                        <label class="block  uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Booking Details
                        </label>
                        <div class="">
                            <p><b>Venue Name:</b> {{ booking.venue.name }}</p>
                            <p><b>Venue Description:</b> {{ booking.venue.description}}</p>
                            <p><b>Venue Booking Date:</b> {{ booking.date }}</p>
                            <p><b>Venue Booking Amount:</b> {{ booking.amount }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button" @click="bookVenue()">
                            Make Payment
                        </button>
                    </div>

                    <div class="flex items-center pt-2">
                        <div class="text-sm mr-4">
                            <p class="text-gray-900 leading-none">Share</p>
                            <p class="text-gray-600">Event</p>
                        </div>
                        <i class="fab fa-whatsapp w-30 h-30 rounded-full mr-4"></i>
                        <i class="fab fa-twitter w-30 h-30 rounded-full mr-4"></i>
                        <i class="fab fa-facebook-f w-30 h-30 rounded-full mr-4"></i>
                    </div>

                </form>

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
                    <p class="text-sm">Invalid Booking information</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "VenuePayment",
    mounted() {
        this.fetchBookingDetails()
    },
    data() {
        return {
            bookingId: this.$route.params.id.split('-')[1],
            bookingCode: this.$route.params.id.split('-')[0],
            booking: null
        }
    },

    methods: {
        fetchBookingDetails() {
            axios.get('/api/venues/booking-information/' + this.bookingCode + '/' + this.bookingId)
                .then(response => {
                    console.log('response', response)
                    if (response.data.status === 201) {
                        this.booking = response.data.booking
                    }
                }).catch(e => {
                console.log(e)
            })
        },

        bookVenue() {
            console.log('and here we are')
            axios.get(`/api/venues/booking-payment/${this.bookingCode}/${this.bookingId}`)
                .then(response => {
                    console.log('And this is the data', response.data.data.TransToken)

                    if (response.data.success) {
                        window.location.href = `https://secure.3gdirectpay.com/payv2.php?ID=${response.data.data.TransToken}`;

                    }
                    resolve(response)
                }).catch(e => {
                reject(e)
                console.log(e)
            })
        },
    }
}
</script>

<style scoped>

</style>
