<template>
    <div class="flex  w-screen">
        <div class=" md:w-1/6 bg-gray-400 p-2">
            <h1>Dashboard</h1>
            <router-link :to="{name:'myEvents'}"> My Events</router-link><br>
            <router-link :to="{ name: 'addEvent'}"> Add Event</router-link>
        </div>
        <div class="md:w-5/6 bg-white-900 h-screen p-2">
            Here
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard"
    }
</script>

<style scoped>

</style>
