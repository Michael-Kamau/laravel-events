<template>
    <div class="flex  w-screen">
        <div class=" md:w-1/6 bg-gray-400 p-2">
            <h1>Dashboard</h1>
            <div v-if="roleExists('admin')">
                <router-link :to="{name:'artistManagers'}"> Artist Managers</router-link><br>
                <router-link :to="{name:'eventManagers'}"> Event Managers</router-link><br>
                <router-link :to="{name:'venueManagers'}"> Venue Managers</router-link><br>
            </div>
            <div>

            </div>
            <div v-if="roleExists('artist')">
                <router-link :to="{name:'artistManagers'}"> Performing Artists</router-link><br>
            </div>
            <div v-if="roleExists('event-manager')">
                <router-link :to="{name:'myEvents'}"> My Events</router-link><br>
                <router-link :to="{ name: 'addEvent'}"> Add Event</router-link>
            </div>


            <button
                class="shadow bg-blue-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                type="button" @click="roleExists('admin')">
                Add
            </button>
        </div>



        <div class="md:w-5/6 bg-white-900 h-screen p-2">
            Here
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
