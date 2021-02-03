<template>
    <div class="flex  w-screen">
        <div class=" md:w-1/6 bg-gray-400 p-2">
            <h1 class="w-full inline-block bg-gray-700 rounded py-2 py-1 text-sm text-center font-semibold text-white-50 mt-2 mb-1">Dashboard</h1>
            <div v-if="roleExists('admin')" >
                <router-link :to="{name:'artistManagers'}">
                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2"> Artist Managers</span>
                </router-link><br>
                <router-link :to="{name:'eventManagers'}">
                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Event Managers</span>
                </router-link><br>
                <router-link :to="{name:'venueManagers'}">
                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2"> Venue Managers</span>
                </router-link><br>
            </div>
            <div>

            </div>
            <div>
                <router-link :to="{name:'viewArtist'}">
                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Artist Profile</span>
                </router-link><br>
                <router-link :to="{name:'artistBookings'}">
                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Artist Bookings</span>
                </router-link><br>
            </div>
            <div v-if="roleExists('event-manager')" class=" pl-1">
                <router-link :to="{name:'myEvents'}">
                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">My Events</span>
                </router-link><br>
                <router-link :to="{ name: 'addEvent'}">
                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Add Event</span>
                </router-link>
            </div>

            <div v-if="roleExists('venue-manager')" class=" pl-1">
                <router-link :to="{name:'myVenues'}">
                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">My Venues</span>
                </router-link><br>
                <router-link :to="{ name: 'addVenue'}">
                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Add Venue</span>
                </router-link>
            </div>


<!--            <button-->
<!--                class="shadow bg-blue-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"-->
<!--                type="button" @click="roleExists('admin')">-->
<!--                Add-->
<!--            </button>-->
        </div>



        <div class="md:w-5/6 bg-white-900 h-screen p-2">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",

        mounted() {
            this.checkRole()
        },

        methods:{
            checkRole(){
                this.$store.dispatch('checkRole')
            },

            roleExists(role){
                let roles= this.$store.getters.getUserRoles

               return roles.includes(role)
            }

        }
    }
</script>

<style scoped>

</style>
