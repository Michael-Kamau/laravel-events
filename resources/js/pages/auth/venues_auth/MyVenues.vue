<template>
    <div>

        <div v-if="this.$store.getters.getUserVenues.length">
            <table class="table-auto min-w-full leading-normal shadow mx-1">
                <thead>
                <tr>
                    <th class="t-head">Venue Title</th>
                    <th class="t-head">Unconfirmed</th>
                    <th class="t-head">Awaiting payment</th>
                    <th class="t-head">Paid</th>
                    <th class="t-head">View</th>
                    <th class="t-head">Edit</th>
                    <th class="t-head">Status</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="venue in this.$store.getters.getUserVenues" :key="venue.id">

                        <td class="t-data">{{venue.name}}</td>
                        <td class="t-data">{{venue.submitted}}</td>
                        <td class="t-data">{{venue.confirmed}}</td>

                        <td class="t-data">{{venue.completed}}</td>
                        <td class="t-data">
                            <router-link :to="{ name: 'viewVenue', params: { id: venue.id }}">
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    View
                                </button>
                            </router-link>

                        </td>
                        <td class="t-data">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    @click="showModal('edit-modal', venue.id)">
                                Edit
                            </button>
                        </td>
                        <td class="t-data">
                            <ToggleButton v-bind:active="venue.active" @toggle-active="toggleActive(venue.id)"/>
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
                    <p class="text-sm">You Have no venues at the moment</p>
                </div>
            </div>
        </div>


        <modal name="edit-modal" height="auto" width="55%" :scrollable="true">
            <div>
                <EditVenue v-bind:venue="modalVenue" @close-modal="hideModal('edit-modal')"/>
            </div>
        </modal>
    </div>
</template>

<script>
    import axios from "axios";
    import ToggleButton from "../../../components/Buttons/ToggleButton";
    import EditVenue from "./modals/EditVenue";

    export default {
        name: "MyVenues",
        components: {
            ToggleButton,
            EditVenue
        },

        data() {
            return {
                loading: false,
                modalVenue: null,
                bookings: null,
                form: []

            }

        },

        methods: {
            showModal(modal, id) {
                this.modalVenue = this.$store.getters.getUserVenues.filter(venue => venue.id === id)[0]
                this.$modal.show(modal);
            },

            hideModal(modal) {
                this.$modal.hide(modal);
            },

            deleteEvent(id) {
                confirm("Are you sure you want to delete this venue?");
                axios.get('/api/venues/delete/' + id)
                    .then(response => {
                        this.$store.dispatch('getUserVenues')
                    }).catch(e => {
                    //this.errors.push(e)
                    console.log(e)
                })
            },
            editEvent(payload) {

                axios.post(`/api/venues/edit`, payload)
                    .then(response => {
                        console.log(response)
                        this.hideEditModal()
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })

            },

            toggleActive(id) {
                axios.get('/api/venues/toggleActive/' + id)
                    .then(response => {
                        this.$store.dispatch('getUserVenues')
                    }).catch(e => {
                    //this.errors.push(e)
                    console.log(e)
                })
            },
        },

        mounted() {
            this.$store.dispatch('getUserVenues')
                .then()
                .then(response => {
                    console.log(response)
                })
        }


    }
</script>

<style scoped lang="scss">

    .t-head{
        @apply px-2 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider;
    }

    .t-data{
        @apply px-2 py-2 border-b border-gray-200 bg-white text-sm;
    }

</style>
