<template>
    <div>
        <h1>Event Managers</h1>
        <table class="table-auto">
            <thead>
            <tr>
                <th class="px-4 py-2">Names</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Event Count</th>
                <th class="px-4 py-2">Events</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in this.users ">
                <td class="border px-4 py-2">{{user.name}}</td>
                <td class="border px-4 py-2">{{user.email}}</td>
                <td class="border px-4 py-2">3</td>
                <td class="border px-4 py-2"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Events
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
        name: "EventManagers.vue",

        data(){
            return{
                users:null
            }
        },

        mounted() {
            this.getUsers()
        },
        methods: {
            getUsers() {
                axios.get(`/api/users/event-manager`)
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
