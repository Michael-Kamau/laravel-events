<template>
    <div class="">
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <img class="w-full"  :src="'/' +event.image " alt="Sunset in the mountains">
<!--            <img class="w-full" src="http://www.ragranjani.com/images/banner-001.jpg" alt="Sunset in the mountains">-->
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{event.name}}</div>
            </div>
            <div class="px-6 py-2">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Start Date <br>{{event.start_date}}</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">End Date <br> {{event.end_date}}</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700"><router-link :to="{ name: 'eventPage', params: { id: event.id }}"> Details</router-link></span>
            </div>
        </div>
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
