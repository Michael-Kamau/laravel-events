<template>
    <div>
        <div>
            <div v-if="venue"
                 class="sm:flex border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white">
                <div class="md:w-2/5 px-2">
                    <!--                    <div class="text-gray-900 font-bold text-xl mb-2">{{venue.name}}</div>-->
                    <!--                <img class="max-w-full max-h-full m-auto" src="http://www.ragranjani.com/images/banner-001.jpg" alt="">-->
                    <img class="max-w-full max-h-full m-auto" :src="'/' +venue.image " alt="">
                </div>
                <div
                    class=" md:w-3/5  rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-8">
<!--                            <p class="text-sm text-gray-600 flex items-center">-->
<!--                                <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg"-->
<!--                                     viewBox="0 0 20 20">-->
<!--                                    <path-->
<!--                                        d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/>-->
<!--                                </svg>-->
<!--                                Venue Details-->
<!--                            </p>-->
                            <div class="text-gray-900 font-bold text-xl mb-2">{{venue.name}}</div>
                            <p class="text-gray-700 text-base">{{venue.location}}</p>
                            <!--                        <p class="text-gray-700 text-base">{{venue[0].charges}}</p>-->
                        </div>
                        <div class=" mb-6 mt-6 md:mb-1">
                            <label class="block  uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Venue Description
                            </label>
                            <div class="relative">
                                <p>{{venue.description}}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="button" @click="showModal('book-modal')">
                                Book Venue
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
                        <p class="text-sm">No Venue Available currently</p>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="venue">
            <modal name="book-modal" height="auto" width="50%" :scrollable="true">
                <div class="p-6">
                    Book Venue
                    <div
                        class=" md:w-full  rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                            <p class="text-sm text-gray-600 flex items-center">
                                <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path
                                        d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/>
                                </svg>
                                Venue Booking Details
                            </p>
                            <div class="text-gray-900 font-bold text-xl mb-2">Venue Name : {{venue.name}}</div>
                            <p>After making an inquiry, the venue manager will be notified and will send you details of
                                the event booking to your email address</p>

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
                            <div class="mb-4 mt-6">
                                <label class="block  text-gray-700 text-sm font-bold mb-2" for="description">
                                    Description
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="description" type="textArea"
                                    placeholder="Time and other venue booking details or enquiries..."
                                    v-model="form.description" cols="250"></textarea>
                            </div>
                            <div class="mb-4 mt-6">
                                <label class="block  text-gray-700 text-sm font-bold mb-2" for="book_date">
                                    Date
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="book_date" type="date" placeholder="date" v-model="form.book_date">
                            </div>
                            <div class="flex items-center justify-between">
                                <button
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="button" @click="hideModal('book-modal')">
                                    Cancel
                                </button>

                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="button" @click="bookVenue">
                                    Make Inquiry
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
    import axios from "axios";

    export default {
        name: "VenueBook",

        beforeCreate() {
            console.log('before Create')
            this.$store.dispatch('getAllVenues');
        },

        created() {
            console.log('ANOTHER OF THE DATA', this.venue)
        },

        data() {
            return {
                venueId: this.$route.params.id,
                form: {
                    id: this.venueId,
                    amount: 0,
                }

            }
        },

        computed: {
            venue() {
                return this.$store.getters.getAllVenues.filter(venue => venue.id === this.venueId)[0]
            },
        },

        methods: {
            showModal(modal) {
                this.$modal.show(modal);
            },
            hideModal(modal) {
                this.$modal.hide(modal);
            },

            bookVenue() {
                this.form.id = this.$route.params.id;
                axios.post(`/api/venues/bookVenue`, this.form)
                    .then(response => {
                        console.log(response)
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            }

        }

    }
</script>

<style scoped>

</style>
