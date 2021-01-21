<template>
    <div class="">
        <router-link :to="{ name: 'eventPage', params: { id: event.id }}">
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <img class="w-full "  :src="'/' +event.image " alt="Sunset in the mountains">
<!--            <img class="w-full" src="http://www.ragranjani.com/images/banner-001.jpg" alt="Sunset in the mountains">-->
            <div class="px-6 py-4">
                <div class="font-bold text-xl ">{{event.name}}</div>
            </div>
            <div class="px-3 mb-2 text-center">
                <span class="inline-block w-2/5 bg-gray-200 rounded px-3 py-1 text-sm text-center font-semibold text-gray-700 mr-1">Start Date <br>{{event.start_date}}</span>
                <span class="inline-block w-2/5 bg-gray-200 rounded px-3 py-1 text-sm text-center font-semibold text-gray-700 ">End Date <br> {{event.end_date}}</span>
<!--                <span class="inline-block bg-gray-400 rounded px-3 py-2 text-center text-sm font-semibold text-gray-700"> Details</span>-->
            </div>
        </div>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: "EventTemplate",
        props:['event']
    }
</script>

<style scoped>

</style>
