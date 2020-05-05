<template>
    <div>
        <div v-if="this.$store.getters.getUserEvents.length">
            <table class="table-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2">Event Title</th>
                    <th class="px-4 py-2">Bookings</th>
                    <th class="px-4 py-2">Paid</th>
                    <th class="px-4 py-2">View</th>
                    <th class="px-4 py-2">Edit</th>
                    <th class="px-4 py-2">Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="event in this.$store.getters.getUserEvents" :key="event.id">
                    <td class="border px-4 py-2">{{event.name}}</td>
                    <td class="border px-4 py-2">100</td>
                    <td class="border px-4 py-2">20,000</td>
                    <td class="border px-4 py-2">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            View
                        </button>
                    </td>
                    <td class="border px-4 py-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </button>
                    </td>
                    <td class="border px-4 py-2">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="deleteEvent(event.id)">
                            Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-else class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert" >
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">Notification</p>
                    <p class="text-sm">You Have no events at the moment</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "MyEvents",

        data(){

        },

        methods:{

            deleteEvent(id){
                confirm("Are you sure you want to delete this event?");
                axios.get('/api/events/delete/'+id)
                    .then(response => {
                        this.$store.dispatch('getUserEvents')
                    }).catch(e => {
                    //this.errors.push(e)
                    console.log(e)
                })
            }

        },

        mounted() {
            this.$store.dispatch('getUserEvents')
                .then(response =>{
                    console.log(response)
                })
        }



    }
</script>

<style scoped>

</style>
