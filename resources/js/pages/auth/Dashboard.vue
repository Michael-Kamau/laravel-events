<template>

    <div class="flex w-screen max-h-screen">

        <input class="hidden" type="checkbox" id="side-menu" name="vehicle1" value="Bike">
        <label for="side-menu" class="bg-black p-1 absolute top-2 align-middle menu-icon opacity-75 hover:opacity-100">
            <svg viewBox="0 0 20 20" fill="white" class="menu w-6 h-6">
                <path fill-rule="evenodd"
                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                      clip-rule="evenodd"></path>
            </svg>
        </label>
        <div class="  w-3/6 md:w-1/6 bg-gray-400 p-2 side-menu fixed md:static h-screen">
            <div class =" w-full inline-block bg-gray-700 rounded py-2 py-1  mt-2 mb-1 flex justify-between">
                <h1 class=" text-1xl text-center font-semibold text-white-50 pl-3">Dashboard</h1>

                <label for="side-menu" class="bg-blue-100 p-1 mr-2  align-middle">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="menu w-3 h-3">
                        <path  fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>

                    </svg>
                </label>
            </div>
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
        </div>


        <div class=" w-screen md:w-5/6 bg-gray-100 p-2 max-h-full overflow-scroll content">
            <router-view></router-view>
        </div>

    </div>




<!--    <div class="flex  w-screen">-->
<!--        <div class=" fixed md:w-1/6 bg-gray-400 p-2 h-full">-->
<!--            <h1 class="w-full inline-block bg-gray-700 rounded py-2 py-1 text-sm text-center font-semibold text-white-50 mt-2 mb-1">Dashboard</h1>-->
<!--            <div v-if="roleExists('admin')" >-->
<!--                <router-link :to="{name:'artistManagers'}">-->
<!--                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2"> Artist Managers</span>-->
<!--                </router-link><br>-->
<!--                <router-link :to="{name:'eventManagers'}">-->
<!--                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Event Managers</span>-->
<!--                </router-link><br>-->
<!--                <router-link :to="{name:'venueManagers'}">-->
<!--                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2"> Venue Managers</span>-->
<!--                </router-link><br>-->
<!--            </div>-->
<!--            <div>-->

<!--            </div>-->
<!--            <div>-->
<!--                <router-link :to="{name:'viewArtist'}">-->
<!--                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Artist Profile</span>-->
<!--                </router-link><br>-->
<!--                <router-link :to="{name:'artistBookings'}">-->
<!--                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Artist Bookings</span>-->
<!--                </router-link><br>-->
<!--            </div>-->
<!--            <div v-if="roleExists('event-manager')" class=" pl-1">-->
<!--                <router-link :to="{name:'myEvents'}">-->
<!--                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">My Events</span>-->
<!--                </router-link><br>-->
<!--                <router-link :to="{ name: 'addEvent'}">-->
<!--                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Add Event</span>-->
<!--                </router-link>-->
<!--            </div>-->

<!--            <div v-if="roleExists('venue-manager')" class=" pl-1">-->
<!--                <router-link :to="{name:'myVenues'}">-->
<!--                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">My Venues</span>-->
<!--                </router-link><br>-->
<!--                <router-link :to="{ name: 'addVenue'}">-->
<!--                    <span class="inline-block w-full bg-gray-200 rounded px-3 py-2 text-sm font-semibold text-gray-700 mt-2">Add Venue</span>-->
<!--                </router-link>-->
<!--            </div>-->


<!--            <button-->
<!--                class="shadow bg-blue-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"-->
<!--                type="button" @click="roleExists('admin')">-->
<!--                Add-->
<!--            </button>-->
<!--        </div>-->



<!--        <div class="md:w-5/6 bg-white-900 h-screen p-2">-->
<!--            <router-view></router-view>-->
<!--        </div>-->
<!--    </div>-->
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

<style scoped lang="scss">
    .menu-icon {
        position: absolute;
        left: 0px;
        top: 50%;
        display: none;
    }

    #side-menu:checked ~ .menu-icon {
        display: block;
    }
    .side-menu {
        transition: 1.5s;
        transition-property: display;
    }
    #side-menu:checked ~ .side-menu {
        background-color: #1a202c;
        display: none;
    }
    #side-menu:checked ~ .content {
        width: 100%
    }

    .search {
        margin: auto
    }
</style>
