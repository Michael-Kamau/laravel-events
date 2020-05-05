<template>
   <div>
       <h1>Venue Managers</h1>
       <table class="table-auto">
           <thead>
           <tr>
               <th class="px-4 py-2">Names</th>
               <th class="px-4 py-2">Email</th>
               <th class="px-4 py-2">Venues Count</th>
               <th class="px-4 py-2">Venues</th>
           </tr>
           </thead>
           <tbody>
           <tr v-for="user in this.users ">
               <td class="border px-4 py-2">{{user.name}}</td>
               <td class="border px-4 py-2">{{user.email}}</td>
               <td class="border px-4 py-2">3</td>
               <td class="border px-4 py-2"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                   Venues
               </button>
               </td>

           </tr>
           </tbody>
       </table>
   </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "Admin",

        data() {
            return {
                users: null
            }
        },

        mounted() {
            this.getUsers()
        },
        methods: {
            getUsers() {
                axios.get(`/api/users/venue-manager`)
                    .then(response => {
                        console.log(response.data)
                        this.users = response.data
                    }).catch(e => {
                    console.log(e)
                })
            },
        }
    }
</script>


<style scoped>

</style>
