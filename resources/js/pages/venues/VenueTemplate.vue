<template>
    <div class="">
        <router-link :to="{ name: 'venuePage', params: { id: venue.id }}">
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full "  :src="'/' +venue.image " alt="venue">
<!--                <img class="w-full" src="http://www.ragranjani.com/images/banner-001.jpg" alt="Sunset in the mountains">-->
                <div class="px-6 py-4">
                    <div class="font-bold text-xl ">{{venue.name}}</div>
                </div>
                <div class="px-3 mb-2 text-center">
                    <span
                        class="inline-block w-2/5 bg-gray-200 rounded px-3 py-1 text-sm text-center font-semibold text-gray-700 mr-1">Start Date <br>{{venue.location}}</span>
<!--                    <span-->
<!--                        class="inline-block w-2/5 bg-gray-200 rounded px-3 py-1 text-sm text-center font-semibold text-gray-700 ">End Date <br> {{venue.location}}</span>-->
                    <!--                <span class="inline-block bg-gray-400 rounded px-3 py-2 text-center text-sm font-semibold text-gray-700"> Details</span>-->
                </div>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: "VenueTemplate",
        props:['venue']
    }
</script>

<style scoped>

</style>
